<template>
  <div class="box">
      <div class="login-box-body">
          <p class="login-box-msg">Reset account password</p>
          <div class="form-group has-feedback" :class="{'has-error': errors.email}">
              <input :disabled="loading" @keyup.enter="resetPassword()" type="email" v-model="userdata.email" class="form-control" placeholder="Email address">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              <span class="help-block" v-if="errors.email">{{ errors.email[0] }}</span>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <button :disabled="loading" @click="resetPassword()" type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
              </div>
          </div>
      </div>
      <p class="text-center" style="padding: 15px;">
          Recalled your login info? <router-link :to="{name: 'login'}" class="text-center">Back to Login</router-link>
      </p>
      <div v-if="loading" class="overlay">
          <i class="fa fa-refresh fa-spin"></i>
      </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            userdata: {
                email: ''
            }
        }
    },
    methods: {
        resetPassword() {
            let _this = this;
            _this.loading = true;
            _this.errors = [];
            axios.post(`${baseUrl}/auth/reset`, _this.userdata).then((res) => {
                _this.loading = false;
                _this.userdata.email = '';
                _this.showToast('Reset link sent! Please check your email', 'success');
            }).catch((err) => {
                _this.loading = false;
                if(err.response.data.errors) {
                    _this.errors = err.response.data.errors;
                } else {
                    _this.showToast('Something went wrong', 'error');
                }
            });
        }
    }
}
</script>

<style lang="css" scoped>
</style>
