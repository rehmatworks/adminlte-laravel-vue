<template>
<div>
    <section class="content-header">
        <h1>
            Manage Users
            <small>Add or update users</small>
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Users <span v-if="users.total">({{ users.total }})</span></h3>
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
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>
                    <div v-if="!loading">
                        <div class="text-center" v-if="q">
                            No results found for your search query <strong>{{ q }}</strong>.
                        </div>
                        <div class="text-center text-muted">
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
            q: ''
        }
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        getUsers() {
            let _this = this;
            _this.loading = true;
            axios.get(`${baseUrl}/api/users`).then((res) => {
                _this.loading = false;
                _this.users = res.data;
            }).catch((err) => {
                _this.loading = false;
                _this.showToast('Something went wrong', 'error');
            });
        }
    }
}
</script>
