<template>
    <div>
        <h1>Add User</h1>

        <vue-instant-loading-spinner
            ref="Spinner"
            id="Spinner"
            v-show="isLoading"
        ></vue-instant-loading-spinner>

        <Toasts
            :show-progress="true"
            :rtl="false"
            :max-messages="5"
            :time-out="15000"
            :closeable="true"
        ></Toasts>

        <form @submit.prevent="addUser">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>First Name:</label>
                        <br/>
                        <input v-model="user.first_name" placeholder="" id="first_name" name="first_name" :min="2" :max="20" v-on:keyup="disableCreateButton()">
                    </div>
                    <div class="form-group">
                        <label>Last Name:</label>
                        <br/>
                        <input v-model="user.last_name" placeholder="" id="last_name" name="last_name" :min="2" :max="20" required v-on:keyup="disableCreateButton()">
                    </div>
                    <div class="form-group">
                        <label>Position:</label>
                        <br/>
                        <input v-model="user.position" placeholder="e.g. Software Engineer" id="position" name="position" :min="2" :max="20" required v-on:keyup="disableCreateButton()">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <br/>
                        <input v-model="user.email" placeholder="" id="email" name="email" type="email" required v-on:keyup="disableCreateButton()">
                    </div>
                </div>
            </div>
            <br />
            <div class="form-group">
                <button class="btn btn-primary" id="btnAddUser" name="btnAddUser">
                    Create
                </button>
            </div>
        </form>
    </div>
</template>

<style>
.btn.btn-primary:disabled {
    background-color: grey;
}
</style>

<script>
import VueInstantLoadingSpinner from "vue-instant-loading-spinner/src/components/VueInstantLoadingSpinner.vue";

