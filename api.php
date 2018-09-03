<?php
/**
 * Created by Lucien
 * Date: 2018/8/26
 * Time: 11:03
 */
require ('lib/tableEditor.php');
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $len = strlen($keyword);
    $chFlag = false;
    for ($i = 0; $i < $len; $i++) if ($keyword[$i] < '0' || $keyword[$i] > '9') {
            $chFlag = true;
            break;
        }
    $it = new tableEditor();
    if ($it->exists($keyword)) {
        $flag = false;
        $password = $it->password($keyword);
        if (!empty($password)) {
            if (isset($_GET['password']) && md5($_GET['password']) == $password) {
                $flag = true;
            }
        } else $flag = true;
        if ($flag) {
            $content = $it->content($keyword);
            echo str_replace("\r", "", htmlspecialchars_decode($content['text'])) . "\n";
            if ($chFlag) $it->remove($keyword);
        } else echo 'password wrong';
    } else echo 'keyword not found';
} else echo 'wrong args';
