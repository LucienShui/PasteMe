import Vue from 'vue'
import Router from 'vue-router'
import NotFound from './views/NotFound.vue'
import Index from './views/Index'

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/test',
            name: 'test',
            component: () => import('./views/Test.vue')
        },
        {
            path: '/:keyword(0{0}|[a-zA-Z0-9]{3,8})',
            name: 'index',
            component: Index,
        },
        {
            path: '*',
            name: 'NotFound',
            component: NotFound,
        }
    ]
})
