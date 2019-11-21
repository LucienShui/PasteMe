# 使用 Docker 部署 PasteMe

使用 Nginx 和 systemd 部署请移步：[Deploy](./DEPLOY.md)

## 环境准备

### Linux 环境

1. 安装必要的依赖

    ```bash
    sudo apt update && sudo apt install python3 vim python3-pip curl git -y
    pip3 install docker-compose
    ```

2. 安装 Docker 

    国内用户使用脚本一键安装: `sudo curl -sSL https://get.daocloud.io/docker | sh`  
    国外用户使用脚本一键安装: `sudo curl -sSL get.docker.com | sh`
    
    详细步骤参照： [https://docs.docker.com/install/](https://docs.docker.com/install/)

### Windows 环境


Windows 下的安装仅供体验，勿在生产环境使用。如有必要，请使用虚拟机安装 Linux 并将 PasteMe 安装在其中。

以下教程仅适用于 Win10 x64 下的 `PowerShell`

1. 安装 Windows 的 Docker 工具
2. 右击右下角 Docker 图标，选择 Settings 进行设置
3. 选择 `Shared Drives` 菜单，之后勾选你想安装 PasteMe 的盘符位置（例如勾选D盘），点击 `Apply`
4. 输入 Windows 的账号密码进行文件共享
5. 安装 `Python`、`pip`、`git`、`docker-compose`，安装方法自行搜索

## 配置文件说明

### usr/config.json

> 默认不存在这个文件，需自行从 `usr/config.example.json` **复制**并重命名为 `config.json`，不要使用 `mv` 命令，否则会导致 `git pull` 的时候出现 `conflict`

| 字段 | 值 | 描述 | 举例 |
| :---: | :---: | --- | --- |
| api | 完整的 URL | 后端 `API` 的地址 | `/api/` |
| footer | JSON 数组 | 自定义前端底部的链接 | `[]` |
| footer.url | 完整的 URL | 链接的地址 | `http://blog.lucien.ink/go/csdn` |
| footer.text | 字符串 | 链接显示的字 | `CSDN` |

### usr/usr.js

前端会始终通过 `<script>` 引入这个文件，可以通过这个文件加入百度统计、谷歌统计等代码，默认引入作者的 `daovoice`

## 开始安装

1. 克隆此项目的 [docker 分支](https://github.com/LucienShui/PasteMe/tree/docker)，并进入克隆至本地的文件夹

    ```bash
    git clone https://github.com/LucienShui/PasteMe.git --depth=1 -b docker pasteme
    cd pasteme
    ```

2. 修改配置文件

    ```bash
    cp frontend/usr/config.example.json frontend/usr/config.json
    vim frontend/usr/config.json
    cp backend/config/config.example.json backend/config/config.json
    vim backend/config/config.json
    ```

3. 启动服务

    ```bash
    docker-compose up -d
    ```

命令执行完成后等待 `30s`（因为需要初始化数据库和等待 `healthy check`），然后运行 `docker ps -a`，当看到所有的容器的状态没有 `unhealthy` 或 `Exited (x) xxx` 就代表 PasteMe 已经启动成功

## 更新

1. 进入到克隆至本地的文件夹

    ```bash
    cd pasteme
    ```

2. 更新 [docker-compose.yml](../docker-compose.yml)

    ```bash
    git pull
    ```

3. 更新容器

    ```bash
    docker-compose pull
    docker-compose up -d
    ```

## 日志

+ 前端 `Nginx` 日志位于 `pasteme/logs` 下
+ 后端日志通过 `docker logs pasteme-backend` 查看
+ 数据库日志通过 `docker logs pasteme-mysql` 查看

## 鸣谢

[OnlineJudgeDeploy](https://github.com/QingdaoU/OnlineJudgeDeploy)
