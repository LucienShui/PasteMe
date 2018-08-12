<?php
/**
 * User: Lucien Shui
 * Date: 2018/7/26
 * Time: 0:03
 */
$password_user = null;
$placeholder = null;
if (isset($_POST['password_user'])) {
    $password_user = $_POST['password_user'];
}
$request_url = $_SERVER["REQUEST_URI"]; // 取当前路由的后缀
$keyword = str_replace('/', '', $request_url);
if (preg_match('/^[0-9]*$/', $keyword) == 0) {
    echo "<script> alert('请确认索引是否存在') </script>";
    header("Refresh:0;url=/" . $url);
} else {
    require 'util/tableEditor.php';
    $it = new tableEditor();
    if (!$it->exists($keyword)) {
        echo "<script> alert('请确认索引是否存在') </script>";
        header("Refresh:0;url=/" . $url);
    } else {
        $password = $it->password($keyword);
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
        if ($flag) {
            $content = $it->content($keyword);
            show($content['text'], $content['type']);
        } else {
            passwordCertification($keyword, $placeholder);
        }
        foot();
    }
}
?>
