(function(){
    if (typeof self === 'undefined' || !self.Prism || !self.document) {
        return;
    }
    if (!window.Prism.plugins.toolbar) {
        console.warn('Copy to Clipboard plugin loaded before Toolbar plugin.');
        return;
    }
    let ClipboardJS = window.ClipboardJS || undefined;
    if (!ClipboardJS && typeof require === 'function') {
        ClipboardJS = require('clipboard');
    }
    let callbacks = [];
    if (!ClipboardJS) {
        console.log('There is no clipboard.min.js, load from web');
        let script = document.createElement('script');
        let head = document.querySelector('head');
        script.onload = function() {
            ClipboardJS = window.ClipboardJS;
            if (ClipboardJS) {
                while (callbacks.length) {
                    callbacks.pop()();
                }
            }
        };
        script.src = 'https://cdn.bootcss.com/clipboard.js/2.0.1/clipboard.min.js';
        head.appendChild(script);
    }

    window.Prism.plugins.toolbar.registerButton('copy-to-clipboard', function (env) {
        let button = document.createElement('button');
        button.textContent = '复制';
        button.setAttribute('tabindex', '1');

        if (!ClipboardJS) {
            callbacks.push(registerClipboard);
        } else {
            registerClipboard();
        }
        return button;

        function registerClipboard() {
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
})();