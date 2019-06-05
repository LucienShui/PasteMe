## 版本选择

<details>
<summary>Release</summary>

#### build

https://github.com/LucienShui/PasteMe/releases/latest

</details>

<details>
<summary>master 分支</summary>

#### Demo

https://pasteme.cn

#### build

https://github.com/LucienShui/PasteMe/tree/build

#### 源码

https://github.com/LucienShui/PasteMe

</details>

<details>
<summary>dev 分支</summary>

#### Demo

http://dev.pasteme.cn

#### 源码

https://github.com/LucienShui/PasteMe/tree/dev

</details>

</details>

## 配置文件

> 请注意，这里为了更易懂才加入注释，实际部署时请将注释删去

### config.json

```json
{
  "api": "<protocol>://<domain>/<path>/api/", // 前端向后端发起请求时的地址
  "base_url": "<domain>/<path>/", // index.html 所在的域名 + 子目录
  "protocol": "<protocol>://", // http 或 https
  "footer": [ // 自定义底部链接
    {
      "url": "http(s)://<custom_address_0>",
      "text": "<custom_name_0>"
    },
    {
      "url": "http(s)://<custom_address_1>",
      "text": "<custom_name_1>"
    }
  ]
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
</details>

## 部署

<details>
<summary>部署至域名根目录</summary>

1. `wget https://github.com/LucienShui/PasteMe/releases/latest/download/PasteMe-build.zip && unzip PasteMe-build.zip `
2. 将 `PasteMe-build` 文件夹中的文件放至域名对应的根目录
3. 妥善配置 `config.json` 和 `config.php`
4. 配置伪静态至 `index.html`
5. 在网页中访问 `api/lib/init.php`

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

1. 修改 `Frontend/vue.config.js` 中的 `webPath` ，然后通过 `./build.sh` 进行重新编译，需要 `nodejs` 。

```bash
$ vim Frontend/vue.config.js
$ ./build.sh
```

2. 将 `pasteme` 文件夹中的文件放至域名对应的目录
3. 妥善配置 `config.json` 和 `config.php`
4. 配置伪静态至 `index.html`
5. 在网页中访问 `api/lib/init.php`

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

</details>