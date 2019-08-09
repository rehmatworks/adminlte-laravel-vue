require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

Vue.component('notifications-component', require('./components/common/NotificationsComponent').default);

import { routes } from './routes/routes.js';
const router = new VueRouter({
    mode: 'history',
    routes: routes,
});

Vue.mixin({
    data() {
        return {
            user: false,
            loading: false
        }
    },
    methods: {
        getUser() {
            let _this = this;
            _this.loading = true;
            axios.get(`${baseUrl}/api/user`).then((res) => {
                _this.user = res.data;
                _this.loading = false;
            }).catch((err) => {
                _this.loading = false;
            });
        }
    }
});

const app = new Vue({
    el: '#app',
    mounted() {
        if(typeof(this.$route.meta) != 'undefined' && typeof(this.$route.meta.title) != 'undefined') {
            document.title = this.$route.meta.title + ' | ' + appName;
        }
        if(!['register', 'login'].includes(this.$route.name)) {
            this.getUser();
        }
    },
    methods: {
        signOut() {
            axios.post(`${baseUrl}/signout`).then((res) => {
                window.location = `${baseUrl}/login`;
            });
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
