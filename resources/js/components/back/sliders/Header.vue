<template>
  <div class="slim-header with-sidebar ">
    <div class="container-fluid">
      <div class="slim-header-left tx-danger">
        <h2 class="slim-logo ">
          <a @click="admin" href="#"><span :class="'tx-'+color.tx">slim.</span></a></h2>
        <a href="#" id="slimSidebarMenu" class="slim-sidebar-menu"><span ></span></a>
        <div class="search-box">
          
          <input type="text" class="form-control" placeholder="Search">
          <button  class="btn btn-primary" :class="'bg-'+color.tx"><i class="fa fa-search"></i></button>
        </div><!-- search-box -->
      </div><!-- slim-header-left -->
      <div class="slim-header-right">

        <div class="dropdown dropdown-c" data-toggle="tooltip" title="Langs">
            <a href="#" class="header-notification" data-toggle="dropdown">
              <img width="22" height="22" thumbnail :src="langS =='es' ? '/images/es.svg' : '/images/en.svg'" alt="img">
            </a>
          <div class="dropdown-menu dropdown-menu-right">
            <nav class="nav">
              <a href="" @click="lang('es')" class="nav-link mg-l-5  " :class="langS== 'es' ? 'dropdown-item active' : '' "><b-img thumbnail width="35" height="35" src="/images/es.svg" alt="Thumbnail"/> <span class="mg-l-15" style="font-size: 15px;">{{trans('app.header.spain')}}</span> </a>
              <a href="" @click="lang('en')" class="nav-link mg-l-5  " :class="langS== 'en' ? 'dropdown-item active' : '' "><b-img thumbnail width="35" height="35" src="/images/en.svg" alt="Thumbnail"/> <span class="mg-l-15" style="font-size: 15px;">{{trans('app.header.english')}}</span> </a>             
            </nav>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
        <div class="dropdown dropdown-b" data-toggle="tooltip" title="Notifications">
          <a href="#" class="header-notification " data-toggle="dropdown">
            <i class="icon ion-ios-bell-outline"></i>
            <span class="indicator" :class="'bg-'+color.tx"></span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-header">
              <h6 class="dropdown-menu-title">{{trans('app.header.notifications')}}</h6>
              <div>
                <a href="">Mark All as Read </a>
                <a href="">Settings</a>
              </div>
            </div><!-- dropdown-menu-header -->
            <div class="dropdown-list">
              <!-- loop starts here -->
              <a href="" class="dropdown-link">
                <div class="media">
                  <img src="http://via.placeholder.com/500x500" alt="">
                  <div class="media-body">
                    <p><strong>Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                    <span>October 03, 2017 8:45am</span>
                  </div>
                </div><!-- media -->
              </a>
              <!-- loop ends here -->
              <a href="" class="dropdown-link">
                <div class="media">
                  <img src="http://via.placeholder.com/500x500" alt="">
                  <div class="media-body">
                    <p><strong>Mellisa Brown</strong> appreciated your work <strong>The Social Network</strong></p>
                    <span>October 02, 2017 12:44am</span>
                  </div>
                </div><!-- media -->
              </a>
              <a href="" class="dropdown-link read">
                <div class="media">
                  <img src="http://via.placeholder.com/500x500" alt="">
                  <div class="media-body">
                    <p>20+ new items added are for sale in your <strong>Sale Group</strong></p>
                    <span>October 01, 2017 10:20pm</span>
                  </div>
                </div><!-- media -->
              </a>
              <a href="" class="dropdown-link read">
                <div class="media">
                  <img src="http://via.placeholder.com/500x500" alt="">
                  <div class="media-body">
                    <p><strong>Julius Erving</strong> wants to connect with you on your conversation with <strong>Ronnie Mara</strong></p>
                    <span>October 01, 2017 6:08pm</span>
                  </div>
                </div><!-- media -->
              </a>
              <div class="dropdown-list-footer">
                <a href="page-notifications.html"><i class="fa fa-angle-down"></i> Show All Notifications</a>
              </div>
            </div><!-- dropdown-list -->
          </div><!-- dropdown-menu-right -->
        </div><!-- dropdown -->        
        <div class="dropdown dropdown-c">
            <a href="#" class="logged-user" data-toggle="dropdown" >
              <img class="" :src="user.image" alt="" :class="'bd-'+color.bd">
              <span>{{user.name}}</span>
              <i class="fa fa-angle-down "></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <nav class="nav">
                <a href="#" @click="profile" class="nav-link"><i class="icon ion-person" :class="'tx-'+color.tx"></i> {{trans('app.header.view_profile')}}</a>
                <a href="#" @click="logout" class="nav-link"><i class="icon ion-forward" :class="'tx-'+color.tx"></i> {{trans('app.header.sing_out')}}</a>
              </nav>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
      </div><!-- header-right -->
    </div><!-- container-fluid -->
  </div><!-- slim-header -->
</template>
<style type="text/css">
  .tx-danger {
    color: #dc3545 !important; }
  a.tx-danger:hover, a.tx-danger:focus {
  color: #d32535 !important; }
  .bd-danger {
  border-color: #dc3545 !important; }
  .bg-danger {
  background-color: #dc3545 !important; }
  .bg-black {
  background-color: rgba(0, 0, 0, 0.9) !important;}
  .bd-black {
  border-color: #181818 !important;}
  .tx-purple {
  color: #6f42c1 !important; }
  .bd-purple {
  border-color: #6f42c1 !important; }
  .bg-purple {
  background-color: #6f42c1 !important; }
  .bd-pink {
    border-color: #e83e8c !important; }
  

</style>
<script>
    import dropdown from 'vue-dropdowns';
    export default{
      data(){
        return{
          csrf_token: axios.defaults.headers.common['X-CSRF-TOKEN'],
          root:null,
          style:false,
          showLogout: false,
          arrayOfObjects: [],
          object: {
            name: 'Object Name',
          }
        }
      },
      components: {
          'dropdown': dropdown,
      },
      methods:{
        admin(){
          this.$router.push('/admin')
        },
        methodToRunOnSelect(payload) {
          this.object = payload;
        },
        profile(){
          this.$router.push({name: 'profile'})
            return
        },
        lang(type){
          this.$store.dispatch('getLangs', type)
          this.$store.dispatch('setLangSession',type)
        },
        logout(){
          let vm = this;
          // api/auth/logout
          console.log(myToken.csrfToken);
          axios.get('/logout', {
            'headers' : {
              'Content-Type': 'application/json',
              'Authorization': 'Bearer '+ myToken.csrfToken,
            }
          })
          .then(response => {
            console.log(response)
              vm.$store.commit('logout');
              vm.$router.push('/login');
              // location.reload();
          })
          .catch(error => {
              console.log(error)
          });
        },
      },
      computed: {
        user(){
          return this.$store.getters.getSession
        },
        langS(){
          return this.$store.getters.getLangSession
        },
        validAuthenticated(){
          if(this.$store.getters.getSession.name!=undefined){
            return true;
          }else{
            return false;
          }
        },styleMenu(){
          return this.$route.path=="/";
        },
        color(){
          return this.$store.getters.getColor
        },
      }
    }
</script>

