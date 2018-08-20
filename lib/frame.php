<?php
/**
 * User: Lucien Shui
 * Date: 2018/7/25
 * Time: 23:18
 */
function head($color = '', $title = 'PasteMe') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title><?php echo $title; ?></title>
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
                        <div class="form-inline" onkeyup="enterJudge()">
                            <input style="display: none;" title="">
                            <input name="keyword" id="keyword" class="form-control mr-sm-2" type="text" title="请填入纯数字的索引串"
                                   required="required" pattern="[0-9]*" placeholder="索引串"/>
                            <button class="btn btn-primary my-2 my-sm-0" onclick="redirect()">
                                前往
                            </button>
                        </div>
                        <ul class="navbar-nav ml-md-auto">
                            <li class="nav-item"><a class="nav-link" href='#modal-container-74921' data-toggle='modal'>捐助</a></li>
                            <li class="nav-item"><a class="nav-link" href='#modal-container-74922' data-toggle='modal'>使用指南</a></li>
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
                                <img src="/money.png" style="width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class='modal fade' id='modal-container-74922' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='myModalLabel'>使用指南</h5>
                                <button type='button' class='close' data-dismiss='modal'>
                                    <span aria-hidden='true'>&times;</span></button>
                            </div>
                            <div class='modal-body'>
                                <p>索引串：</p>
                                <p>每一个被上传的文本都有一个字符串去对其进行唯一标识，就像是门牌号一样，我称它为“索引串”。纯数字的索引串对应永久空间的文本，包含字母的索引串对应临时空间的文本。</p>
                                对于别人分享的文本：
                                <ul>
                                    <li>可直接通过网页链接访问。</li>
                                    <li>可在主页左上角的输入框输入索引串进行访问。</li>
                                </ul>
                                对于上传的文本有两种选择：
                                <ul>
                                    <li><b>永久保存</b>：直接在主页进行上传。</li>
                                    <li><b>阅后即焚</b>：在左上角输入含有字母的索引串，前往相应的临时空间，页面会变成灰色，并开始对索引串进行索引。若索引至一个已存在的内容则进行“<a style="color: green;">阅读</a>”，若索引至一个“空地”则进行“<a style="color: red;">创建</a>”。</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br><br>
    <?php
}

function home($placeholder = '写点什么进来吧', $action = '/lib/submit.php') {
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
                                    <select name="type" class="form-control" title="language" style="-webkit-appearance: none;-moz-appearance: none;appearance: none;">
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
    <style>
    a:link, a:visited {
        color: #38488f;
        /*color: dimgray;*/
    }
    </style>
    <footer>
        <div style="text-align: center;">
            <p><a href='http://www.lucien.ink' target='_blank'>Lucien's Blog</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.lucien.ink/go/csdn" target='_blank'>CSDN</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="https://github.com/LucienShui" target="_blank">GitHub</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.miitbeian.gov.cn/" target='_blank'>鲁ICP备18007563号</a></p>
            <p>Copyright &copy; 2017-<?php echo date('Y'); ?> <a href='mailto:lucien@lucien.ink'>Lucien Shui</a> All Rights Reserved</p>
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

function success($keyword, $url) {
    ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="jumbotron">
                <h2>
                    保存成功
                </h2>
                <p>
                    欲访问索引串<b><?php echo $keyword?></b>所对应的文本：
                </p>
                <ul>
                    <li>在主页中输入索引串</li>
                    <li>在浏览器中访问：<a href="<?php echo $url?>"><?php echo $url?></a></li>
                    <li><a href = 'http://qrcode.lucien.ink?text=<?php echo $url?>&tag=PasteMe - 可能是最low的文本分享平台' target='_blank'>扫描二维码</a></li>
                </ul>
                <p>
                    <a class="btn btn-primary btn-large" href="/">返回主页</a>
                </p>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <?php
}
?>


