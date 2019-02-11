<?php
/**
 * Author: Lucien Shui
 * Date: 2018/7/26
 * Time: 0:03
 */
$config = require("lib/config.php");
$keyword = substr(
    $_SERVER["REQUEST_URI"], 
    strlen($config['path']), 
    strlen($_SERVER["REQUEST_URI"]) - strlen($config['path'])
); // 取当前路由的后缀
if ($keyword == '') {
    require_once('lib/frame.php');
    require_once('lib/postVerify.php');
    head();
    home(seed());
    foot();
    die();
}
if (($pos = strpos($keyword, '?')) !== False) {
    $dst = substr($keyword, 0, $pos);
    header("Refresh:0;url={$config['path']}{$dst}");
    die();
}
$len = strlen($keyword);
if ($len > 20) {
    echo "<script>alert('隐私串长度不得超过20') </script>";
    header("Refresh:0;url={$config['path']}");
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
    header("Refresh:0;url={$config['path']}");
} else {
    $password_user = null;
    $placeholder = null;
    if (isset($_POST['password_user'])) $password_user = md5($_POST['password_user']);
    require_once('lib/tableEditor.php');
    $table = new tableEditor();
    $array = $table->query($keyword);
    if ($array === False) {  // 索引串不存在
        if ($chFlag) {  // 临时空间
            require_once('lib/frame.php');
            require_once('lib/postVerify.php');
            head("style='background: #A0A0A0;'", "PasteMe - 隐私模式");
            home(seed(), '这里是隐私模式，上传的内容阅后即焚', "lib/submit.php?keyword={$keyword}");
            foot();
        } else {  // 永久空间
            echo "<script> alert('请确认索引是否存在') </script>";
            header("Refresh:0;url={$config['path']}");
        }
    } else {  // 索引串存在
        if ($array['visble'] == 0) {
            require_once('lib/frame.php');
            head();
            notFound();
            foot();
            die();
        }
        $password = $array['passwd'];
        $passwordRight = True;  // 密码是否正确
        if (!empty($password)) {
            if ($password_user != $password) $passwordRight = False;
            if (!$passwordRight && !empty($password_user)) $placeholder = "密码错误";
        }
        require_once('lib/frame.php');
        if ($chFlag) head("style='background: #A0A0A0;'", "PasteMe - 隐私模式");
        else head();
        if ($passwordRight) {
            show($array['text'], $array['type']);
            if ($chFlag) $table->erase($keyword);
        } else passwordCertification($keyword, $placeholder);
        foot();
    }
}
