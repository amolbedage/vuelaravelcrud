import VueRouter from 'vue-router';

import Dashboard from './../components/admin-view/Dashboard.vue';
import Users from './../components/admin-view/Users.vue';

let base="/amol/"
const routes = [
  {
      name: 'dashboard',
      path: '/',
      component: Dashboard
  },{
      name: 'users',
      path: '/users',
      component: Users
  },

];

export default new VueRouter({
    base :base,
    routes,
});