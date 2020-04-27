<template>
    <div>
        <div class="text-align-right">
            <button class="btn-black btn text-white" @click="openModal">Add new user</button>
        </div>

        <!-- The Modal -->
        <div id="myModal" class="modal" v-if="showModal">
            <!-- Modal content -->
            <div class="modal-content">
                <h2>Add new user</h2>
                
                <form @submit.prevent="submit">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            placeholder="Enter your name"
                            class="form-control"
                            :class="errors && errors.name ? 'input-error' : ''"
                            name="name"
                            id="name" 
                            v-model="user.name"
                        />
                        <div v-if="errors && errors.name" class="form-error text-error">{{ errors.name[0] }}</div>
                    </div>

                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input
                            type="text"
                            placeholder="Enter your surname"
                            class="form-control"
                            :class="errors && errors.surname ? 'input-error' : ''"
                            name="surname"
                            id="surname"
                            v-model="user.surname"
                        />
                        <div v-if="errors && errors.surname" class="form-error text-error">{{ errors.surname[0] }}</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            placeholder="Enter your email"
                            class="form-control"
                            :class="errors && errors.email ? 'input-error' : ''"
                            name="email"
                            id="email"
                            v-model="user.email"
                        />
                        <div v-if="errors && errors.email" class="form-error text-error">{{ errors.email[0] }}</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input
                            type="position"
                            placeholder="Enter your position"
                            class="form-control"
                            :class="errors && errors.position ? 'input-error' : ''"
                            name="position"
                            id="position"
                            v-model="user.position"
                        />
                        <div v-if="errors && errors.position" class="form-error text-error">{{ errors.position[0] }}</div>
                    </div>
                    
                    <div class="text-align-right">
                        <button v-if="busy" type="submit" class="btn-black btn text-white">
                            <i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
                        </button>
                        <button type="submit" class="btn-white btn" @click="closeModal">Cancel</button>
                        <button type="submit" class="btn-black btn text-white">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showModal: false,
                user: {
                    'name': null,
                    'surname': null,
                    'email': null,
                    'position': null,
                },
                errors: null,
                busy: false,
            }
        },
        methods: {
            openModal() {
                this.showModal = true
            },
            closeModal() {
                this.showModal = false
                this.errors = null
                this.clearInputs()
            },
            clearInputs() {
                this.user.name = null
                this.user.surname = null
                this.user.email = null
                this.user.position = null
            },
            submit() {
                this.errors = null
                this.busy = true

                axios.post('/users', this.user).then(response => {
                    this.showModal = false
                    this.clearInputs()
                    window.location.reload()
                }).catch(error => {
                    this.busy = false
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        }
    }
</script>
