<template>
    <div>
        <h1>User - Management Tool</h1>

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

        <div style="width: 100%; margin: 0 auto;">
            <div align="left">
                <input
                    type="text"
                    class="form-control"
                    name="user_search"
                    id="user_search_id"
                    placeholder="Search..."
                    v-on:keyup="inputUsersSearch()"
                />
            </div>
            <br/>
            <div>
                <router-link :to="{ name: 'create' }" class="btn btn-primary"
                    >Add new user</router-link
                >
            </div>
        </div>

        <div v-if="total_records > 10" style="width: 50%; margin: 0 auto; position: relative;">
            <pagination
                :data="users"
                @pagination-change-page="searchUsers"
                :limit="5"
                align="center"
                size="small"
            ></pagination>
        </div>

        <div style="text-align: center;">
            <span>{{ msg() }}</span>
        </div>
        <br />
        <div>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th @click="sortUsers('first_name')">First Name</th>
                        <th @click="sortUsers('last_name')">Last Name</th>
                        <th @click="sortUsers('position')">Position</th>
                        <th @click="sortUsers('email')">Email</th>
                        <th @click="sortUsers('created_at')">Created At</th>
                        <th @click="sortUsers('updated_at')">Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users.data" :key="user.id">
                        <td>{{ rowNumber(index) }}</td>
                        <td>{{ user.first_name }}</td>
                        <td>{{ user.last_name }}</td>
                        <td>{{ user.position }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.created_at }}</td>
                        <td>{{ user.updated_at }}</td>
                        <td>
                            <router-link
                                :to="{ name: 'edit', params: { id: user.id } }"
                                class="btn btn-primary"
                                >Edit</router-link
                            >
                        </td>
                        <td>
                            <button
                                class="btn btn-danger"
                                @click="
                                    confirmDelete(
                                        user.id,
                                        user.first_name + ' ' + user.last_name
                                    )
                                "
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="text-align: center;">
            <span>{{ msg() }}</span>
        </div>
        <div style="width: 50%; margin: 0 auto; position: relative;">
            <pagination
                :data="users"
                @pagination-change-page="searchUsers"
                :limit="5"
                align="center"
                size="small"
            ></pagination>
        </div>
    </div>
</template>

<style>
.btn.btn-primary:disabled {
    background-color: grey;
}
</style>

<script>
// import toast from "./../services/toast";
import VueInstantLoadingSpinner from "vue-instant-loading-spinner/src/components/VueInstantLoadingSpinner.vue";

