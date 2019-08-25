# Deploy

> Version 3.0

`2.x` 与 `3.x` 的数据库表结构并不相同，需要进行数据迁移，详见：[数据迁移](https://github.com/LucienShui/PasteMeBackend/blob/master/MIGRATE.md)

**推荐使用 docker 以避免诸多问题**

Docker 部署请移步：[Docker Deploy](./DOCKER_DEPLOY.md)

## 结构

![](./PasteMe-Architecture.svg)

## 一键部署

系统中需要有 `wget` 和 `git`

`wget https://raw.githubusercontent.com/LucienShui/PasteMe/master/install.sh && bash install.sh`

1. 修改 `/etc/pasteme/conf.d/default.conf` 中的 `server_name` ，在 `Nginx` 中引入该配置文件
2. 修改 `/etc/pasteme/usr/config.json`
3. 修改 `/etc/pastemed/config.sh`
4. 执行 `pastemectl start` 以启动后端

更多关于后端控制器 `pastemectl` 的信息，详见：[pastemectl Document](https://github.com/LucienShui/PasteMeBackend/blob/master/PASTEMECTL_DOCUMENT.md)

### 文件树

#### 前端

```plain
/usr/local/pasteme
├── conf.d
│   └── nginx.conf # Nginx 配置文件
├── css
│   ├── app.xxx.css.gz
│   ├── chunk-vendors.xxx.css.gz
│   └── not_found.xxx.css.gz
├── favicon.ico
├── img
│   └── donate.xxx.png
├── index.html
├── js
│   ├── app.xxx.js.gz
│   ├── chunk-vendors.xxx.js.gz
│   ├── lang-en.xxx.js.gz
│   └── not_found.xxx.js.gz
├── LICENSE
├── README.md
└── usr
    ├── config.example.json
    ├── config.json # 前端配置文件
    └── usr.js # 前端自定义 js
```

#### 后端

```plain
/usr/local/pastemed
├── config.sh # 后端配置文件
├── db_transfer
├── LICENSE
├── pastemectl.sh
├── pastemed
├── pastemed.service
└── README.md
```

### 配置文件
+ 前端的配置文件：`/etc/pasteme/usr/config.json`
+ 前端自定义 js：`/etc/pasteme/usr/usr.js`
+ 后端的配置文件：`/etc/pastemed/config.sh`
+ Nginx 的配置文件：`/etc/pasteme/conf.d/nginx.conf`

## 手动部署

详见：
+ [Frontend Deployment](https://github.com/LucienShui/PasteMeFrontend/blob/master/DEPLOY.md)
+ [Backend Deployment](https://github.com/LucienShui/PasteMeBackend/blob/master/DEPLOY.md)

## 配置文件说明

### `config.json`

| 字段 | 值 | 描述 | 举例 |
| :---: | :---: | --- | --- |
| api | 完整的 URL | 后端 `API` 的地址 | `https://pasteme.cn/api/` |
| base_url | 网页路径 | 前端去掉 `http(s)://` 后的地址 | `pasteme.cn/` |
| protocol | `http` 或 `https` | 网页协议类型 | `https` |
| footer | JSON 数组 | 自定义前端底部的链接 | `[]` |
| footer.url | 完整的 URL | 链接的地址 | `http://blog.lucien.ink/go/csdn` |
| footer.text | 字符串 | 链接显示的字 | `CSDN` |

### `usr.js`

前端会始终通过 `<script>` 引入这个文件，默认为空

### `config.sh`

| 字段 | 描述 | 举例 |
| :---: | :---: | --- |
| PASTEMED_DB_USERNAME | MySQL 用户名 | `username` |
| PASTEMED_DB_PASSWORD | MySQL 密码 | `password` |
| PASTEMED_DB_SERVER | MySQL 地址 | `localhost` |
| PASTEMED_DB_PORT | MySQL 端口 | `3306` |
| PASTEMED_DB_DATABASE | 数据库名  | `pasteme` |

### `nginx.conf`

此配置文件为 `Nginx` 的配置文件，一般来说只需要更改 `server_name` 字段
