<?php
/**
 * Author: Lucien Shui
 * Date: 2018/7/26
 * Time: 0:03
 */
$password_user = null;
$placeholder = null;
if (isset($_POST['password_user'])) {
    $password_user = $_POST['password_user'];
}
$keyword = str_replace('/', '', $_SERVER["REQUEST_URI"]); // 取当前路由的后缀
$len = strlen($keyword);
if ($len > 20) {
    $keyword = substr($keyword, 0, 20);
    header("Refresh:0;url=/" . $keyword);
    die();
}
$chFlag = False;  // 是否包含字母
$otherFlag = False;  // 是否有其它字符
function isalpha($ch) { return ($ch >= 'a' && $ch <= 'z' ) || ($ch >= 'A' && $ch <= 'Z'); }
function isdigit($ch) { return $ch >= '0' && $ch <= '9'; }
for ($i = 0; $i < $len; $i++) {
    if (isalpha($keyword[$i])) $chFlag = True;
    else if (!isdigit($keyword[$i])) {
        $otherFlag = True;
        break;
    }
}
if ($otherFlag) {  // 包含除字母和数字之外的字符
    echo "<script>alert('请确认索引串是否存在，永久空间的索引串由纯数字组成，临时空间的索引串由大小写英文字母及数字组成') </script>";
    header("Refresh:0;url=/");
} else {
    require 'util/tableEditor.php';
    $it = new tableEditor();
    if ($it->exists($keyword)) {  // 索引串存在
        $password = $it->password($keyword);
        $passwordRight = True;  // 密码是否正确
        if ($password != null && $password != '') {
            if ($password_user != $password) $passwordRight = False;
            if (!$passwordRight && isset($password_user)) $placeholder = "密码错误";
        }
        require 'util/frame.php';
        head($chFlag ? "style='background: #A0A0A0;'" : "");
        if ($passwordRight) {
            $content = $it->content($keyword);
            show($content['text'], $content['type']);
            if ($chFlag) $it->remove($keyword);
        } else passwordCertification($keyword, $placeholder);
        foot();
    } else {  // 索引串不存在
        if ($chFlag) {  // 临时空间
            require 'util/frame.php';
            head("style='background: #A0A0A0;'");
            home('这里是隐私模式，上传的内容阅后即焚', "/util/submit.php?keyword={$keyword}");
            foot();
        } else {  // 永久空间
            echo "<script> alert('请确认索引是否存在') </script>";
            header("Refresh:0;url=/");
        }
    }
}
