<template>
  <div class="signin-wrapper">

      <div class="signin-box signup">
        <h2 class="slim-logo"><a href="index.html">slim<span>.</span></a></h2>
        <h3 class="signin-title-primary">Get Started!</h3>
        <h5 class="signin-title-secondary lh-4">It's free to signup and only takes a minute.</h5>

        <div class="row row-xs mg-b-10">
          <div class="col-sm"><input type="text" class="form-control" placeholder="Firstname"></div>
          <div class="col-sm mg-t-10 mg-sm-t-0"><input type="text" class="form-control" placeholder="Lastname"></div>
        </div><!-- row -->

        <div class="row row-xs mg-b-10">
          <div class="col-sm"><input type="email" class="form-control" placeholder="Email"></div>
          <div class="col-sm mg-t-10 mg-sm-t-0"><input type="password" class="form-control" placeholder="Password"></div>
        </div><!-- row -->

        <button class="btn btn-primary btn-block btn-signin">Sign Up</button>

        <div class="signup-separator"><span>or signup using</span></div>

        <button class="btn btn-facebook btn-block">Sign Up Using Facebook</button>
        <button class="btn btn-twitter btn-block">Sign Up Using Twitter</button>

        <p class="mg-t-40 mg-b-0">Already have an account? <a href="page-signin.html">Sign In</a></p>
      </div><!-- signin-box -->

    </div><!-- signin-wrapper -->
</template>

<script>
export default {
  data () {
    return {
      form: {
        email: '',
        password: ''
      },
    }
  },
  methods: {
    doLogin(){
      this.$validator.validateAll().then((result) => {
        if(result){
          var slf = this;
          axios.post('api/login', this.form).then((res)=>{
              console.log(res.data);
              if (res.data.status == 200)  {
                  Vue.toasted.show(res.data.msg, {icon: 'plus', type: 'success'})
                  slf.$store.dispatch('setSession',res.data.user);

                  slf.$router.push('/playfair');
              }else if(res.data.status == 401){
                Vue.toasted.show(res.data.msg, {icon: 'exclamation-triangle', type: 'error'})
              }
          })
          .catch((error)=>{
            if(error.response.status=422){
                this.alert.oper='danger';
                this.alert.msg='Error en los datos de autenticación';
            }
          })
        }
      }).catch(() => {console.log('error form')});
    }
  },computed: {
    
  },
}
</script>
<style>

</style>

<!-- b-form-1.vue -->