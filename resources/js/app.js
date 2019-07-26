/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';


Vue.use(VueRouter);
Vue.use(VueAxios,axios);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import frontroutes from './routes/frontRoutes.js';
import adminRoutes from './routes/adminRoutes.js';
import userRoutes from './routes/userRoutes.js';
import frontApp from './frontApp.vue';
import userApp from './userApp.vue';
import addminApp from './addminApp.vue';

//const router = new VueRouter({ mode: 'history', routes: routes,base:base});
//const app = new Vue(Vue.util.extend({ frontroutes }, FrontComponent)).$mount('#app');

      //prefix = '/front/';
   // axios.defaults.baseURL = apiHost+prefix;
   console.log(window.location.href);
   console.log(window.location.href.indexOf("amol"));
if(window.location.href.indexOf("amol") > -1 ){
	alert('amin');
  const app = new Vue({
          router : adminRoutes,
        template: '<addminApp/>',
        components: { addminApp },
       // / props: ['forbidden'],
    }).$mount('#app');

}else if(window.location.href.indexOf("user") > -1){
	alert('user');
const app = new Vue({
          router : userRoutes,
        template: '<userApp/>',
        components: { userApp },
       // / props: ['forbidden'],
    }).$mount('#app');

}else{
	alert('front');
  const app = new Vue({
          router : frontroutes,
        template: '<frontApp/>',
        components: { frontApp },
       // / props: ['forbidden'],
    }).$mount('#app');

}

    