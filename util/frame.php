<?php
/**
 * User: Lucien Shui
 * Date: 2018/7/25
 * Time: 23:18
 */
function head($color = '') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>PasteMe</title>
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.1.1/css/bootstrap.min.css"/>
        <script src="/js/tools.js"></script>
    </head>

    <body <?php echo $color; ?>>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark fixed-top">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="<?php $config = require 'config.php'; echo $config['website'];?>">PasteMe</a>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1"
                                   data-toggle="dropdown">
                                    其它工具
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                                    <div class="dropdown-header">网络剪贴板</div>
                                    <a class="dropdown-item" href="http://www.lucien.ink/go/clip">ClipMe</a>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-header">在线二维码生成</div>
                                    <a class="dropdown-item" href="http://qrcode.lucien.ink">QRCode Generator</a>
                                </div>
                            </li>
                        </ul>
                        <div class="form-inline" onkeyup="enterJudge()">
                            <input name="keyword" id="keyword" class="form-control mr-sm-2" type="text" title="请填入纯数字的索引串"
                                   required="required" pattern="[0-9]*" placeholder="索引串"/>
                            <button class="btn btn-primary my-2 my-sm-0" onclick="redirect()">
                                前往
                            </button>
                        </div>
                        <ul class="navbar-nav ml-md-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2"
                                   data-toggle="dropdown">联系我</a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                                    <div class="dropdown-header">Email</div>
                                    <a class="dropdown-item">lucien@lucien.ink</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <br><br><br><br>
    <?php
}

function home($placeholder = '写点什么进来吧') {
    ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
    <form class="form-horizontal" action="util/submit.php" method="post">
        <div class="col-sm-5">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">高亮</span>
                    </div>
                    <select name="type" class="form-control" title="language">
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
                    <input class="form-control" name="password" placeholder="无需加密请留空">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="form-group">
                <textarea class="form-control" required="required" name='text' rows='10'
                          style="resize: none"
                          placeholder="<?php echo $placeholder; ?>"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </div>
    </form>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <?php
}

function foot() {
    ?>
        </div>
    </div>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    </body>
    <footer>
        <div style="text-align: center;">
            <p>&copy; 2018 版权所有 <a href='http://www.lucien.ink' target='_blank'>Lucien Shui</a></p>
        </div>
    </footer>
    </html>
    <?php
}

function show($text, $type) {
    ?>
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <link rel="stylesheet" type="text/css" href="/css/prism.css">
            <script src="/js/prism.js"></script>
            <script src="/js/prism.select-all.js"></script>
            <pre><code class="language-<?php echo $type; ?> line-numbers-rows"><?php echo $text; ?></code></pre>
        </div>
        <div class="col-md-1">
        </div>
    </div>
    <?php
}

function passwordCertification($keyword, $placeholder) {
    ?>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <form class="form-horizontal" action="/<?php echo $keyword; ?>" method="post">
                <div class="form-group">
                    <label for="pswdusr">此文本已加密，请输入密码：</label>
                    <input type="password" class="form-control" id="pswdusr" name="password_user" placeholder="<?php echo $placeholder; ?>">
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <?php
}
?>


