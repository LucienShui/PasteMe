<p align="center">
  <img src="https://github.com/LucienShui/gitcdn/blob/master/duck.png?raw=true" alt="" width=200>
</p>
<p align="center">
  <a href="https://github.com/LucienShui/PasteMe/tree/build">
    <img src="https://travis-ci.org/LucienShui/PasteMe.svg?branch=master" alt="">
  </a>
  <a href="./LICENSE">
    <img src="https://img.shields.io/eclipse-marketplace/l/notepad4e.svg" alt="">
  </a>
  <a>
    <img src="https://img.shields.io/badge/version-2.0.1-brightgreen.svg" alt="version">
  </a>
  <a href="#谢谢老板">
    <img src="https://img.shields.io/badge/%24-donate-ff69b4.svg" alt="donate">
  </a>
</p>
<div align="center">
  <h1 style="align: center;">PasteMe 2.0</h1>
</div>

关于 UI 框架考虑了许久还是决定继续沿用 `Bootstrap` ，因为写 `Vue` 已经是我的极限了，没有精力去搞 `UI` 了，而且相比后端，前端真的是个天坑。QAQ

**目前仍在测试当中，请不要轻易部署至生产环境**

## 版本

<details>
<summary>Release (release-v1.2 分支)</summary>

### Demo

https://pasteme.cn

### 地址

https://github.com/LucienShui/PasteMe/tree/release-v1.2

</details>

<details>
<summary>Beta (Master 分支)</summary>

### Demo

http://beta.pasteme.cn

### 地址

https://github.com/LucienShui/PasteMe

</details>

## Feature

1. 支持的高亮
    1.1 有需要高亮其它语言的小伙伴欢迎发邮件给我
    <details>
    <summary>查看当前支持的高亮</summary>

    ```bash
    C/C++
    Java
    Python
    Bash
    HTML
    Markdown
    ```
    </details>
2. 支持多语言切换（需要写 cookie 以保存语言变动）
3. 前后端分离，前端去掉 png 和 ico 只有 200KB，后端只有 20KB，提高页面加载速度
4. 90% 的计算移至前端，无需经过网络层，提升用户体验
5. 采用 `gzip` 传输 
6. 如果部署在域名根目录的话和以前的部署方式无异

## 帮助

<details>

### 索引

每一个被上传的文本都有一个字符串去对其进行唯一标识，就像是门牌号一样，我称它为“**索引**”。纯数字的索引对应永久空间的文本，包含字母的索引对应临时空间的文本。

### 对于别人分享的内容

1. 可直接通过网页链接访问。
2. 可在主页左上角的输入框输入索引进行访问。

### 对于准备上传的内容

#### 永久保存

直接在主页进行上传。

#### 阅后即焚

1. 在左上角输入含有字母的索引，前往相应的临时空间，如果这个索引存在则显示索引内容，不存在则创建一份新的索引。

2. 在主页直接勾选 `阅后即焚`。

所有阅后即焚的内容一旦以任何方式（包括 `API` ）被成功访问就会**永久从数据库中消失**。

</details>

## 截图

<details>

