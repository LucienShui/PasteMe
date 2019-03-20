let url = document.getElementById('url');
let copyLink = document.getElementById('copy');
copyLink.setAttribute("data-clipboard-text", url.innerText);
const clipboard = new ClipboardJS('#copy');
clipboard.on('success', function() {
    copyLink.innerText = '复制成功';
    window.setTimeout(function () {copyLink.innerText = '复制链接'}, 2000);
});
clipboard.on('error', function() {
    copyLink.innerText = '复制失败';
    window.setTimeout(function () {copyLink.innerText = '复制链接'}, 2000);
});