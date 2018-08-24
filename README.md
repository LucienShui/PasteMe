# PasteMe

Ubuntu Paste 的本土化版，有加密功能，文本框的内容可以一键复制，上传的内容可以选择**永久保存**或者是**即阅即焚**。

## 索引串

每一个被上传的文本都有一个字符串去对其进行唯一标识，就像是门牌号一样，我称它为“**索引串**”。纯数字的索引串对应永久空间的文本，包含字母的索引串对应临时空间的文本。

## 对于别人分享的文本

1. 可直接通过网页链接访问。
2. 可在主页左上角的输入框输入索引串进行访问。

## 对于准备上传的文本

1. **永久保存**：直接在主页进行上传。
2. **阅后即焚**：在左上角输入含有字母的索引串，前往相应的临时空间，页面会变成灰色，并开始对索引串进行索引。若索引至一个已存在的内容则进行“*阅读*”，若索引至一个“空地”则进行“*创建*”。

# 部署

```
web_root
 ├─ index.php
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

将`config.example.php`复制一份并重命名为`config.php`，修改`config.php`中数据库相关的信息，并将`website`项更改为服务器的域名。

然后在浏览器中访问`web_root/util/init.php`来初始化数据库。

## Rewrite（必要）

### Nginx

```
if (!-e $request_filename) {
    rewrite ^(.*)$ /index.php$1 last;
}
```

### Apache

```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php [L,E=PATH_INFO:$1]
</IfModule>
```

# 其它

+ 代码写的很烂，望轻喷。

# Demo

[PasteMe](http://www.lucien.ink/go/pasteme)

# 版权所有

Copyright © 2017-2018 [Lucien Shui](http://www.lucien.ink) All Rights Reserved

# 捐助

![谢谢老板](https://github.com/LucienShui/gitcdn/blob/master/money.png)
