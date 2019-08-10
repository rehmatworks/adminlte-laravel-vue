<template>
<div>
    <section class="content-header">
        <h1>
            Account Settings
            <span v-if="!loading">
                <small v-if="user && $route.params.userId">Update {{ user.first_name }}'s profile</small>
                <small v-else>Update your profile</small>
            </span>
        </h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">General Profile</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.first_name}">
                            <label>First Name</label>
                            <input :disabled="loading" @keyup.enter="updateProfile()" type="text" v-model="user.first_name" class="form-control" placeholder="First name...">
                            <span class="help-block" v-if="errors.first_name">{{ errors.first_name[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.last_name}">
                            <label>Last Name</label>
                            <input :disabled="loading" @keyup.enter="updateProfile()" type="text" v-model="user.last_name" class="form-control" placeholder="Last name...">
                            <span class="help-block" v-if="errors.last_name">{{ errors.last_name[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.email}">
                            <label>Email</label>
                            <input :disabled="loading" @keyup.enter="updateProfile()" type="text" v-model="user.email" class="form-control" placeholder="Email address...">
                            <span class="help-block" v-if="errors.email">{{ errors.email[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="$parent.userCan('manage-roles') && $parent.user.id != user.id">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.role}">
                            <select class="form-control" v-model="user.roleid">
                                <option value="">No role assigned</option>
                                <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.bio}">
                            <label>Biography</label>
                            <textarea rows="6" :disabled="loading" v-model="user.bio" class="form-control" placeholder="Biography..."></textarea>
                            <span class="help-block" v-if="errors.bio">{{ errors.bio[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button :disabled="loading" @click="updateProfile()" class="btn btn-primary">Update Profile</button>
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
            errors: [],
            roles: []
        }
    },
    mounted() {
        if(this.$route.params.userId)
        {
            this.getUser(this.$route.params.userId);
        } else {
            this.getUser();
        }
        this.getRoles();
    },
    methods: {
        updateProfile() {
            let _this = this;
            _this.loading = true;
            _this.errors = [];
            _this.user.role = _this.role;
            axios.patch(`${baseUrl}/api/users/${_this.user.id}`, _this.user).then((res) => {
                _this.loading = false;
                _this.showToast('Profile has been updated', 'success');
                _this.$parent.getUser();
            }).catch((err) => {
                _this.loading = false;
                if(err.response.data.errors) {
                    _this.errors = err.response.data.errors;
                } else {
                    _this.showToast('Profile cannot be updated', 'error');
                }
            });
        },
        getRoles() {
            let _this = this;
            _this.loading = true;
            axios.get(`${baseUrl}/api/get-roles`).then((res) => {
                _this.loading = false;
                _this.roles = res.data;
            }).catch((err) => {
                _this.loading = false;
                _this.showToast('Something went wrong', 'error');
            });
        }
    }
}
</script>
