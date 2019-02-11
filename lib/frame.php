<?php
/**
 * User: Lucien Shui
 * Date: 2018/7/25
 * Time: 23:18
 */
$config = require('config.php');
require_once('oneWord.php');

function head($color = '', $title = 'PasteMe - 一个不算糟糕的可私有文本分享平台') {
    global $config;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="apple-mobile-web-app-title" content="PasteMe">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="<?php echo $config['cdn']; ?>favicon.ico"/>
        <link rel="apple-touch-icon" sizes="60x60"  href="<?php echo $config['cdn']; ?>img/touch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $config['cdn']; ?>img/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $config['cdn']; ?>img/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $config['cdn']; ?>img/touch-icon-ipad-retina.png">
        <link rel="stylesheet" href="<?php echo $config['cdn']; ?>css/bootstrap.min.css"/>
    </head>

    <body <?php echo $color; ?>>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding-top: 4.5em;">
                <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark fixed-top">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo "{$config['protocol']}{$config['domain']}{$config['path']}";?>" title="返回主页">PasteMe</a>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <div class="form-inline" onkeyup="enterJudge(event)">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <?php echo "{$config['domain']}{$config['path']}"; ?>
                                    </span>
                                </div>
                                <input name="keyword" autocomplete="off" id="keyword" class="form-control" title="输入任意字母以进入隐私模式"
                                       required="required" tabindex="10" placeholder="索引串或隐私串"/>
                                <span class="input-group-append">
                                    <button class="btn btn-primary" type="button" onclick="redirect()">
                                        前往
                                    </button>
                                </span>
                            </div>
                        </div>
                        <ul class="navbar-nav ml-md-auto">
                            <li class="nav-item"><a class="nav-link" href='https://www.lucien.ink/pasteme_log.html' target="_blank">更新日志</a></li>
                            <li class="nav-item"><a class="nav-link" href='https://github.com/LucienShui/PasteMe#pasteme' target="_blank">API & 使用指南</a></li>
                            <li class="nav-item"><a class="nav-link" href='#modal-container-74921' data-toggle='modal'>捐助</a></li>
                        </ul>
                    </div>
                </nav>
                <div class='modal fade' id='modal-container-74921' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>
                                    <span aria-hidden='true'>&times;</span></button>
                            </div>
                            <div class='modal-body'>
                                <img src="<?php echo $config['cdn']; ?>img/money.png" style="width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                </div>
    <?php
}

function home($seed, $placeholder = '写点什么进来吧', $action = 'lib/submit.php') {
    ?>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">高亮</span>
                                    </div>
                                    <select name="type" tabindex="11" class="form-control" title="language" style="-webkit-appearance: none;-moz-appearance: none;appearance: none;">
                                        <option value="plain">纯文本</option>
                                        <option value="cpp">C/C++</option>
                                        <option value="java">Java</option>
                                        <option value="python">Python</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">加密</span>
                                    </div>
                                    <input class="form-control" tabindex="12" type="password" name="password" placeholder="无需加密请留空">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
                                <textarea class="form-control" tabindex="13" required="required" name='text' rows='10'
                                          style="resize: none"
                                          placeholder="<?php echo $placeholder; ?>"></textarea>
                                </div>
                                <button type="submit" tabindex="14" class="btn btn-primary">保存</button>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $seed; ?>" name="seed" style="display: none" title="">
                    </form>
                </div>
                <div class="col-md-2">
                </div>
            </div>
    <?php
}

function foot() {
    global $config;
    ?>
        </div>
    </div>
    <script src="<?php echo $config['cdn']; ?>js/tools.js"></script>
    <script src="<?php echo $config['cdn']; ?>js/jquery.min.js"></script>
    <script src="<?php echo $config['cdn']; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo $config['cdn']; ?>js/dao.voice.object.js"></script>
    <?php require_once("usr/js.php"); ?>
    </body>
    <style>
        footer {
            font-size: .8em;
        }
        footer a:link, footer a:visited {
            color: #38488f;
        }
    </style>
    <footer>
        <div style="text-align: center; margin-top: .8em;">
            <p><a><?php echo(one_word()); ?></a></p>
            <p><a href='http://www.lucien.ink' target='_blank'>Lucien's Blog</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.lucien.ink/go/csdn" target='_blank'>CSDN</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="https://github.com/LucienShui" target="_blank">GitHub</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.miitbeian.gov.cn/" target='_blank'>鲁ICP备18007563号</a></p>
            <p>&copy; 2018 - <?php echo date('Y'); ?> <a href='mailto:lucien@lucien.ink'>Lucien Shui</a> All rights reserved</p>
        </div>
    </footer>
    </html>
    <?php
}

