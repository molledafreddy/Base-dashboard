

Vue.component('login', require('./components/auth/login.vue'));

//Back components
Vue.component('home', require('./components/back/Home.vue'));
Vue.component('navbar-back', require('./components/back/sliders/NavBar.vue'));
Vue.component('header-slim', require('./components/back/sliders/Header.vue'));
Vue.component('breadcrumb-slim', require('./components/back/sliders/Breadcrumb.vue'));
Vue.component('foot-back', require('./components/back/sliders/Footer.vue'));
Vue.component('setting-edit', require('./components/back/settings/Edit.vue'));
	

//front components

// Vue.component('navbar-back', require('./components/back/sliders/NavBar.vue'));
Vue.component('header-front', require('./components/front/sliders/Header.vue'));
// Vue.component('foot-front', require('./components/back/sliders/Footer.vue'));

//helpers
Vue.component('spinner', require('./components/helpers/Spinner.vue'));
Vue.component('upload-images', require('./components/helpers/UploadImages.vue'));
Vue.component('input-type', require('./components/helpers/InputType.vue'));