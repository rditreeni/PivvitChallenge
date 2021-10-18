import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [{
        path: '/new-purchase',
        name: 'NewPurchase',
        component: () => import('../views/NewPurchase.vue')
    },
    {
        path: '/',
        name: 'Purchases',
        component: () => import('../views/Purchase.vue')
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router