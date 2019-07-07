
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import router from './router'
import store from './store'


require('./bootstrap');

window.Vue = require('vue');

/**
 *  Vendor Components
 */
require('./vendor_components')

/**
 * Custom Vue Components
 */
require('./vue_components')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

//filters
Vue.filter('blog_intro', function(value){
    return value.substr(0, 240)
})

// Vue.filter('money', function(value){
//     var numeral = require('numeral')
//     return numeral(value).format('0,0.00')
// })

//Localization
Vue.prototype.trans = string => _.get(window.i18n, string);
window.trans = string => _.get(window.i18n, string);

window.clone = function (obj) {
    return JSON.parse(JSON.stringify(obj));
}

const app = new Vue({
    el: '#app',
    store,
    router,
});
