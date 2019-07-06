# Deploy

## 一键部署

系统中需要有 `wget` 和 `git`

`wget https://raw.githubusercontent.com/LucienShui/PasteMe/master/install.sh && bash install.sh`

### 目录

如果你使用一键部署，那么：
+ 前端：`/usr/local/pasteme/`
+ 前端的配置文件：`/etc/pasteme/usr/config.json`
+ 前端自定义 `js`：`/etc/pasteme/usr/usr.js`
+ 后端：`/usr/local/pastemed/`
+ 后端的配置文件：`/etc/pastemed/config.sh`
+ Nginx 的配置文件：`/etc/pasteme/conf.d/default.conf`

## 配置文件说明

### `/etc/pasteme/usr/config.json`

| 字段 | 值 | 描述 | 举例 |
| :---: | :---: | --- | --- |
| api | 完整的 URL | 后端 `API` 的地址 | `https://pasteme.cn/api/` |
| base_url | 网页路径 | 前端去掉 `http(s)://` 后的地址 | `pasteme.cn/` |
| protocol | `http` 或 `https` | 网页协议类型 | `https` |
| footer | JSON 数组 | 自定义前端底部的链接 | `[]` |
| footer.url | 完整的 URL | 链接的地址 | `http://blog.lucien.ink/go/csdn` |
| footer.text | 字符串 | 链接显示的字 | `CSDN` |

### `/etc/pasteme/usr/usr.js`

前端会始终通过 `<script>` 引入这个文件，默认为空

### `/etc/pastemed/config.sh`

| 字段 | 描述 | 举例 |
| :---: | :---: | --- | --- |
| PASTEMED_DB_USERNAME | MySQL 用户名 | `username` |
| PASTEMED_DB_PASSWORD | MySQL 密码 | `password` |
| PASTEMED_DB_SERVER | MySQL 地址 | `localhost` |
| PASTEMED_DB_PORT | MySQL 端口 | `3306` |
| PASTEMED_DB_DATABASE | 数据库名  | `pasteme` |

### `/etc/pasteme/conf.d/default.conf`

此配置文件为 `Nginx` 的配置文件，修改其中的 `server_name` 后在 `Nginx` 中引入该配置文件即可
