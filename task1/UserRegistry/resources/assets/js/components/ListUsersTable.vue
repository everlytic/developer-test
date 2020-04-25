<template>
    <div>
        <table>
            <tbody>
                <tr v-for="(user, index) in users" :key="user.email" :class="(index + 1) % 2 != 0 ? 'odd' : 'even'">
                    <td class="w-25">{{ user.full_name }}</td>
                    <td class="w-50">{{ user.position }}</td>
                    <td class="w-25 text-align-right"><delete-user-button :user_id="user.id"></delete-user-button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            users: {
                type: Array,
                required: true
            },
        },
        data() {
            return {
                errors: null,
            }
        },
        methods: {
            submit() {
                this.errors = null

                axios.delete('/users/' + this.user_id).then(response => {
                    alert('User Deleted!');
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        }
    }
</script>
