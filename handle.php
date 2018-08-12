<?php
/**
 * User: Lucien Shui
 * Date: 2018/7/26
 * Time: 0:03
 */
$password_user = null;
$placeholder = null;
if (isset($_POST['id'])) {
    $password_user = $_POST['password_user'];
}
$request_url = $_SERVER["REQUEST_URI"]; // 取当前路由的后缀
$id = str_replace('/', '', $request_url);
if (preg_match('/^[0-9]*$/', $id) == 0) {
    echo "<script> alert('请确认索引是否存在') </script>";
    header("Refresh:0;url=/" . $url);
} else {
    require 'util/tableEditor.php';
    $it = new tableEditor();
    if (!$it->exists($id)) {
        echo "<script> alert('请确认索引是否存在') </script>";
        header("Refresh:0;url=/" . $url);
    } else {
        $password = $it->password($id);
        $flag = True;
        if ($password != null && $password != '') {
            if ($password_user != $password) {
                $flag = False;
            }
            if (!$flag && isset($password_user)) {
                $placeholder = "密码错误";
            }
        }
        require 'util/frame.php';
        head();
        ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
        <?php
        if ($flag) {
            $content = $it->content($id);
            ?>
            <link rel="stylesheet" type="text/css" href="/css/prism.css">
            <script src="/js/prism.js"></script>
            <script src="/js/prism.select-all.js"></script>
            <pre><code class="language-<?php echo $content['type']; ?> line-numbers-rows"><?php echo $content['text']; ?></code></pre>
            <?php
        } else {
            ?>
            <form class="form-horizontal" action="/<?php echo $id; ?>" method="post">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="pswdusr">此文本已加密，请输入密码：</label>
                        <input type="password" class="form-control" id="pswdusr" name="password_user" placeholder="<?php echo $placeholder; ?>">
                        <input style="display: none" name="id" value="<?php echo $id; ?>" title="id">
                    </div>
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
                <div class="col-sm-3">
                </div>
            </form>
            <?php
        }
        ?>
        </div>
        <div class="col-md-2">
        </div>
    </div>
        <?php
        foot();
    }
}
?>
