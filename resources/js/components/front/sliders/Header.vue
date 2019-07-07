<template>
    
    <nav class="navbar navbar-expand-lg navbar-light" :class="{'bg-light':styleMenu,'menu1':!styleMenu}" >
      <a class="navbar-brand" :href="root"><img class="img-fluid logo d-md-none d-lg-block" :src="root+'/img/logo.png'" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"  aria-expanded="false" aria-label="Toggle navigation" data-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
         <ul class="navbar-nav mr-auto">
            <template v-if="styleMenu">
                <li class="nav-item">
                     <router-link to="/login" class="nav-item nav-link ancla" href="" v-show="!validAuthenticated">LOGIN</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/home" class="nav-item nav-link ancla" href="" v-show="validAuthenticated">HOME</router-link>
                </li>
                <li class="nav-item">
                    <a v-show="validAuthenticated"  @click="logout" class="nav-item nav-link ancla" href="#"  >CERRAR SESSION</a>
                </li>
            </template>
            <template v-else>
                       <li class="nav-item">
                        <router-link to="/login" class="nav-item nav-link ancla" href="" v-show="!validAuthenticated">LOGIN</router-link>
                      </li>
                      <li class="nav-item">
                        <a v-show="validAuthenticated"  @click="logout" class="nav-item nav-link ancla" href="#"  >CERRAR SESSION</a>
                      </li>
                </template>
            </ul>
        </div>
        </div>
    </nav>
</template>
<script>
    export default{
     props: ['user'],
     data(){
            return{
                root:null,
                style:false,
            }
        },
        mounted() {
            this.$store.dispatch('listComponents');
            this.root=window.location.origin;
            //console.log(window.location.pathname);
        },
        methods:{
            logout(){
                let vm = this;
                axios.post('api/logout')
                .then(response => {
                    vm.$store.commit('logout');
                    vm.$router.push('/login');
                    // location.reload();
                })
                .catch(error => {
                    console.log(error.response)
                });
            },
        },computed: {
          validAuthenticated(){
            console.log(this.$store.getters.getSession);
            if(this.$store.getters.getSession.name!=undefined){
              //this.name_user=this.$store.getters.getSession[0].name;
              return true;
            }else{
              return false;
            }
          },styleMenu(){
            return this.$route.path=="/";
          }
        }
    }
</script>
<style>
    .menu1{
        min-height: 100px!important;
        background-color: #e1ebf4!important;
    }
    /*.menu{
        height: 25vh!important;
    }*/
</style>