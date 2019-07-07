<template>
  <div class="slim-pageheader">
    <ol class="breadcrumb slim-breadcrumb">
      <li class="breadcrumb-item"><a :class="'tx-'+color.tx" href="/">{{trans('app.breadcrumb.home')}}</a></li>
      <li class="breadcrumb-item">
        <router-link :to="'/admin'"> 
        <a :class="'tx-'+color.tx" href="#">{{trans('app.breadcrumb.dashboard')}}</a>
      </router-link>
      </li>
      <div v-if="elements !=null">
       <div v-for="item in elements">
        <li class="breadcrumb-item">
          <router-link :to="'/'+item.rute"> 
          <a :class="'tx-'+color.tx" href="#" style="color: red !important;"> {{item.name}}</a>
        </router-link>
        </li>
       </div>
      </div>
      <li class="breadcrumb-item active" aria-current="page">{{position}}</li>
    </ol>
    <h6 class="slim-pagetitle" :class="'bd-'+color.tx">{{position}}</h6>
  </div><!-- slim-pageheader -->
</template>
<style type="text/css">
  .tx-danger {
    color: #dc3545 !important; }
  a.tx-danger:hover, a.tx-danger:focus {
  color: #d32535 !important; }
  .bd-danger {
  border-color: #dc3545 !important; }
  .bg-black {
  background-color: rgba(0, 0, 0, 0.9) !important;}
  .bd-black {
  border-color: #181818 !important;}
</style>
<script>
    export default{
      props:['position','elements'],
      data(){
        return{
          
        }
      },
      computed: {
          color(){
            return this.$store.getters.getColor
          },
      },
    }
</script>

