import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueQrcode from '@chenfengyuan/vue-qrcode'
import clipboard from 'clipboard'
import BootstrapVue from 'bootstrap-vue'

import App from './App.vue'
import router from './router'
import store from './store'
import i18n from './i18n'
import qs from 'qs'

import './prism'
import './assets/js/daovoice.object'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './assets/css/global.css'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faGlobeAsia } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faGlobeAsia);

let VueCookie = require('vue-cookie');
Vue.config.productionTip = false;
Vue.use(VueAxios, axios);
Vue.use(BootstrapVue);
Vue.use(VueCookie);
Vue.prototype.clipboard = clipboard;
Vue.prototype.qs = qs;
Vue.component('QRCode', VueQrcode);
Vue.component('font-awesome-icon', FontAwesomeIcon);

function ConfigLoader () {
    return new Promise ((resolve, reject) => {
        axios.get('./config.json').then(response => {
            store.state.config = response.data;
            resolve();
        }).catch((error) => {
            alert(JSON.stringify(error) + '\n' + this.$t('lang.error.text'));
            reject();
        })
    })
}

(async function () {
    await ConfigLoader();
    new Vue({
        store,
        i18n,
        router,
        render: h => h(App)
    }).$mount('#app');
})();
