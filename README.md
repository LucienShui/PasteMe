# PasteMe

Ubuntu Paste 的本土化版，有加密功能，文本框的内容可以一键复制，上传的内容可以选择**永久保存**或者是**即阅即焚**。

如果老板觉得这个项目还不错，右上角给个 **Star** 好不啦。QAQ

# 注意

为了实现 [部署问题 #1](https://github.com/LucienShui/PasteMe/issues/1) ，文件树发生了变化。因此，若要从 `v1.0` 升级至 `master` 版本请务必重新修改一次 `config.php` 。

从上一个版本开始对数据库进行了分割，为的是提高查询速度，老版本更新到此版本请先使用 [dbTrans](https://github.com/LucienShui/PasteMe/blob/dbTrans/trans_1.0_to_1.1.php) 对数据库进行转化，然后再对 `config.php` 进行更新修改。

如有 `BUG` 请提 `issue` 或在网页中进行反馈。

使用老版本请下载 `release` 版本：https://github.com/LucienShui/PasteMe/releases

# Demo 

## Release

[https://pasteme.cn](http://www.lucien.ink/go/pasteme)

## Dev

[http://api.lucien.ink/pasteme](http://api.lucien.ink/pasteme)

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
 │   └─ prism.css
 ├─ img
 │   ├─ donate.png
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
 ├─ admin.php
 ├─ api.php
 ├─ favicon.ico
 ├─ index.php
 └─ success.php

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

# 待完善

+ [x] 重写阅后即焚功能

# 捐助

## 捐助名单

小伙伴们在捐助的时候可以添加留言以告知自己的 `ID` ，如果是 `GitHub` 账号的话我会顺便 `@` 出来。

> 以前捐助过的小伙伴请给我发个邮件（lucien@lucien.ink）告知一下自己的 `ID` ，我会加到列表里，之前的收款码看不了付款人 `ID` 的全称。

| ID | 金额 |
|--|--|
| Mrs Shui | 1.98 |

![谢谢老板](https://github.com/LucienShui/gitcdn/blob/master/pasteme_donate.png?raw=true)
