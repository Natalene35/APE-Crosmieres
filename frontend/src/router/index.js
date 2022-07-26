import {
  createRouter,
  createWebHistory
} from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [{
    path: '/',
    name: 'home',
    component: HomeView
  },

  //Road for login
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "login" */ '../views/login/UserLoginView.vue')
  },

  // route for creating event
  {
    path: '/event/create',
    name: 'eventCreate',
    component: () => import(/* webpackChunkName: "create-event" */ '../views/events/EventCreateView.vue')
  },

  // route for creating sale
  {
    path: '/sale/create',
    name: 'saleCreate',
    component: () => import(/* webpackChunkName: "create-sale" */ '../views/sales/SaleCreateView.vue')
  },

  //Road for registration
  {
    path: '/registration',
    name: 'registration',
    component: () => import(/* webpackChunkName: "login" */ '../views/registration/UserRegisterView.vue')
  },

  //Road for events list
  {
    path: '/events/list',
    name: 'eventsList',
    component: () => import(/* webpackChunkName: "events-list" */ '../views/events/EventsListView.vue')
  },

  //Road for sales list
  {
    path: '/sales/list',
    name: 'salesList',
    component: () => import(/* webpackChunkName: "sales-list" */ '../views/sales/SalesListView.vue')
  },

  //Road for an event
  {
    path: '/event/:id',
    name: 'event',
    component: () => import(/* webpackChunkName: "event" */ '../views/events/EventView.vue')
  },

  //Road for registration
  {
    path: '/registration',
    name: 'registration',
     component: () => import(/* webpackChunkName: "login" */ '../views/registration/UserRegisterView.vue')
  },

  //Road for user profil
  {
    path: '/userprofil',
    name: 'userprofil',
    component: () => import(/* webpackChunkName: "login" */ '../views/user/ProfilView.vue')
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;



