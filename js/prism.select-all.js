Prism.plugins.toolbar.registerButton('select-code', function(env) {
    const button = document.createElement('button');
    button.innerHTML = '全选';

    button.addEventListener('click', function () {
        let range;
// Source: http://stackoverflow.com/a/11128179/2757940
        if (document.body.createTextRange) { // ms
            range = document.body.createTextRange();
            range.moveToElementText(env.element);
            range.select();
        } else if (window.getSelection) { // moz, opera, webkit
            const selection = window.getSelection();
            range = document.createRange();
            range.selectNodeContents(env.element);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    });
    return button;
});