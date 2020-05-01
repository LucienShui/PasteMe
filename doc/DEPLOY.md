# Deploy

> Version 3.0

`2.x` 与 `3.x` 的数据库表结构并不相同，需要进行数据迁移，详见：[数据迁移](https://github.com/LucienShui/PasteMeBackend/blob/master/MIGRATE.md)

**推荐使用 docker 以避免诸多问题**

Docker 部署请移步：[Docker Deploy](./DOCKER_DEPLOY.md)

## 结构

![](./PasteMe-Architecture.svg)

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
    ├── config.json # 前端配置文件
    └── usr.js # 前端自定义 js
```

#### 后端

```plain
/usr/local/pastemed
├── config.json # 后端配置文件
├── pastemed
└── systemd
    └── pastemed.service
```

### 配置文件
+ 前端的配置文件：`/etc/pasteme/usr/config.json`
+ 前端自定义 js：`/etc/pasteme/usr/usr.js`
+ 后端的配置文件：`/etc/pastemed/config.json`
+ Nginx 的配置文件：`/etc/pasteme/conf.d/nginx.conf`

## 手动部署

详见：
+ [Frontend Deployment](https://github.com/PasteUs/PasteMeFrontend/blob/master/DEPLOY.md)
+ [Backend Deployment](https://github.com/PasteUs/PasteMeBackend/blob/master/doc/DEPLOY.md)

## 配置文件说明

### 前端 `config.json`

| 字段 | 值 | 描述 | 举例 |
| :---: | :---: | --- | --- |
| backendApi | 相对或绝对 URL | 后端 `API` 的地址 | `https://pasteme.cn/api/` |
| adminApi | 相对或绝对 URL | 后台开放 `API` 的地址，留空则会停用相关功能 | `https://pasteme.cn/admin/api/` |
| footer | JSON 数组 | 自定义前端底部的链接 | `[]` |
| footer.url | 完整的 URL | 链接的地址 | `http://blog.lucien.ink/go/csdn` |
| footer.text | 字符串 | 链接显示的字 | `CSDN` |

### `usr.js`

前端会始终通过 `<script>` 引入这个文件，默认为空

### 后端 `config.json`

| 字段 | 描述 | 举例 |
| :---: | :---: | --- |
| `address` | 监听的地址 | `0.0.0.0` |
| `port` | 监听的端口 | `8000` |
| `database.type` | 数据源，填 `mysql` 表示使用 MySQL，填其它值都会一律使用 SQLite3 | `mysql` |
| `database.username` | MySQL 用户名 | `username` |
| `database.password` | MySQL 密码 | `password` |
| `database.server` | MySQL 地址 | `localhost` |
| `database.port` | MySQL 端口 | `3306` |
| `database.database` | 数据库名 | `pasteme` |

### `nginx.conf`

此配置文件为 `Nginx` 的配置文件，一般来说只需要更改 `server_name` 字段
