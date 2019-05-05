import Vue from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueQrcode from '@chenfengyuan/vue-qrcode'
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

Vue.config.productionTip = false;
Vue.use(VueAxios, axios);
Vue.use(BootstrapVue);
Vue.prototype.clipboard = clipboard;
Vue.component(VueQrcode.name, VueQrcode);

window.pasteme = {
    config: {
        api: 'http://test.cc/',
        base_url: 'localhost:8080/',
        protocol: 'http://',
    },
};

new Vue({
    router,
    render: h => h(App)
}).$mount('#app');
