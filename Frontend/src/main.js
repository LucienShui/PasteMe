import Vue from 'vue'
import VueQrcode from '@chenfengyuan/vue-qrcode'
import clipboard from 'clipboard'
import BootstrapVue from 'bootstrap-vue'

import App from './App.vue'
import router from './router'
import store from './store'
import i18n from './i18n'
import api from './api'

import '@/prism'
import '@/assets/js/daovoice.object'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import '@/assets/css/global.css'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faGlobeAsia } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faGlobeAsia);

let VueCookie = require('vue-cookie');
Vue.config.productionTip = false;
Vue.use(BootstrapVue);
Vue.use(VueCookie);
Vue.prototype.clipboard = clipboard;
Vue.prototype.api = api;
Vue.component('QRCode', VueQrcode);
Vue.component('font-awesome-icon', FontAwesomeIcon);

(async function () {
    await (function() {
        return new Promise ((resolve, reject) => {
            api.get('./config.json').then(response => {
                store.state.config = response;
                resolve();
            }).catch(error => {
                reject(error);
            })
        })
    })();
    new Vue({
        store,
        i18n,
        router,
        render: h => h(App)
    }).$mount('#app');
})();
