import VueRouter from 'vue-router';

import HomeComponent from './../components/front-view/HomeComponent.vue';
import CreateComponent from './../components/front-view/CreateComponent.vue';
import IndexComponent from './../components/front-view/IndexComponent.vue';
import EditComponent from './../components/front-view/EditComponent.vue';
import ContactUs from './../components/front-view/ContactUs.vue';
let base="/front/"
const routes = [
  {
      name: 'home',
      path: '/',
      component: HomeComponent
  },
  {
      name: 'create',
      path: '/create',
      component: CreateComponent
  },
  {
      name: 'posts',
      path: '/posts',
      component: IndexComponent
  },
  {
      name: 'edit',
      path: '/edit/:id',
      component: EditComponent
  }, {
      name: 'contactus',
      path: '/contactus',
      component: ContactUs
  }
];

export default new VueRouter({
    base :base,
    routes,
});