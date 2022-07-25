import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  //Road for the home page
  {
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
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;


