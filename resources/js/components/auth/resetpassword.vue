<template>
  <b-container>
      <b-row class="justify-content-center">
        <b-col md="8" >
          <div class="signin-wrapper">
          <div class="signin-box">
            <h2 class="slim-logo"><a href="index.html">slim<span>.</span></a></h2>
            <h2 class="signin-title-primary">{{trans('app.resetpassword.welcome')}}</h2>
            <h3 class="signin-title-secondary">{{trans('app.resetpassword.reset_password')}}</h3>
              <!-- <b-form> -->
                <div class="form-group">
                  <input v-model="form.email" type="text" class="form-control" placeholder="Enter your email">
                </div><!-- form-group -->
                <div class="form-group ">
                  <input v-model="form.password" type="password" class="form-control" placeholder="Enter your password">
                </div><!-- form-group -->
                <div class="form-group mg-b-50">
                  <input v-model="form.password_confirmation" type="password" class="form-control" placeholder="Confirm password">
                </div><!-- form-group -->
                <button class="btn btn-primary btn-block btn-signin"  @click="setPass" variant="primary">{{trans('app.resetpassword.reset_password')}}</button>
                
          </div><!-- signin-box -->

        </div><!-- signin-wrapper -->
          
        </b-col>
      </b-row>
  </b-container>
</template>
<script>
  export default {
  data () {
    return {
      csrf_token: axios.defaults.headers.common['X-CSRF-TOKEN'],
      validemail:true,
      form: {
        email: '',
        password: '',
        password_confirmation:'',
        token:this.$route.params.hash,
      },
    }
  },mounted() {
      this.validView();
  },methods: {
    validView(){
      var sfl=this;
      var obj={};
      obj.hash=this.form.token;
      axios.post('../../validViewHash',obj)
        .then(response => {
           console.log(response);
        })
        .catch(error => {
            console.log(error.response)
        });
    },
    resetError(){
      this.alert.msg=null;
      this.alert.oper=null;
      this.validemail=true;
    },
    setPass(){   
      this.$validator.validateAll().then((result) => {
        if(result){
          this.sendForm();
        }
      }).catch(() => {console.log('error form')});
    },
    sendForm(){  
      // '../../api/password/reset'
      axios.post('/password/reset', this.form).then((res)=>{
          console.log(res);
          if (res.status == 200)  {
            var sfl=this;
            axios.post('../../logout')
              .then(response => {
                  sfl.$store.commit('logout');
                  sfl.$router.push('/login');
                  Vue.toasted.show(res.data.msg, {icon: 'plus', type: 'success'})
              })
              .catch(error => {
                  console.log(error.response)
              });
          }
      },(err) => {
        console.log(err.response.data.errors)

        if (err.response.data.errors.password) {
          for (var i = err.response.data.errors.password[0].length - 1; i >= 0; i--) {
            
          Vue.toasted.show(err.response.data.errors.password[i], {icon: 'exclamation-triangle', type: 'error'})
          }
          
        }else if (err.response.data.errors.email){
          for (var i = err.response.data.errors.email[0].length - 1; i >= 0; i--) {
            
          Vue.toasted.show(err.response.data.errors.email[i], {icon: 'exclamation-triangle', type: 'error'})
          }
        }
              //email error from Laravel
          
      })
      .catch((error)=>{
        console.log(error);
        // Vue.toasted.show(error, {icon: 'exclamation-triangle', type: 'error'})
      });
    }
  }
}
</script>

