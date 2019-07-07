
//js template
require('./library/ResizeSensor');
require('./library/chart.chartist');
require('./library/chart.chartjs.dark');
require('./library/chart.chartjs');
require('./library/chart.flot.dark');
require('./library/chart.flot');
require('./library/chart.morris');
require('./library/chart.peity');
require('./library/chart.rickshaw');
require('./library/chart.sparkline');
require('./library/dashboard');
require('./library/jquery.vmap.sampledata');
require('./library/map.apple');
require('./library/map.bluewater');
require('./library/map.mapbox');
require('./library/map.shadesofgray');
require('./library/map.shiftworker');
require('./library/slim');
require('./library/widgets');
require('../lib/jquery/js/jquery.js');
require('../lib/popper.js/js/popper.js');
require('../lib/bootstrap/js/bootstrap.js');
require('../lib/jquery.cookie/js/jquery.cookie.js');
require('../lib/chartist/js/chartist.js');
require('../lib/d3/js/d3.js');


// require('../lib/rickshaw/js/rickshaw.min.js');
require('../lib/jquery.sparkline.bower/js/jquery.sparkline.min.js');
require('../lib/Flot/js/jquery.flot.js');
require('../lib/Flot/js/jquery.flot.resize.js');
require('../lib/peity/js/jquery.peity.js');
require('../lib/chartist/js/chartist.js');
require('../lib/jquery.sparkline.bower/js/jquery.sparkline.min.js');
require('../lib/jqvmap/js/jquery.vmap.min.js');
require('../lib/jqvmap/js/jquery.vmap.world.js');
require('../lib/chart.js/js/Chart.js');
require('../lib/morris/js/morris.js');
// require('../lib/gmaps/js/gmaps.js');
// require('../lib/morris/js/morris.js');
require('../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js'); 
    

import VeeValidate from 'vee-validate';
import Toasted from 'vue-toasted';
import BootstrapVue from 'bootstrap-vue';
import VueSweetalert2 from 'vue-sweetalert2';
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import Multiselect from 'vue-multiselect'
import wysiwyg from "vue-wysiwyg";


//Swal alerts
Vue.use(VueSweetalert2)

//Bootstrap Vue
Vue.use(BootstrapVue);

Vue.use (VeeValidate, {fieldsBagName: 'veeFields'});
//Toast alerts
Vue.use(Toasted,  {duration: 6000, iconPack : 'fontawesome', theme: 'outline'})

//Vue form Wizard
Vue.use(VueFormWizard)

//Vue multiselect
Vue.component('multiselect', Multiselect)

//Wysiwyg
Vue.use(wysiwyg, {  maxHeight: "200px" })

