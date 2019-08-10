require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Toasted from 'vue-toasted';
Vue.use(Toasted);

Vue.component('pagination', require('laravel-vue-pagination'));

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
        getUser(userId = false) {
            let _this = this;
            _this.loading = true;
            if(userId) {
                var reqUrl = `${baseUrl}/api/users/${userId}`;
            } else {
                var reqUrl = `${baseUrl}/api/users/get`;
            }
            axios.get(reqUrl).then((res) => {
                _this.user = res.data;
                _this.loading = false;
            }).catch((err) => {
                _this.loading = false;
                _this.showToast('Something went wrong', 'error');
            });
        },
        showToast(msg, type = 'info') {
            if(type == 'success') {
                var icon = 'fa-check-circle';
            } else if(type == 'error') {
                var icon = 'fa-times-circle';
            } else {
                var icon = 'fa-check-circle';
            }
            this.$toasted.show(msg, {
                theme: 'outline',
                type: type,
                duration: 3000,
                iconPack: 'fontawesome',
                icon: icon
            });
        },
        userCan(permission) {
            return this.user.issuperadmin || (this.user && this.user.allpermissions && this.user.allpermissions.includes(permission));
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
