import Vue from 'vue'
import Router from 'vue-router'
import Index from './views/Index'

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/:keyword(0{0}|[a-zA-Z0-9]{3,8})',
            name: 'index',
            component: Index
        },
        {
            path: '/What_are_you_nong_sha_lei?',
            name: 'NotFound',
            component: () => import(/* webpackChunkName: "not_found" */ './views/NotFound.vue')
        },
        {
            path: '*',
            redirect: '/What_are_you_nong_sha_lei?'
        },
        {
            path: 'admin',
            name: 'admin',
            // TODO
        },
    ]
})
