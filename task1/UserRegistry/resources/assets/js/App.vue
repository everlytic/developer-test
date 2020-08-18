<template>
    <div class="container">
        <vue-confirm-dialog></vue-confirm-dialog>
        <div>
            <router-link to="/" class="nav-link">List Users</router-link> | <router-link to="/create" class="nav-link">Add User</router-link>
        </div>
        <br />
        <transition name="fade">
            <router-view></router-view>
        </transition>
        <footer class="page-footer">
            <div class="footer-copyright">
                <div class="container">
                    <span style="float:right"
                        >&copy; 2020
                        <a
                            href="https://za.linkedin.com/in/omphemetse-samuel-lawrence-mafoko-b3620a15"
                            target="_blank"
                            style="color:black;text-decoration:none"
                            >Omphemetse Samuel Lawrence Mafoko.</a
                        ></span
                    >
                </div>
            </div>
        </footer>
    </div>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-active {
    opacity: 0;
}
</style>

<script>
export default {};
</script>
