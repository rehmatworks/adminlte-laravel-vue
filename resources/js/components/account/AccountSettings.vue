<template>
<div>
    <section class="content-header">
        <h1>
            Account Settings
            <small>Manage your profile settings</small>
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
            errors: []
        }
    },
    mounted() {
        this.getUser();
    },
    methods: {
        updateProfile() {
            let _this = this;
            _this.loading = true;
            _this.errors = [];
            axios.post(`${baseUrl}/api/update-profile`, _this.user).then((res) => {
                _this.loading = false;
                _this.$parent.getUser();
            }).catch((err) => {
                _this.loading = false;
                _this.errors = err.response.data.errors;
            });
        }
    }
}
</script>