![homePage](https://github.com/LucienShui/gitcdn/blob/master/pasteme_home2.0.png?raw=true)

![homePageEN](https://github.com/LucienShui/gitcdn/blob/master/pasteme_home_en2.0.png?raw=true)

![chat](https://github.com/LucienShui/gitcdn/blob/master/pasteme_chat2.0.png?raw=true)

![read_once](https://github.com/LucienShui/gitcdn/blob/master/pasteme_read_once2.0.png?raw=true)

![hello_world](https://github.com/LucienShui/gitcdn/blob/master/pasteme_hello_world2.0.png?raw=true)

![success](https://github.com/LucienShui/gitcdn/blob/master/pasteme_success2.0.png?raw=true)

![success_qrcode](https://github.com/LucienShui/gitcdn/blob/master/pasteme_success_qrcode2.0.png?raw=true)
</details>

## API

```bash
api.pasteme.cn?token=<key>,<passwd>
```

其中 `key` 为索引，`passwd` 为索引的密码（如果有），中间以英文逗号分隔。

比如：

```bash
curl 'api.pasteme.cn?token=100'
curl 'api.pasteme.cn?token=101,123'
```

## 部署前的配置

> 请注意，这里为了更易懂才加入注释，实际部署时请将注释删去

### config.json

```json
{
  "api": "<protocol>://<domain>/<path>/api/", // 前端向后端发起请求时的地址
  "base_url": "<domain>/<path>/", // index.html 所在的域名 + 子目录
  "protocol": "<protocol>://" // http 或 https
}
```

### api/lib/config.php

```php
<?php
return array(
  'dbhost' => 'localhost:3306', // 数据库服务端地址
  'username' => 'root', // 数据库用户名
  'password' => 'root', // 数据库密码
  'dbname' => 'pasteme', // 数据库名
  'passwd' => 'CHANGE_THIS', // 管理界面的密码，PS：管理界面在 2.0 中暂时被阉割掉了
);
```

## 部署

<details>
<summary>部署至域名根目录</summary>

1. `git clone -b build https://github.com/LucienShui/PasteMe.git pasteme`
2. 将 `pasteme` 文件夹中的文件放至域名对应的根目录
3. 妥善配置 `config.json` 和 `config.php`
4. 配置伪静态至 `index.html` 就可以了。

### 伪静态配置参考

#### Nginx

```
location / {
    try_files $uri $uri/ /index.html;
    location ~ .*\.(js|css)?$ {
        gzip_static on;
    }
}
```

#### Apache

```
对 Apache 不熟悉，待补
```
</details>

<details>
<summary>部署至域名子目录</summary>

1. 修改 `Frontend/vue.config.js` 中的 `webPath` ，然后通过 `./build.sh` 进行重新编译，需要 `npm` 。

```bash
$ vim Frontend/vue.config.js
$ ./build.sh
```
2. 将 `pasteme` 文件夹中的文件放至域名对应的目录
3. 妥善配置 `config.json` 和 `config.php`
4. 配置伪静态至 `index.html` 就可以了。

### 伪静态配置参考

#### Nginx

```
location /<path>/ {
    try_files $uri $uri/ /<path>/index.html;
    location ~ .*\.(js|css)?$ {
        gzip_static on;
    }
}
```

#### Apache

```
对 Apache 不熟悉，待补
```
</details>

# 其它

1. 数据库相比 `1.x` 版本没有变动
2. 只支持现代浏览器
3. 代码写的很烂，望轻喷。i

# 更新日志

[PasteMe 更新日志](https://www.lucien.ink/pasteme_log.html)

## 捐助

### 捐助名单

小伙伴们在捐助的时候可以添加留言以告知自己的 `ID` ，如果是 `GitHub` 账号的话我会顺便 `@` 出来。

> 以前捐助过的小伙伴请给我发个邮件（lucien@lucien.ink）告知一下自己的 `ID` ，我会加到列表里，之前的收款码看不了付款人 `ID` 的全称。

#### 2019-05-06 补充

然而过去了这么久之前匿名捐的小伙伴们没几个私聊我的 QAQ，所以就直接在这里把支付宝、微信里显示给我的 ID 列出来吧，特意附上了时间，欢迎各位小伙伴来认捐，谢谢各位小伙伴的支持 Orz。

| ID | 金额 | 时间 |
|--|--|--|
| Mrs Shui | 1.98 | 2018-08-24 |
| \*晨晨 | 0.99 | 2018-08-28 |
| \*绍延 | 0.99 | 2018-09-04 |
| \*鱼 | 0.99 | 2018-09-04 |
| d\*d | 0.99 | 2018-09-06 |
| \*特 | 0.99 | 2018-09-30 |
| L\*L | 0.99 | 2018-11-28 |
| \*海燕 | 0.99 | 2018-12-05 |
| \*乐 | 1.98 | 2018-12-10 |
| \*夏 | 0.99 | 2018-12-11 |
| a\*X | 0.99 | 2018-12-15 |
| \*书轩 | 0.99 | 2018-12-23 |
| \*磊毅 | 1.98 | 2018-12-27 |
| Rajy | 6.66 | 2019-01-05 |
| Jim Zhou | 0.88 | 2019-04-12 |
| LXF | 2.22 | 2019-02-02 |
| \*政 | 0.99 | 2019-02-17 |
| [@Edwiv](https://github.com/Edwiv) | 1.99 | 2019-03-02 |
| [@louyu666](https://github.com/louyu666) | 2.33 | 2019-04-18 |
| [@oierwanhong](https://github.com/oierwanhong) | 9.99 | 2019-05-02 |

### 谢谢老板

![谢谢老板](https://github.com/LucienShui/gitcdn/blob/master/pasteme_donate.png?raw=true)

## Browsers support

Modern browsers and Internet Explorer 10+.

| [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/edge/edge_48x48.png" alt="IE / Edge" width="24px" height="24px" />](https://godban.github.io/browsers-support-badges/)</br>IE / Edge | [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/firefox/firefox_48x48.png" alt="Firefox" width="24px" height="24px" />](https://godban.github.io/browsers-support-badges/)</br>Firefox | [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/chrome/chrome_48x48.png" alt="Chrome" width="24px" height="24px" />](https://godban.github.io/browsers-support-badges/)</br>Chrome | [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/safari/safari_48x48.png" alt="Safari" width="24px" height="24px" />](https://godban.github.io/browsers-support-badges/)</br>Safari |
| --------- | --------- | --------- | --------- |
| IE10, IE11, Edge| last 2 versions| last 2 versions| last 2 versions |

## 版权所有

Copyright &copy; 2017-2019 [Lucien Shui](http://www.lucien.ink) All Rights Reserved

## 免责声明

本平台只提供文本分享的载体，与所有文本内容均没有任何联系。