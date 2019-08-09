<template>
  <div class="box">
      <div class="login-box-body">
          <p class="login-box-msg">Create an account</p>
          <div class="form-group has-feedback" :class="{'has-error': errors.email}">
              <input @keyup.enter="signUp()"  type="email" v-model="userdata.email" class="form-control" placeholder="Email address">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              <span class="help-block" v-if="errors.email">{{ errors.email[0] }}</span>
          </div>
          <div class="form-group has-feedback" :class="{'has-error': errors.first_name}">
              <input @keyup.enter="signUp()"  type="text" v-model="userdata.first_name" class="form-control" placeholder="First name">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
              <span class="help-block" v-if="errors.first_name">{{ errors.first_name[0] }}</span>
          </div>
          <div class="form-group has-feedback" :class="{'has-error': errors.last_name}">
              <input @keyup.enter="signUp()"  type="text" v-model="userdata.last_name" class="form-control" placeholder="Last name">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
              <span class="help-block" v-if="errors.last_name">{{ errors.last_name[0] }}</span>
          </div>
          <div class="form-group has-feedback" :class="{'has-error': errors.password}">
              <input @keyup.enter="signUp()" type="password" v-model="userdata.password" class="form-control" placeholder="Set account password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <span class="help-block" v-if="errors.password">{{ errors.password[0] }}</span>
          </div>
          <div class="form-group has-feedback" :class="{'has-error': errors.password_confirmation}">
              <input @keyup.enter="signUp()" type="password" v-model="userdata.password_confirmation" class="form-control" placeholder="Confirm account password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <span class="help-block" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</span>
          </div>
          <div class="row">
              <div class="col-xs-4 pull-right">
                  <button @click="signUp()" type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
              </div>
          </div>
      </div>
      <p class="text-center" style="padding: 15px;">
          Already have an account? <router-link :to="{name: 'login'}" class="text-center">Sign in</router-link>
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
                first_name: '',
                last_name: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    methods: {
        signUp() {
            let _this = this;
            _this.loading = true;
            _this.errors = [];
            axios.post(`${baseUrl}/auth/register`, _this.userdata).then((res) => {
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
