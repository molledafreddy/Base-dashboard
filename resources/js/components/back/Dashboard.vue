<template>
  <div class="slim-mainpanel">
    <div class="container">
      <breadcrumb-slim :position="position"></breadcrumb-slim>
    </div><!-- container -->
  </div><!-- slim-mainpanel -->
</template>

<script>
	export default{
		data(){
			return{
				showLogout: false,
			}
		},
    computed: {
      user(){
        return this.$store.getters.getSession
      },
       position(){
        return trans('app.dashboard.welcome') +', '+ this.$store.getters.getSession.name
      },
    }
	}
</script>


