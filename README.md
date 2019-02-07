# 注意

为了实现 [部署问题 #1](https://github.com/LucienShui/PasteMe/issues/1) ，文件树发生了变化。因此，若要从 `v1.0` 升级至 `dev` 版本请务必重新修改一次 `config.php` 。

使用老版本请下载 `release` 版本：https://github.com/LucienShui/PasteMe/releases

# Demo 

## Release

[https://pasteme.cn](http://www.lucien.ink/go/pasteme)

## Dev

[http://api.lucien.ink/pasteme](http://api.lucien.ink/pasteme)

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

# API

```bash
api.pasteme.cn?token=<key>,<passwd>
```

其中 `key` 为索引串，`passwd` 为索引串的密码（如果有），中间以英文逗号分隔。

比如：

```bash
curl 'api.lucien.ink/pasteme/api.php?token=105'
curl 'api.lucien.ink/pasteme/api.php?token=106,123'
```

# 部署

```
web_root
 ├─ css
 │   ├─ bootstrap.min.css
 │   ├─ bootstrap.min.css.map
 │   └─ prism.css
 ├─ img
 │   ├─ money.png
 │   ├─ touch-icon-ipad-retina.png
 │   ├─ touch-icon-ipad.png
 │   ├─ touch-icon-iphone-retina.png
 │   └─ touch-icon-iphone.png
 ├─ js
 │   ├─ bootstrap.min.js
 │   ├─ bootstrap.min.js.map
 │   ├─ clipboard.min.js
 │   ├─ dao.voice.object.js
 │   ├─ jquery.min.js
 │   ├─ prism.copy-all.js
 │   ├─ prism.js
 │   └─ tools.js
 ├─ lib
 │   ├─ config.php
 │   ├─ dbEditor.php
 │   ├─ frame.php
 │   ├─ init.php
 │   ├─ oneWord.php
 │   ├─ postVerify.php
 │   ├─ submit.php
 │   └─ tableEditor.php
 └─ usr
 │   └─ js.php
 ├─ api.php
 ├─ favicon.ico
 ├─ index.php
 └─ success.php

```

进入 `lib` 文件夹，将 `config.example.php` 复制一份并重命名为 `config.php` ，修改 `config.php` 中相关的信息。

然后在浏览器中访问 `web_root/lib/init.php` 来初始化数据库。

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

# 版权所有

Copyright © 2017-2018 [Lucien Shui](http://www.lucien.ink) All Rights Reserved

# 免责声明

本工具只提供文本分享的载体部分，对于所有的文本内容均没有任何联系。

# 待完善

+ [x] 支持子目录部署

+ [ ] 支持举报不当的文本存档

+ [ ] 支持删除指定文本存档的后台

+ [x] 分离存档和永久存档的数据库

+ [x] 重写 `api`

# 捐助

![谢谢老板](https://github.com/LucienShui/gitcdn/blob/master/money.png)