export default {
    data() {
        return {
            user: {},
            isLoading: true,
        };
    },
    ready() {
        // console.log("ready");
    },
    beforeCreate() {
        // console.log("beforeCreate");
    },
    created() {
        // console.log("created");
        this.enableInterceptor();
    },
    beforeMount() {
        // console.log("beforeMount");
    },
    mounted() {
        // console.log("mounted");

        // window.addEventListener('beforeunload', this.leaving);
        // window.addEventListener('unload', this.someMethod)

        // this.currentUser();
        this.disableCreateButton();
        this.navigationTimingData();
    },
    beforeUpdate() {
        // console.log("beforeUpdate");
    },
    updated() {
        // console.log("update");
    },
    beforeDestroy() {
        // console.log("beforeDestroy");
    },
    destroyed() {
        // console.log("destroyed");
    },
    components: {
        VueInstantLoadingSpinner
    },
    methods: {
        navigationTimingData() {
            // The type read-only property returns a string representing the type of navigation. The value must be one of the following:
            // navigate — Navigation started by clicking a link, entering the URL in the browser's address bar, form submission, or initializing through a script operation other than reload and back_forward as listed below.
            // reload — Navigation is through the browser's reload operation or location.reload().
            // back_forward — Navigation is through the browser's history traversal operation.
            // prerender — Navigation is initiated by a prerender hint.
            // https://stackoverflow.com/questions/5004978/check-if-page-gets-reloaded-or-refreshed-in-javascript

            // alert(performance.navigation.type);
            // alert(window.performance.getEntriesByType("navigation")[0].type);
            // alert(window.performance.navigation);

            // Use getEntriesByType() to just get the "navigation" events
            let perfEntries = performance.getEntriesByType("navigation");

            // Inclusion of this code helps to mitigate a problem that I had where sometimes after filling out the form and trying to send
            // the request to the backend api endpoint via a post request, that request endedup being converted into a get request and the request fails.
            // After spening many hours of troubleshooting I realized that refreshing the page after loading the page for the fist time helps to mitigate this issue
            // and this code below helps to address this issue.
            for (let i = 0; i < perfEntries.length; i++) {
                // console.log("= Navigation entry[" + i + "]");

                let p = perfEntries[i];

                let domContentLoaded =
                    p.domContentLoadedEventEnd - p.domContentLoadedEventStart;
                let domComplete = p.domComplete;
                let interactive = p.interactive;

                // dom Properties
                // console.log("DOM content loaded = " + domContentLoaded);
                // console.log("DOM complete = " + domComplete);
                // console.log("DOM interactive = " + interactive);

                let documentLoad = p.loadEventEnd - p.loadEventStart;
                let documentUnload = p.unloadEventEnd - p.unloadEventStart;

                // document load and unload time
                // console.log("document load = " + documentLoad);
                // console.log("document unload = " + documentUnload);

                let type = p.type;
                let redirectCount = p.redirectCount;

                // other properties
                // console.log("type = " + type);
                // console.log("redirectCount = " + redirectCount);

                if (
                    domContentLoaded !== 0 &&
                    domComplete !== 0 &&
                    documentLoad !== 0
                ) {
                    window.location.reload();
                }
            }
        },
        disableCreateButton() {
            // Enable submit button if all conditions evaluated below are met.
            if (this.user.first_name && this.user.last_name && this.user.position && this.user.email) {
                const vailidate_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                vailidate_email.test(this.user.email);

                if (this.user.first_name.length > 1 && this.user.last_name.length > 1 && this.user.position.length > 1 && vailidate_email.test(this.user.email)) {
                    $("#btnAddUser").prop("disabled", false);
                } else {
                    $("#btnAddUser").prop("disabled", true);
                }
            } else {
                $("#btnAddUser").prop("disabled", true);
            }
        },
        addUser() {
            let payload = {
                first_name: this.user.first_name,
                last_name: this.user.last_name,
                position: this.user.position,
                email: this.user.email
            };

            // let url = process.env.VUE_APP_MIX_APP_URL + "/api/users";
            let url = "http://localhost/api/users";
            url = url.replace(/\// + $, "");

            this.axios
                .post(url, payload)
                .then(response => {
                    // window.location.replace("http://localhost/users");
                    // window.location.replace(process.env.VUE_APP_MIX_APP_URL + "/users");
                    setTimeout(() => {
                        this.$router.push("/users");
                    }, 3000);
                })
                .catch(function(error) {
                    const vm = new Vue();

                    // The system request to the api returned this exception "TypeError: error.response is undefined" with no code specified
                    // and this makes the page to fail to render.
                    // In the meaniwhile inform the user about this error and also advice them on which actions to take.
                    // Temporary solytion for this error is to refresh the page using combination of these keys "Ctrl + F5"

                    let unxp =
                        'An unexpected error with no code specified and has the status of "' +
                        error +
                        '" occured. ';
                    let msg =
                        ' Please refresh your page using the combiation of these keys "Ctrl + F5" on your keybord to refresh the page and access the page to mitigate this problem right now.' +
                        " Inform the system administrator at omphemetsemafoko@gmail.com and tell him about this error.";

                    let error_message = unxp + msg;
                    let search_word =
                        "TypeError: Cannot read property 'status' of undefined";
                    let position = error_message.search(search_word);

                    if (position > 0) {
                        // return axios.post(url, payload, error.config);
                        window.location.reload();
                    } else {
                        search_word = "TypeError: Cannot read property ";
                        position = error_message.search(search_word);

                        if (position < 0) {
                            search_word = "TypeError: error.response ";
                            position = error_message.search(search_word);

                            if (position > 0) {
                                window.location.reload();
                            } else {
                                vm.$toast.error(error_message);
                                document.getElementById(
                                    "Spinner"
                                ).style.display = "none";
                            }
                        } else {
                            document.getElementById("Spinner").style.display =
                                "none";
                        }
                    }
                });
        },
        enableInterceptor() {
            // Axios interceptors to intercept requests before they reach backend and to also intercepts response before
            // they reach their final destination on the web app

            this.axiosInterceptor = window.axios.interceptors.request.use(
                config => {
                    if (typeof this.isLoading != "undefined") {
                        this.isLoading = true;
                    }

                    this.$refs.Spinner.show();

                    return config;
                },
                error => {
                    if (typeof this.isLoading != "undefined") {
                        this.isLoading = false;
                    }

                    return Promise.reject(error);
                }
            );

            window.axios.interceptors.response.use(
                response => {
                    if (typeof response.status !== "undefined") {
                        if (200 !== response.status) {
                            let msg = "Successful";
                            let msg_trail = "ly ";
                            let msg1 = msg + msg_trail;

                            // Use ternary operator to make decisions of what to display on the popup toast.
                            // Most of the messages for this toast comes form the api endpoint response
                            let message =
                                201 === response.status
                                    ? response.data.message === "tick"
                                        ? msg + " " + response.data.message
                                        : msg1 + response.data.message
                                    : 204 === response.status &&
                                      "delete" ===
                                          response.config.method.toLowerCase()
                                    ? msg1 + "deleted"
                                    : msg;
                            if (
                                204 === response.status &&
                                "delete" ===
                                    response.config.method.toLowerCase()
                            ) {
                                this.$toast.info(message);
                            } else {
                                this.$toast.success(message);
                            }
                        }
                    } else {
                        this.$toast.error('An unexpected error with message "');
                    }

                    if (typeof this.isLoading != "undefined") {
                        this.isLoading = false;
                    }

                    return response;
                },
                function(error) {
                    // const originalRequest = error.config;
                    // if (
                    //     error.response.status === 401 && !originalRequest._retry
                    // ) {
                    //     originalRequest._retry = true;
                    //     const refreshToken = window.localStorage.getItem(
                    //         "refreshToken"
                    //     );
                    //     return axios
                    //         .post("http://localhost:8000/auth/refresh", {
                    //             refreshToken
                    //         })
                    //         .then(({ data }) => {
                    //             window.localStorage.setItem(
                    //                 "token",
                    //                 data.token
                    //             );
                    //             window.localStorage.setItem(
                    //                 "refreshToken",
                    //                 data.refreshToken
                    //             );
                    //             axios.defaults.headers.common["Authorization"] =
                    //                 "Bearer " + data.token;
                    //             originalRequest.headers["Authorization"] =
                    //                 "Bearer " + data.token;
                    //             return axios(originalRequest);
                    //         });
                    // }
                    // http://quabr.com:8182/58395577/how-can-i-get-an-axios-interceptor-to-retry-the-original-request

                    if (typeof error.response.status !== "undefined") {
                        let msg =
                            " You can refresh your page for better usage quality should this errors still persist and the application " +
                            "fails to perform other requests please consult the site administrator at omphemetsemafoko@gmail.com.";

                        const vm = new Vue();

                        if (429 === error.response.status) {
                            vm.$toast.warning(error.response.data.errors + msg);
                        } else if (404 === error.response.status) {
                            let message =
                                "get" ===
                                error.response.config.method.toLowerCase()
                                    ? typeof error.response.data.errors !==
                                      "indefined"
                                        ? error.response.data.errors + msg
                                        : error.response.data.message + msg
                                    : error.response.data.errors + msg;

                            vm.$toast.error(message);
                            // vm.$toast.error(error.response.data.errors);
                        } else if (504 === error.response.status) {
                            vm.$toast.error(
                                error.response.status +
                                    " " +
                                    error.response.statusText +
                                    " error occured, the request was blocked by the server and did not finish processing. Please make sure that your " +
                                    "backend server configuration can allow long running process." +
                                    msg
                            );
                        } else {
                            let error_messages = '';
                            // Capture all required input validation fields errors from backend here and present them to the client.
                            if (error.response.data.errors) {
                                let x = 0;                                
                                let messages = Object.values(error.response.data.errors);
                                let msg_length = messages.length;

                                messages.forEach((value) => {
                                    x++;
                                    // error_messages = (x == 1) ? value[0] : (msg_length == x) ? error_messages + ' and ' + value[0] : error_messages + ', ' + value[0];
                                    error_messages = (x == 1) ? value[0] : (msg_length == x) ? error_messages + ' ' + value[0] : error_messages + ', ' + value[0];

                                    console.log('Error Found : ', value[0]);
                                }); 
                            }

                            let final_message = '';

                            if (error_messages.length > 0) {
                                final_message = "Please check if your form input values are not violating the following details (" + error_messages + ")";
                            } else {
                                final_message = "An unexpected error with code " +
                                    error.response.status +
                                    " and status " +
                                    error.response.statusText +
                                    " occured, please try again later." +
                                    msg;
                            }

                            vm.$toast.error(final_message);
                        }
                    } else {
                        this.$toast.error('An unexpected error with message "');
                    }

                    // this.$refs.Spinner.hide();
                    // vm.$refs.Spinner.hide();

                    document.getElementById("Spinner").style.display = "none";

                    if (typeof this.isLoading != "undefined") {
                        this.isLoading = false;
                    }

                    return Promise.reject(error);
                }
            );
        },
        disableInterceptor() {
            window.axios.interceptors.request.eject(this.axiosInterceptor);
        }
    }
};
</script>
