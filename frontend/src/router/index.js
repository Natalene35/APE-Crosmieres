import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },

  {
    path: '/login',
    name: 'login',
     component: () => import(/* webpackChunkName: "login" */ '../views/login/UserLoginView.vue')
  },
  
  {
    path: '/event/:id',
    name: 'event',
    component: () => import(/* webpackChunkName: "event" */ '../views/events/EventView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
