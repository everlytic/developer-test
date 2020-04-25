<template>
    <div>
        <button class="btn-delete btn text-error" @click="openModal"><i class="fa fa-trash" aria-hidden="true"></i></button>

        <!-- The Modal -->
        <div id="myModal" class="modal text-align-left" v-if="showModal">
            <!-- Modal content -->
            <div class="modal-content">
                <h2>Confirm delete</h2>
                
                <form @submit="submit">
                    <div class="form-group">
                        <p>Please confirm that you would like to delete this user.</p>
                    </div>
                                        
                    <div class="text-align-right">
                        <button v-if="busy" type="submit" class="btn-black btn text-white">
                            <i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
                        </button>
                        <button type="submit" class="btn-white btn" @click="closeModal">Cancel</button>
                        <button type="submit" class="btn-black btn text-white">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user_id: {
                type: Number,
                required: true
            },
        },
        data() {
            return {
                busy: false,
                showModal: false,
            }
        },
        methods: {
            openModal() {
                this.showModal = true
            },
            closeModal() {
                this.showModal = false
            },
            submit() {
                this.errors = null
                this.busy = true

                axios.delete('/users/' + this.user_id).then(response => {
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