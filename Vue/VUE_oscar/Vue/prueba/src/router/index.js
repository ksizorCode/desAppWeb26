import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/views/Home.vue'
import Menu from '@/views/Menu.vue'
import Contacto from '@/views/Contacto.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
{
  path:'/',
  name:'home',
  component: Home
},
{
  path:'/menu',
  name:'menu',
  component: Menu
},
{
  path:'/contacto',
  name:'contacto',
  component: Contacto
}

  ],
})

export default router
