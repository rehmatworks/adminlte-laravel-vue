<template>
  <div class="box">
      <div class="login-box-body">
          <p class="login-box-msg">Sign in to your account</p>
          <div class="form-group has-feedback" :class="{'has-error': errors.email}">
              <input :disabled="loading" @keyup.enter="signIn()" type="email" v-model="userdata.email" class="form-control" placeholder="Email address">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              <span class="help-block" v-if="errors.email">{{ errors.email[0] }}</span>
          </div>
          <div class="form-group has-feedback" :class="{'has-error': errors.password}">
              <input :disabled="loading" @keyup.enter="signIn()" type="password" v-model="userdata.password" class="form-control" placeholder="Account password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <span class="help-block" v-if="errors.password">{{ errors.password[0] }}</span>
              <small>Forgot your password? <a href="/">Reset it here</a></small>
          </div>
          <div class="row">
              <div class="col-xs-4 pull-right">
                  <button :disabled="loading" @click="signIn()" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
          </div>
      </div>
      <p class="text-center" style="padding: 15px;">
          Need an account? <router-link :to="{name: 'register'}" class="text-center">Sign Up</router-link>
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
                email: '',
                password: ''
            }
        }
    },
    methods: {
        signIn() {
            let _this = this;
            _this.loading = true;
            _this.errors = [];
            axios.post(`${baseUrl}/auth/login`, _this.userdata).then((res) => {
                _this.loading = false;
                window.location = '/';
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
