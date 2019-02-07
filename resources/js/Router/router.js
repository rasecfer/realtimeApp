import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// Se importan los componentes
import Login from '../components/login/Login'
const routes = [
  { path: '/login', component: Login }
]

const router = new VueRouter({
  routes,
  hashbang: false,
  mode: 'history'
})

export default router