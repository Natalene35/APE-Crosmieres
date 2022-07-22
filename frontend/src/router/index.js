import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
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

  //Road for registration
  {
    path: '/registration',
    name: 'registration',
     component: () => import(/* webpackChunkName: "login" */ '../views/registration/UserRegisterView.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
