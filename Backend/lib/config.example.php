<?php
return array(
    'dbhost' => 'localhost:3306', // 一般不用改
    'username' => 'root', // 数据库用户名
    'password' => 'root', // 数据库密码
    'dbname' => 'pasteme', // 数据库名
    'protocol' => 'http://', // 网址前缀，'http://' 或 'https://'
    'domain' => 'localhost', // 域名
    'path' => '/', // 如果要将网站部署在子文件夹中则需要修改这一项，不要漏掉最右侧的 '/'
    'cdn' => '/', // 若不使用 cdn 而且网站需要部署在子文件夹中的话这一项需要保持与 'path' 保持一致
    'seed' => 'CHANGE_THIS', // 防止跨站，请自己随便输一串字符串在这里
    'passwd' => 'CHANGE_THIS', // 管理界面的密码
);
?>
