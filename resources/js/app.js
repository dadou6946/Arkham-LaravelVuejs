import Vue from 'vue';
import VueRouter from 'vue-router';

import store from "./components/store/store";
import { routes } from "./routes";

Vue.use(VueRouter)

import App from './views/App';


const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