export default {
    data() {
        // Declation of important varuables

        return {
            users: {},
            currentSort: "first_name",
            currentSortDir: "asc",
            page: 1,
            limit: 10,
            from_record: 0,
            to_record: 0,
            total_records: 0,
            row_no: 0,
            userSearch: "",
            isLoading: true
        };
    },
    created() {
        let order = this.currentSortDir === "asc" ? 1 : 0;

        this.getUsers(order);
    },
    mounted() {
        this.enableInterceptor();
    },
    components: {
        VueInstantLoadingSpinner
    },
    computed: {},
    methods: {
        alert() {
            this.$dialog.alert({
                title: "Alert",
                desc: "this is an alert!"
            });
        },
        confirmDelete(id, name) {
            this.$dialog.confirm({
                title: "Confirm deleting a user called " + name,
                desc:
                    "Are you sure you want to delete a user called " +
                    name,
                cancelText: "Cancel",
                cancelBgColor: "#eaeaea",
                cancelColor: "#000000",
                confirmText: "Confirm",
                confirmBgColor: "#FF0000",
                confirmColor: "#FFFFFF",
                cancel: "cancel",
                confirm: "confirm",
                confirm: () => {
                    this.deletePost(id);
                },
                cancel: () => {}
            });
        },
        prompt() {
            this.$dialog.prompt({
                title: `What's your name?`,
                desc: "this is a prompt!",
                cancelText: "Cancel",
                confirmText: "Confirm",
                cancel: "cancel",
                confirm: "confirm",
                confirm: text => {
                    window.alert(`yes: ${text}`);
                },
                cancel: () => {
                    window.alert("no");
                }
            });
        },
        handleClick() {
            let self = this;
            this.$vueConfirm.confirm(
                {
                    auth: false,
                    message: `Are you sure?`,
                    button: {
                        no: "No",
                        yes: "Yes"
                    }
                },
                function(confirm) {
                    if (confirm == true) {
                        // ... do some thing
                    }
                }
            );
        },
        deletePost(id) {
            // Delete record

            // let url = process.env.VUE_APP_MIX_APP_URL + "/api/users/" + id;
            let url = "http://localhost/api/users/" + id;

            this.axios
                .delete(url)
                .then(response => {
                    this.users.data.splice(this.users.data.indexOf(id), 1);
                    //vm.$forceUpdate();
                    //this.$forceUpdate();
                    this.searchUsers(this.page);
                })
                .catch(function(error) {});
        },
        sortUsers: function(s) {
            // Allow column to sort results

            //if s == current sort, reverse
            if (s === this.currentSort) {
                this.currentSortDir =
                    this.currentSortDir === "asc" ? "desc" : "asc";
            }

            this.currentSort = s;
            let order = this.currentSortDir === "asc" ? 1 : 0;

            this.getUsers(order, true);
        },
        searchUsers(current_page = 1) {
            // Pass the current page to get results

            this.page = current_page;
            let order = this.currentSortDir === "asc" ? 1 : 0;

            this.getUsers(order, true);
        },
        inputUsersSearch() {
            // Apply search for every input key up stroke

            this.userSearch = $("input[name=user_search]").val();
            this.searchUsers(this.page);
        },
        rowNumber(index) {
            // Calculate the correct record number using both vue table index and the allowed total limit per page

            return index + this.from_record + ".";
        },
        renderLastPage() {
            // The renderLastPage function will help to render the last page if a search done on a page that is
            // higher by number and the total number of search results does not reach that page
            // then we will calculate the last highest page number that will allow this results to
            // be shown.

            let last_page = Math.ceil(this.total_records / this.limit);

            this.searchUsers(last_page);
        },
        msg() {
            // Span message to notify the user

            let msg = "No results found.";

            if (this.total_records > 0) {
                msg =
                    "Page " +
                    this.page +
                    ". Showing  " +
                    this.from_record +
                    " to " +
                    this.to_record +
                    " out of " +
                    this.total_records +
                    " records.";
            }

            return msg;
        },
        setNavInfo(response) {
            // Extract and assign relevant values to for this fields (page, from_record, to_record and total_records)

            this.page = response.data.meta.total == 0 ? 1 : this.page;
            this.from_record = !Number.isInteger(response.data.meta.from)
                ? 0
                : response.data.meta.from;
            this.to_record = !Number.isInteger(response.data.meta.to)
                ? 0
                : response.data.meta.to;
            this.total_records = response.data.meta.total;
        },
        enableInterceptor() {
            // Axios interceptors to intercept requests before they reach backend and to also intercepts response before
            // they reach their final destination on the web app

            this.axiosInterceptor = window.axios.interceptors.request.use(
                config => {
                    this.isLoading = true;
                    this.$refs.Spinner.show();

                    return config;
                },
                error => {
                    this.isLoading = false;
                    return Promise.reject(error);
                }
            );

            window.axios.interceptors.response.use(
                response => {
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
                                : 202 === response.status &&
                                  "get" === response.config.method.toLowerCase()
                                ? msg1 + response.data.message
                                : msg;

                        if (
                            204 === response.status &&
                            "delete" === response.config.method.toLowerCase()
                        ) {
                            this.$toast.info(message);
                        } else {
                            this.$toast.success(message);
                        }
                    }

                    this.isLoading = false;

                    return response;
                },
                function(error) {
                    let msg =
                        " You can refresh your page for better usage quality should this errors still persist and the application " +
                        "fails to perform other requests please consult the site administrator at omphemetsemafoko@gmail.com.";

                    const vm = new Vue();

                    if (429 === error.response.status) {
                        vm.$toast.warning(error.response.data.errors + msg);
                    } else if (404 === error.response.status) {
                        // Align with the TickController tick message when no records are not found or alternatively return ussual 404 error messages as expected
                        let message =
                            "get" === error.response.config.method.toLowerCase()
                                ? error.response.data.message + msg
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
                        vm.$toast.error(
                            "An unexpected error with code " +
                                error.response.status +
                                " and status " +
                                error.response.statusText +
                                " occured, please try again later." +
                                msg
                        );
                    }

                    // this.$refs.Spinner.hide();
                    //  vm.$refs.Spinner.hide();

                    document.getElementById("Spinner").style.display = "none";

                    this.getUsers();

                    this.isLoading = false;

                    return Promise.reject(error);
                }
            );
        },
        disableInterceptor() {
            window.axios.interceptors.request.eject(this.axiosInterceptor);
        },
        getUsers(order = "asc", seachingOrordering = false) {
            // let uri =
            //     process.env.VUE_APP_MIX_APP_URL +
            //     "/api/users?query=" +
            //     this.userSearch +
            //     "&limit=" +
            //     this.limit +
            //     "&ascending=" +
            //     order +
            //     "&page=" +
            //     this.page +
            //     "&orderBy=" +
            //     this.currentSort;

            let uri =
                "http://localhost/api/users?query=" +
                this.userSearch +
                "&limit=" +
                this.limit +
                "&ascending=" +
                order +
                "&page=" +
                this.page +
                "&orderBy=" +
                this.currentSort;

            this.axios
                .get(uri)
                .then(response => {
                    this.setNavInfo(response);

                    // Check if the value for from is not integer and the value for total is integer
                    if (
                        !Number.isInteger(response.data.meta.from) &&
                        Number.isInteger(response.data.meta.total) &&
                        response.data.meta.total > 0
                    ) {
                        if (seachingOrordering) {
                            this.renderLastPage();
                        } else {
                            this.renderPage();
                        }
                    } else {
                        this.users = response.data;
                    }
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
                        '" occured.';
                    let msg =
                        ' Please refresh your page using the combiation of these keys "Ctrl + F5" on your keybord to refresh the page and access the page to mitigate this problem right now.' +
                        " Inform the system administrator at omphemetsemafoko@gmail.com about this error.";

                    let error_message = unxp + msg;
                    let search_word =
                        "TypeError: Cannot read property 'status' of undefined";
                    let position = error_message.search(search_word);

                    if (position > 0) {
                        window.location.reload();
                        // this.$router.push('/users');
                    } else {
                        search_word = "TypeError: Cannot read property ";
                        position = error_message.search(search_word);

                        if (position < 0) {
                            search_word = "TypeError: error.response ";
                            position = error_message.search(search_word);

                            if (position > 0) {
                                window.location.reload();
                                // this.$router.push('/users');
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
        }
    }
};
</script>
