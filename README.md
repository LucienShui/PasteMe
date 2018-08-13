# PasteMe

Ubuntu Paste 的本土化版，有加密功能，文本框的内容可以一键全选，上传的内容可以选择永久保存或者是即阅即焚。

# 部署

```
web_root
 ├─ index.php
 ├─ handle.php
 ├─ success.php
 ├─ favicon.ico (if you have)
 ├─ util
 │   ├─ config.php
 │   ├─ init.php
 │   ├─ tableEditor.php
 │   ├─ dbEditor.php
 │   ├─ util.php
 │   └─ submit.php
 ├─ css
 │   └─ prism.css
 └─ js
     ├─ prism.js
     ├─ tools.js
     └─ prism.select-all.js
```

修改`web_root/util/config.php`中的数据库相关的信息，并将`website`项更改为服务器的域名。

然后第一次启动网页时，执行`web_root/util/init.php`来初始化数据库。

## Rewrite（必要）

### Nginx

```
if (!-e $request_filename) {
    rewrite ^(.*)$ /handle.php$1 last;
}
```

### Apache

```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ handle.php [L,E=PATH_INFO:$1]
</IfModule>
```

# 其它

+ 代码写的很烂，望轻喷。

# Demo

暂无

## 版权所有

[Lucien Shui](http://www.lucien.ink)
