<template>
    <div>
        <button>Add new user</button>
        <div>
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" v-model="user.name" />
                    <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
                </div>

                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" name="surname" id="surname" v-model="user.surname" />
                    <div v-if="errors && errors.surname" class="text-danger">{{ errors.surname[0] }}</div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" v-model="user.email" />
                    <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                </div>
                
                <div class="form-group">
                    <label for="position">Position</label>
                    <input type="position" class="form-control" name="position" id="position" v-model="user.position" />
                    <div v-if="errors && errors.position" class="text-danger">{{ errors.position[0] }}</div>
                </div>
                
                <button type="submit" class="btn btn-primary">Loader</button>
                <button type="submit" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                user: {
                    'name': null,
                    'surname': null,
                    'email': null,
                    'position': null,
                },
                errors: null,
            }
        },
        methods: {
            submit() {
                this.errors = null

                axios.post('/users', this.user).then(response => {
                    alert('Message sent!');
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        }
    }
</script>
