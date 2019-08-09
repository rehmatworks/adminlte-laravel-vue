require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import { routes } from './routes/routes.js';
const router = new VueRouter({
    mode: 'history',
    routes: routes,
});

const app = new Vue({
    el: '#app',
    mounted() {
        if(typeof(this.$route.meta) != 'undefined' && typeof(this.$route.meta.title) != 'undefined') {
            document.title = this.$route.meta.title + ' | ' + appName;
        }
    },
    router: router
});

router.beforeEach((to, from, next) => {
    if(typeof(to.meta) != 'undefined' && typeof(to.meta.title) != 'undefined') {
        document.title = to.meta.title + ' | ' + appName;
    }
    next();
});
