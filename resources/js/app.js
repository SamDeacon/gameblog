
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import { Form, HasError, AlertError } from 'vform';
import VueProgressBar from 'vue-progressbar'
import swal from 'sweetalert2'

window.swal = swal;
const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.toast = toast;

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '2px'
});

Vue.filter('capitalize', function(value){
  if (!value) return '';
  value = value.toString();
  return value.charAt(0).toUpperCase() + value.slice(1);
});
Vue.filter('myDate', function(date){
  return moment(date).format('MMMM Do YYYY, h:mm:ss a');
});

window.Fire = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.component(
     'passport-clients',
     require('./components/passport/Clients.vue')
 );

 Vue.component(
     'passport-authorized-clients',
     require('./components/passport/AuthorizedClients.vue')
 );

 Vue.component(
     'passport-personal-access-tokens',
     require('./components/passport/PersonalAccessTokens.vue')
 );

Vue.component(
  'categories', require('./components/admin/Categories.vue'),
);

Vue.component(
  'users', require('./components/admin/Users.vue'),
);

// const app = new Vue({
//     el: '#app'
// });
const adminApp = new Vue({
    el: '#admin-app'
});
