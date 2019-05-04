import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import NotFound from './views/NotFound.vue'

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/test',
            name: 'test',
            component: () => import('./views/Test.vue')
        },
        {
            path: '/:keyword([a-zA-Z0-9]{1,8})',
            name: 'Paste',
            component: () => import('./views/Paste.vue')
        },
        {
            path: '*',
            name: 'NotFound',
            component: NotFound,
        }
    ]
})