function show($text, $type) {
    global $config;
    ?>
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <link rel="stylesheet" type="text/css" href="<?php echo $config['cdn']?>css/prism.css">
            <script src="<?php echo $config['cdn']; ?>js/clipboard.min.js"></script>
            <script src="<?php echo $config['cdn']; ?>js/prism.js"></script>
            <script src="<?php echo $config['cdn'];?>js/prism.copy-all.js"></script>
            <pre><code id="code" class="language-<?php echo $type; ?> line-numbers-rows"><?php echo $text; ?></code></pre>
        </div>
        <div class="col-md-1">
        </div>
    </div>
    <?php
}

function passwordCertification($keyword, $placeholder) {
    global $config;
    ?>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <form class="form-horizontal" action="<?php echo "{$config['path']}{$keyword}"; ?>" method="post">
                <div class="form-group">
                    <label for="pswdusr">此文本已加密，请输入密码：</label>
                    <input type="password" tabindex="1" class="form-control" id="pswdusr" name="password_user" placeholder="<?php echo $placeholder; ?>">
                </div>
                <button type="submit" tabindex="2" class="btn btn-primary">提交</button>
            </form>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <?php
}

function success($keyword) {
    global $config;
    $url = "{$config['protocol']}{$config['domain']}{$config['path']}{$keyword}";
    ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <script src="<?php echo $config['cdn']; ?>js/clipboard.min.js"></script>
            <div class="jumbotron">
                <h2>
                    保存成功
                </h2>
                <p>
                    欲访问索引串<b><?php echo $keyword?></b>所对应的文本：
                </p>
                <ul>
                    <li>在主页中输入索引串</li>
                    <li>在浏览器中访问：<a id="url" href="<?php echo $url?>"><?php echo $url?></a> <a tabindex="1" id="copy" href="#">复制链接</a></li>
                    <li><a href = 'http://api.lucien.ink/qrcode/?text=<?php echo $url?>&tag=PasteMe - 可能是最low的文本分享平台' target='_blank'>扫描二维码</a></li>
                </ul>
                <p>
                    <a class="btn btn-primary btn-large" tabindex="2" href="<?php echo "{$config['protocol']}{$config['domain']}{$config['path']}";?>">返回主页</a>
                </p>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <script type="text/javascript">
        let url = document.getElementById('url');
        let copyLink = document.getElementById('copy');
        copyLink.setAttribute("data-clipboard-text", url.innerText);
        const clipboard = new ClipboardJS('#copy');
        clipboard.on('success', function() {
            copyLink.innerText = '复制成功';
            window.setTimeout(function () {copyLink.innerText = '复制链接'}, 2000);
        });
        clipboard.on('error', function() {
            copyLink.innerText = '复制失败';
            window.setTimeout(function () {copyLink.innerText = '复制链接'}, 2000);
        });
    </script>
    <?php
}

function admin($placeholder, $seed) {
    global $config;
    ?>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label for="key_id">请输入要删除的索引：</label>
                    <input tabindex="1" class="form-control" id="key_id" name="key" oninput="value=value.replace(/[^\d]/g,'')" placeholder="<?php echo $placeholder; ?>" required="required">
                </div>
                <input type="hidden" value="<?php echo $seed; ?>" name="seed" style="display: none" title="">
                <button type="submit" tabindex="2" class="btn btn-primary">提交</button>
            </form>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <?php
}

function notFound() {
    global $config;
    ?>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4" style="text-align: center;">
            <p><a>您所试图查看的条目涉嫌违规</a></p>
            <p><a>若有疑问请通过右下角联系管理员</a></p>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <?php
}
?>
