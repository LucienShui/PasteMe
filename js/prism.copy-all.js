Prism.plugins.toolbar.registerButton('select-code', function(env) {
    const button = document.createElement('button');
    button.innerHTML = '复制';
    button.className += 'btn-copy';
    button.setAttribute("data-clipboard-target", 'code');
    const clipboard = new ClipboardJS('.btn-copy');
    clipboard.on('success', function(item) {
        // alert('复制成功');
        button.innerHTML = '成功';
        item.clearSelection(); // 清除选中内容
        window.setTimeout(function () {button.innerHTML = '复制'}, 1500);
    });
    clipboard.on('error', function() {
        button.innerHTML = '失败';
        window.setTimeout(function () {button.innerHTML = '复制'}, 1500);
    });
    return button;
});