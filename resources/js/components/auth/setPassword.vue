<template>
  <b-container class="pt-5">
    <div :class="loading ? 'box-loading' : ''">
      <b-row class="justify-content-center">
        <b-col md="8" >
          <div class="signin-wrapper">
            <div class="signin-box">
              <div class="panel-heading">
                <center>
                <spinner v-if="loading" :size="120" color="#4469e8"/>
              </center>
              <div>
                <router-link to="/login" class="mg-b-0 btn btn-link" href="">
              <a class="positionL" href="#">Login</a>  
              </router-link>
              </div>
              <!-- slim-logo -->
              <h2 class=""><a href="/">slim<span>.</span></a></h2>
              <h3 class="signin-title-secondary">{{trans('app.setpassword.reset_password')}}</h3>
              <div class="clearfix"></div>
              </div>
              
                <!-- <b-form> -->
                <div class="form-group">
                  <input v-model="form.email" type="text" class="form-control" placeholder="Enter your email">
                </div><!-- form-group -->
                <button class="btn btn-primary btn-block btn-signin"  @click="ValidEmail" variant="primary">{{trans('app.setpassword.reset')}}</button>
            </div><!-- signin-box -->
          </div><!-- signin-wrapper -->
        </b-col>
      </b-row>
    </div>
    
  </b-container>

</template>

<style type="text/css">
  
  .fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
  opacity: 0
}
.box-loading {
  background: #ffff;
  opacity: 0.5;
  filter: alpha(opacity=5);
}
.positionL{
  margin-left: 260px; 
  position: relative; 
  bottom: 20px; 
  font-size: 15px;
}
</style>

<script>
export default {
  data () {
    return {
      form: {
        email: ''
      },
      loading: false,
      validemail:true,      
    }
  },
  methods: {
    ValidEmail() {
      this.$validator.validateAll().then((result) => {
          this.loading = true
          if(result){
            var slf=this;
            axios.post('../api/validEmail', this.form).then((res)=>{
              slf.loading = false
                if (res.status == 200)  {
                  if(slf.$store.getters.getSession.name!=undefined){
                    slf.validemail=false
                    slf.loading = false
                    Vue.toasted.show('Debe cerrar la session para continuar', {icon: 'exclamation-triangle', type: 'error'})
                    //slf.$router.push('/home');
                  }else{
                    if(res.data.oper==true){
                      slf.loading = false
                      Vue.toasted.show(res.data.msg, {icon: 'plus', type: 'success'})
                    }else{
                      slf.loading = false
                      Vue.toasted.show(res.data.msg, {icon: 'exclamation-triangle', type: 'error'})
                      slf.validemail=false;
                    }
                  }
                }
            })
            .catch((error)=>{
              this.validemail=false
              this.loading = false
              Vue.toasted.show(error.response.data.msg, {icon: 'exclamation-triangle', type: 'error'})
            });
        }
      }).catch(() => {console.log('error form')});
      
    }
  }
}
</script>
