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
    component: () => import( /* webpackChunkName: "login" */ '../views/login/UserLoginView.vue')
  },

  // route for creating event
  {
    path: '/event/create',
    name: 'eventCreate',
    component: () => import( /* webpackChunkName: "create-event" */ '../views/events/EventCreateView.vue')
  },

  // route for creating sale
  {
    path: '/sale/create',
    name: 'saleCreate',
    component: () => import( /* webpackChunkName: "create-sale" */ '../views/sales/SaleCreateView.vue')
  },

  //Road for registration
  {
    path: '/registration',
    name: 'registration',
    component: () => import( /* webpackChunkName: "login" */ '../views/registration/UserRegisterView.vue')
  },

  //Road for events list
  {
    path: '/events/list',
    name: 'eventsList',
    component: () => import( /* webpackChunkName: "events-list" */ '../views/events/EventsListView.vue')
  },

  //Road for sales list
  {
    path: '/sales/list',
    name: 'salesList',
    component: () => import( /* webpackChunkName: "sales-list" */ '../views/sales/SalesListView.vue')
  },

  //Road for an event

  {
    path: '/event/:id',
    name: 'event',
    component: () => import( /* webpackChunkName: "event" */ '../views/events/EventDetailView.vue')

  },

  {
    path: '/sale/:id',
    name: 'sale',
    component: () => import( /* webpackChunkName: "sale" */ '../views/sales/SaleDetailView.vue')
  },

  //Road for registration
  {
    path: '/registration',
    name: 'registration',
    component: () => import( /* webpackChunkName: "login" */ '../views/registration/UserRegisterView.vue')
  },

  //Road for user profil
  {
    path: '/userprofil',
    name: 'userprofil',
    component: () => import( /* webpackChunkName: "login" */ '../views/user/ProfilView.vue')
  },

  // route for creating event
  {
    path: '/member',
    name: 'memberList',
    component: () => import( /* webpackChunkName: "member-list" */ '../views/user/MemberView.vue')
  },

  //Road for 404 page
  {
    path: '/404',
    name: '404',
    component: () => import( /* webpackChunkName: "404" */ '../views/errors/Page404View.vue')
  },

   //Road for back-office
   {
    path: '/back-office',
    name: 'back-office',
     component: () => import(/* webpackChunkName: "login" */ '../views/back-office/BackOfficeView.vue')
  },

  //Road for legals mentions
  {
    path: '/legals-mentions',
    name: 'legals-mentions',
     component: () => import(/* webpackChunkName: "legals-mentions" */ '../views/legals-mentions/LegalsMentionsView.vue')
  },
]


const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;