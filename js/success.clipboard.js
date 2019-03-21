const clipboard = new ClipboardJS('#copy');
clipboard.on('success', function() {
    document.getElementById('copy').innerText = '复制成功';
    window.setTimeout(function () {document.getElementById('copy').innerText = '复制链接'}, 2000);
});
clipboard.on('error', function() {
    document.getElementById('copy').innerText = '复制失败';
    window.setTimeout(function () {document.getElementById('copy').innerText = '复制链接'}, 2000);
});