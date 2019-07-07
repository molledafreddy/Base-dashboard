<template>
  <b-container class="pt-5">
    <b-row class="justify-content-center">
      <b-col md="8" >
        <div class="signin-wrapper">
          <div class="signin-box">
            <h2 class="slim-logo"><a href="/"><span :class="'tx-'+color.tx">slim.</span></a></h2>
            <h2 class="signin-title-primary">{{trans('app.login.welcome')}}</h2>
            <h3 class="signin-title-secondary">{{trans('app.login.subtitle')}}</h3>
              <!-- <b-form> -->
                <div class="form-group">
                  <input v-model="form.email" type="text" class="form-control" placeholder="Enter your email">
                </div><!-- form-group -->
                <div class="form-group mg-b-50">
                  <input v-model="form.password" type="password" class="form-control" placeholder="Enter your password">
                </div><!-- form-group -->
                <template v-if="errorCred">
                  <div class="alert alert-danger mt text-center" role="alert">
                    </button>
                    {{trans('app.login.error_credentials')}}
                  </div><!-- alert -->
                </template>

                <b-button class="btn btn-primary btn-block btn-signin" :class="'bg-'+color.bg" type="submit" @click.prevent="doLogin" variant="primary" >{{trans('app.login.sign_in')}}</b-button>
                
                <p class="mg-b-0">{{trans('app.login.reset_password')}} 
                  <router-link to="/password/reset" :class="'tx-'+color.tx" class="mg-b-0 btn btn-link" href="">{{trans('app.login.reset')}}</router-link>
                </p>
                <!-- </b-form> -->
            
          </div><!-- signin-box -->

        </div><!-- signin-wrapper -->
      </b-col>
    </b-row>
  </b-container>
</template>
<style type="text/css">
  .mt{
   margin-bottom: 20px;
  }
  .tx-danger {
    color: #dc3545 !important; }
  a.tx-danger:hover, a.tx-danger:focus {
  color: #d32535 !important; }
</style>

<script>
export default {
  data () {
    return {
      form: {
        email: '',
        password: '',
      },
      errorCred:false,
    }
  },
  created(){
    this.getColor()
  },
  methods: {
    closeMessage(){
      this.errorCred=false
    },
    getColor(){
        this.$store.dispatch('getColor')
    },
    doLogin(){
      this.$validator.validateAll().then((result) => {
        if(result){
          var slf = this;
          // api/auth/login
          axios.post('login', this.form).then((res)=>{
              console.log(res.data);
              if (res)  {
                  Vue.toasted.show(res.data.msg, {icon: 'plus', type: 'success'})
                  slf.$store.dispatch('setSession',res.data.user)
                  slf.$store.dispatch('getLangs', res.data.defaultLang)
                  slf.$store.dispatch('setLangSession',res.data.defaultLang)
                  slf.$router.push('/admin')
              }else if(res.data.status == 401){
                console.log(res.data.msg)
                slf.errorCred=true
                 let self = this;
                setTimeout(function(){
                    self.errorCred=false
                }, 4000);
              }
          })
          .catch((error)=>{
            if(error.response.status=422){
              console.log(error.response);
                // Vue.toasted.show('Error en los datos de autenticación', {icon: 'exclamation-triangle', type: 'error'})
                this.errorCred=true
            }
          })
        }
      }).catch(() => {console.log('error form')});
    }
  },computed: {
      color(){
        return this.$store.getters.getColor
      },
  },
}
</script>


<!-- b-form-1.vue -->