import VueRouter from 'vue-router';

import Dashboard from './../components/user-view/Dashboard.vue';
import Profile from './../components/user-view/Profile.vue';

let base="/admin/"
const routes = [
  {
      name: 'dashboard',
      path: '/',
      component: Dashboard
  },{
      name: 'profile',
      path: '/profile',
      component: Profile
  },

];

export default new VueRouter({
    base :base,
    routes,
});