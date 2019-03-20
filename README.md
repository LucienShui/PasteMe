# PasteMe

Ubuntu Paste 的本土化版，有加密功能，文本框的内容可以一键复制，上传的内容可以选择**永久保存**或者是**即阅即焚**。

如果老板觉得这个项目还不错，右上角给个 **Star** 好不啦。QAQ

# Demo 

## Release

[https://pasteme.cn](http://www.lucien.ink/go/pasteme)

## Dev

[http://api.lucien.ink/pasteme](http://api.lucien.ink/pasteme)

# 帮助

## 截图

![homePage](https://github.com/LucienShui/gitcdn/blob/master/pasteme_home.png?raw=true)

![chat](https://github.com/LucienShui/gitcdn/blob/master/pasteme_chat.png?raw=true)

![effectiveOnce](https://github.com/LucienShui/gitcdn/blob/master/pasteme_read_once.png?raw=true)

![adminPage](https://github.com/LucienShui/gitcdn/blob/master/pasteme_admin.png?raw=true)

## 索引

每一个被上传的文本都有一个字符串去对其进行唯一标识，就像是门牌号一样，我称它为“**索引**”。纯数字的索引对应永久空间的文本，包含字母的索引对应临时空间的文本。

## 对于别人分享的内容

1. 可直接通过网页链接访问。
2. 可在主页左上角的输入框输入索引进行访问。

## 对于准备上传的内容

### 永久保存

直接在主页进行上传。

### 阅后即焚

1. 在左上角输入含有字母的索引，前往相应的临时空间，如果这个索引存在则显示索引内容，不存在则创建一份新的索引。

2. 在主页直接勾选 `阅后即焚`。

所有阅后即焚的内容一旦以任何方式（包括 `API` ）被成功访问就会**永久从数据库中消失**。

# API

```bash
api.pasteme.cn?token=<key>,<passwd>
```

其中 `key` 为索引，`passwd` 为索引的密码（如果有），中间以英文逗号分隔。

比如：

```bash
curl 'api.pasteme.cn?token=100'
curl 'api.pasteme.cn?token=101,123'
```

# 进入管理界面的方法

访问 `web_root/your_path/admin.php?token=<your_passwd>` 即可。

# 部署

```
web_root
 ├─ css
 │   ├─ bootstrap.min.css
 │   ├─ bootstrap.min.css.map
 │   ├─ footer.css
 │   └─ prism.css
 ├─ img
 │   ├─ donate.png
 │   ├─ touch-icon-ipad-retina.png
 │   ├─ touch-icon-ipad.png
 │   ├─ touch-icon-iphone-retina.png
 │   └─ touch-icon-iphone.png
 ├─ js
 │   ├─ ajax.js
 │   ├─ bootstrap.min.js
 │   ├─ bootstrap.min.js.map
 │   ├─ clipboard.min.js
 │   ├─ dao.voice.object.js
 │   ├─ jquery.min.js
 │   ├─ one.js
 │   ├─ prism.copy-all.js
 │   ├─ prism.js
 │   ├─ success.clipboard.js
 │   ├─ success.home.button.js
 │   └─ tools.js
 ├─ lib
 │   ├─ config.php
 │   ├─ dbEditor.php
 │   ├─ frame.php
 │   ├─ init.php
 │   ├─ postVerify.php
 │   ├─ submit.php
 │   └─ tableEditor.php
 └─ usr
 │   └─ js.php
 ├─ admin.php
 ├─ api.php
 ├─ favicon.ico
 └─ index.php

```

进入 `lib` 文件夹，将 `config.example.php` 复制一份并重命名为 `config.php` ，修改 `config.php` 中相关的信息。

然后在浏览器中访问 `web_root/your_path/lib/init.php` 来初始化数据库。

## Rewrite（必要）

如果是安装在子目录中的话需要做相应的修改，详细方法请 Google 或 Baidu 。

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

Copyright © 2017-2019 [Lucien Shui](http://www.lucien.ink) All Rights Reserved

# 免责声明

本工具只提供文本分享的载体部分，与所有的文本内容均没有任何联系。

# 捐助

## 捐助名单

小伙伴们在捐助的时候可以添加留言以告知自己的 `ID` ，如果是 `GitHub` 账号的话我会顺便 `@` 出来。

> 以前捐助过的小伙伴请给我发个邮件（lucien@lucien.ink）告知一下自己的 `ID` ，我会加到列表里，之前的收款码看不了付款人 `ID` 的全称。

| ID | 金额 |
|--|--|
| Mrs Shui | 1.98 |
| [Edwiv](https://github.com/Edwiv) | 1.99 |

![谢谢老板](https://github.com/LucienShui/gitcdn/blob/master/pasteme_donate.png?raw=true)
