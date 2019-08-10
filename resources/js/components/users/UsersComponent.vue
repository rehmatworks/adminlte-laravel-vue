<template>
<div>
    <section class="content-header">
        <h1>
            Manage Users <span v-if="users.total">({{ users.total }})</span>
            <small>Add, update or delete users</small>
            <button :class="{'btn-primary': !addUser, 'btn-warning': addUser}" @click="addUser=!addUser" class="btn btn-sm pull-right">
                <span v-if="addUser"><i class="fa fa-times-circle"></i> Cancel Adding</span>
                <span v-else><i class="fa fa-plus-circle"></i> Add New</span>
            </button>
        </h1>
    </section>
    <section class="content">
        <div class="box" v-if="addUser">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.first_name}">
                            <label>First Name</label>
                            <input @keyup.enter="createUser()" v-model="newUser.first_name" :disabled="adding" type="text" class="form-control" placeholder="First name">
                            <span class="help-block" v-if="errors.first_name">{{ errors.first_name[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12" :class="{'has-error': errors.last_name}">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input @keyup.enter="createUser()" v-model="newUser.last_name" :disabled="adding" type="text" class="form-control" placeholder="Last name">
                            <span class="help-block" v-if="errors.last_name">{{ errors.last_name[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12" :class="{'has-error': errors.email}">
                        <div class="form-group">
                            <label>Email</label>
                            <input @keyup.enter="createUser()" v-model="newUser.email" :disabled="adding" type="text" class="form-control" placeholder="Email">
                            <span class="help-block" v-if="errors.email">{{ errors.email[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.password}">
                            <label>Password</label>
                            <input @keyup.enter="createUser()" v-model="newUser.password" :disabled="adding" type="password" class="form-control" placeholder="Set account password">
                            <span class="help-block" v-if="errors.password">{{ errors.password[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <button @click="createUser()" :disabled="adding" style="margin-top: 25px;" class="btn btn-primary">Add User</button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="adding" class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
        <div class="box">
            <div class="box-header with-border">
                <div style="margin:0px;" class="form-group">
                    <input :disabled="loading" @keyup.enter="getUsers()" v-model="q" type="text" class="form-control" placeholder="Type and hit enter to search users...">
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
                                    <button @click="deleting = false" v-if="deleting == user.id" class="btn btn-xs btn-success">Cancel</button>
                                    <button @click="deleteUser(user.id)" v-if="deleting == user.id" class="btn btn-xs btn-danger">Delete</button>
                                    <button v-if="deleting != user.id" @click="deleting = user.id" class="btn btn-xs btn-warning"><i class="fa fa-trash"></i></button>
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
                <div class="row text-center">
                    <pagination v-if="users.total" :data="users" @pagination-change-page="getUsers"></pagination>
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
            errors: [],
            hasSearch: false,
            deleting: false,
            addUser: false,
            adding: false,
            newUser: {
                first_name: '',
                last_name: '',
                email: '',
                password: ''
            }
        }
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        createUser() {
            let _this = this;
            _this.adding = true;
            _this.errors = [];
            axios.post(`${baseUrl}/api/users`, _this.newUser).then((res) => {
                _this.adding = false;
                _this.newUser = {
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: '',
                };
                _this.showToast('User has been added', 'success');
                _this.getUsers();
            }).catch((err) => {
                _this.adding = false;
                if(err.response.data.errors) {
                    _this.errors = err.response.data.errors;
                } else {
                    _this.showToast('Something went wrong', 'error');
                }
            });
        },
        getUsers(page = 1) {
            let _this = this;
            _this.loading = true;
            _this.hasSearch = _this.q;
            axios.get(`${baseUrl}/api/users?q=${this.q}&page=${page}`).then((res) => {
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
        },
        deleteUser(userId) {
            let _this = this;
            _this.loading = true;
            axios.delete(`${baseUrl}/api/users/${userId}`).then((res) => {
                _this.getUsers();
                _this.loading = false;
                _this.deleting = false;
                _this.showToast('User has been deleted.', 'warning');
            }).catch((err) => {
                _this.loading = false;
                _this.showToast('User cannot be deleted.', 'error');
            });
        }
    }
}
</script>
