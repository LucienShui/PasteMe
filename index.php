<?php
require 'util/frame.php';
head();
?>
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
                          placeholder="写点什么进来吧"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </div>
</form>
<?php
foot();
?>