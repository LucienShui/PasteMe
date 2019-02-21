<?php
function curl_get_https($url){
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    $tmpInfo = curl_exec($curl);     //返回api的json对象
    //关闭URL请求
    curl_close($curl);
    return $tmpInfo;    //返回json对象
}
function one_word() {
    $ret = curl_get_https("https://v1.hitokoto.cn?encode=text");
    while (strlen($ret) > 100) $ret = curl_get_https("https://v1.hitokoto.cn?encode=text");
    return $ret;
}