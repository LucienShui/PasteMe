function footer_one() {
    var str = "";
    do {
        $.ajax({
            url: "https://v1.hitokoto.cn?encode=text",
            async: false,
            success: function(result){
                str = result;
        }});
    } while (str.replace(/[\u4e00-\u9fa5]/ig, '**').length > 100); // 中文字符占两个字节
    document.write(str);
}
