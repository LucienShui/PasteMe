import Vue from 'vue'
import prism from 'prismjs'
import 'prismjs/themes/prism-tomorrow.css'
import 'prismjs/plugins/line-numbers/prism-line-numbers.css'
import 'prismjs/plugins/line-numbers/prism-line-numbers'
import '@/assets/css/prism-toolbar.css'
import 'prismjs/plugins/toolbar/prism-toolbar'
import 'prismjs/components/prism-c'
import 'prismjs/components/prism-cpp'
import 'prismjs/components/prism-java'
import 'prismjs/components/prism-python'
import 'prismjs/components/prism-bash'
import 'prismjs/components/prism-http'
import 'prismjs/components/prism-markdown'

prism.plugins.toolbar.registerButton('copy-to-clipboard', function (env) {
    let button = document.createElement('button');
    button.textContent = '复制';
    button.setAttribute('tabindex', '1');

    registerClipboard();
    return button;

    function registerClipboard() {
        let ClipboardJS = require('clipboard');
        let clip = new ClipboardJS(button, {
            'text': function () {
                return env.code;
            }
        });

        clip.on('success', function() {
            button.textContent = '复制成功';
            resetText();
        });
        clip.on('error', function () {
            button.textContent = '复制失败';
            resetText();
        });
    }

    function resetText() {
        setTimeout(function () {
            button.textContent = '复制';
        }, 2000);
    }
});

Vue.prototype.prism = prism;
