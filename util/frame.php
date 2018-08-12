<?php
/**
 * User: Lucien Shui
 * Date: 2018/7/25
 * Time: 23:18
 */
function head() {
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

    <body>
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

function foot() {
    ?>
            </div>
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
?>