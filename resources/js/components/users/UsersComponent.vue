<template>
<div>
    <section class="content-header">
        <h1>
            Manage Users <span v-if="users.total">({{ users.total }})</span>
            <small>Add or update users</small>
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div style="margin:0px;" class="form-group">
                    <input @keyup.enter="getUsers()" v-model="q" type="text" class="form-control" placeholder="Type and hit enter to search users...">
                </div>
            </div>
            <div class="box-body">
                <div v-if="users.total" class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined</th>
                                <th></th>
                            </tr>
                            <tr v-for="user in users.data">
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.membersince }}</td>
                                <td class="text-right">
                                    <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                    <router-link class="btn btn-xs btn-info" :to="{name: 'account-settings', params:{userId: user.id}}"><i class="fa fa-edit"></i></router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>
                    <div v-if="!loading">
                        <div class="text-center" v-if="hasSearch">
                            <h4>No results found for your search query! <a href="javascript:void(0)" @click="resetSearch()">Reset Search</a></h4>
                        </div>
                        <div v-else class="text-center text-muted">
                            <h4>No users found!</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="loading" class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
          </div>
    </section>
</div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            q: '',
            hasSearch: false
        }
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        getUsers() {
            let _this = this;
            _this.loading = true;
            _this.hasSearch = _this.q;
            axios.get(`${baseUrl}/api/users?q=${this.q}`).then((res) => {
                _this.loading = false;
                _this.users = res.data;
            }).catch((err) => {
                _this.loading = false;
                _this.showToast('Something went wrong', 'error');
            });
        },
        resetSearch() {
            this.q = '';
            this.getUsers();
        }
    }
}
</script>
