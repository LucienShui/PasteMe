import Vue from 'vue'
import Vuex from 'vuex'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueQrcode from '@chenfengyuan/vue-qrcode'
import VueI18n from 'vue-i18n'
import clipboard from 'clipboard'
import BootstrapVue from 'bootstrap-vue'

import 'prismjs'
import 'prismjs/themes/prism-tomorrow.css'
import 'prismjs/plugins/line-numbers/prism-line-numbers.css'
import 'prismjs/plugins/line-numbers/prism-line-numbers'
import './assets/css/prism-toolbar.css'
import 'prismjs/plugins/toolbar/prism-toolbar'
import './assets/js/pasteme.prism.toobar'
import 'prismjs/components/prism-c'
import 'prismjs/components/prism-cpp'
import 'prismjs/components/prism-java'
import 'prismjs/components/prism-python'
import 'prismjs/components/prism-bash'
import 'prismjs/components/prism-http'
import 'prismjs/components/prism-markdown'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './assets/js/daovoice.object'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faGlobeAsia } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faGlobeAsia);

let VueCookie = require('vue-cookie');
Vue.config.productionTip = false;
Vue.use(VueAxios, axios);
Vue.use(VueI18n);
Vue.use(BootstrapVue);
Vue.use(VueCookie);
Vue.use(Vuex);
Vue.prototype.clipboard = clipboard;
Vue.component('QRCode', VueQrcode);
Vue.component('font-awesome-icon', FontAwesomeIcon);

function ConfigLoader () {
    return new Promise ((resolve, reject) => {
        axios.get('./config.json').then(response => {
            Vue.prototype.pasteme = {
                config: response.data,
            };
            resolve();
        }).catch((error) => {
            alert(JSON.stringify(error) + '\n' + this.$t('lang.error.text'));
            reject();
        })
    })
}

const store = new Vuex.Store({
    state: {
        read_once: false,
        not_found: false,
    },
    mutations: {
        updateMode(state, payload) {
            state.read_once = payload.read_once;
        },
        updateNotFound(state, payload) {
            state.not_found = payload.not_found;
        },
        init(state) {
            state.not_found = state.read_once = false;
        }
    }
});

const i18n = new VueI18n({
    locale: 'zh-CN',
    messages: {
        'zh-CN': require('./assets/lang/zh-CN'),
        'en': require('./assets/lang/en'),
    }
});

(async function () {
    await ConfigLoader();
    new Vue({
        store,
        i18n,
        router,
        render: h => h(App)
    }).$mount('#app');
})();
