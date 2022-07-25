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

  {
    path: '/event/create',
    name: 'eventCreate',
    component: () => import( /* webpackChunkName: "login" */ '../views/events/EventCreateView.vue')
  },
  
  {
    path: '/event/:id',
    name: 'event',
    component: () => import(/* webpackChunkName: "event" */ '../views/events/EventView.vue')
  },

  {
    path: '/sale/:id',
    name: 'sale',
    component: () => import(/* webpackChunkName: "sale" */ '../views/sales/SaleView.vue')
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
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router