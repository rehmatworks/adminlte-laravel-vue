<template>
    <li class="dropdown notifications-menu">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span v-if="notifs.length" class="label label-warning">{{ notifs.length }}</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have {{ notifs.length }} notifications</li>
            <li>
                <ul class="menu" v-if="notifs.length">
                    <li>
                        <a href="javascript:void(0)" v-for="notif in notifs" @click="clearNotif(notif)">
                            <i :class="[`fa-${notif.data.icon} text-${notif.data.class}`]" class="fa"></i> {{ notif.data.message }}
                        </a>
                    </li>
                </ul>
                <p v-else class="text-muted text-center">No notifications found.</p>
            </li>
            <li class="footer"><a @click="clearNotifs()" href="javascript:void(0)">Clear all</a></li>
        </ul>
    </li>
</template>

<script>
export default {
    data() {
        return {
            notifs: []
        }
    },
    mounted() {
        this.getNotifs();
    },
    methods: {
        clearNotifs() {
            let _this = this;
            axios.post(`${baseUrl}/api/clear-notifs`).then((res) => {
                _this.getNotifs();
            });
        },
        getNotifs() {
            let _this = this;
            axios.get(`${baseUrl}/api/get-notifs`).then((res) => {
                _this.notifs = res.data;
            });
        },
        clearNotif(notif) {
            let _this = this;
            axios.post(`${baseUrl}/api/clear-notifs/${notif.id}`).then((res) => {
                _this.getNotifs();
                if(notif.data.url) {
                    window.location = notif.data.url;
                }
            });
        }
    }
}
</script>
