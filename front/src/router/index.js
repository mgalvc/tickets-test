import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '@/views/auth/Login'
import Register from '@/views/auth/Register'
import Tickets from '@/views/tickets/Tickets'

Vue.use(VueRouter)

const routes = [
    {
        path: '*',
        redirect: '/tickets'
    },
    {
        path: '/tickets',
        name: 'Tickets',
        component: Tickets
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    }
]

const router = new VueRouter({
    routes
})

export default router
