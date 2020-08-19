require("./bootstrap");

window.Vue = require("vue");

import VueRouter from "vue-router";
Vue.use(VueRouter);

import VueAxios from "vue-axios";
import axios from "axios";

import App from "./App.vue";
Vue.use(VueAxios, axios);

import VueBootstrapToasts from "vue-bootstrap-toasts";
Vue.use(VueBootstrapToasts);

import VueConfirmDialog from "vue-confirm-dialog";
Vue.use(VueConfirmDialog);

import Dialog from 'vue-utopia-dialog'
import 'vue-utopia-dialog/dist/css/dialog.css'
Vue.use(Dialog);

import axiosRetry from 'axios-retry';
axiosRetry(axios, { retries: 3 });

import CreateComponent from "./components/CreateComponent.vue";
import IndexComponent from "./components/IndexComponent.vue";
Vue.component("pagination", require("laravel-vue-pagination"));

const routes = [{
        name: "index",
        path: "/",
        redirect: { name: "users" }
    },
    {
        name: "users",
        path: "/users",
        component: IndexComponent
    },
    {
        name: "create",
        path: "/create",
        component: CreateComponent
    }
];

const router = new VueRouter({ mode: "history", routes: routes });
const app = new Vue(Vue.util.extend({ router }, App)).$mount("#app");