<template>
  <div class="box">
      <div class="login-box-body">
          <div class="alert alert-warning" v-if="!loading && !validToken">
              Password reset token is either invalid or expired.
          </div>
          <p class="login-box-msg">Update Account Password</p>
          <div class="form-group has-feedback" :class="{'has-error': errors.password}">
              <input :disabled="loading || !validToken" @keyup.enter="updatePassword()" type="password" v-model="userdata.password" class="form-control" placeholder="Set account password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <span class="help-block" v-if="errors.password">{{ errors.password[0] }}</span>
          </div>
          <div class="form-group has-feedback" :class="{'has-error': errors.password_confirmation}">
              <input :disabled="loading || !validToken" @keyup.enter="updatePassword()" type="password" v-model="userdata.password_confirmation" class="form-control" placeholder="Confirm account password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <span class="help-block" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</span>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <button :disabled="loading || !validToken" @click="updatePassword()" type="submit" class="btn btn-primary btn-block btn-flat">Update Password</button>
              </div>
          </div>
      </div>
      <p class="text-center" style="padding: 15px;">
          Recalled your login info? <router-link :to="{name: 'login'}" class="text-center">Back to login</router-link>
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
            validToken: false,
            userdata: {
                email: this.$route.query.email,
                token: this.$route.query.token,
                password: '',
                password_confirmation: ''
            }
        }
    },
    mounted() {
        let _this = this;
        _this.loading = true;
        axios.post(`${baseUrl}/auth/check-token`, {token: this.$route.query.token, email: this.$route.query.email}).then((res) => {
            _this.loading = false;
            if(res.data.valid) {
                _this.validToken = true;
            } else {
                _this.validToken = false;
                _this.showToast('Token is invalid', 'error');
            }
        }).catch((err) => {
            _this.loading = false;
            _this.validToken = false;
            _this.showToast('Token is invalid', 'error');
        });
    },
    methods: {
        updatePassword() {
            let _this = this;
            _this.loading = true;
            _this.errors = [];
            axios.post(`${baseUrl}/auth/update-password`, _this.userdata).then((res) => {
                _this.loading = false;
                _this.showToast('Password updated', 'success');
                window.setTimeout(function() {
                    window.location = '';
                }, 2000);
            }).catch((err) => {
                _this.loading = false;
                if(err.response.data.errors) {
                    _this.errors = err.response.data.errors;
                }
            });
        }
    }
}
</script>

<style lang="css" scoped>
</style>
