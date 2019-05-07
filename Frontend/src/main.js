import Vue from 'vue'
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
import '../src/assets/js/dao.voice.object'
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
Vue.prototype.clipboard = clipboard;
Vue.prototype.supported_language = ['zh-CN', 'en'];
Vue.component('qrcode', VueQrcode);
Vue.component('font-awesome-icon', FontAwesomeIcon);

function ConfigLoader () {
    return new Promise ((resolve, reject) => {
        axios.get('./config.json').then(response => {
            Vue.prototype.pasteme = {
                config: response.data,
            };
            resolve();
        }).catch((error) => {
            console.log(JSON.stringify(error));
            alert(this.$t('lang.error.text'));
            reject();
        })
    })
}

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
        i18n,
        router,
        render: h => h(App)
    }).$mount('#app');
})();
