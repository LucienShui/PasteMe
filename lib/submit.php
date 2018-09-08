<?php
/**
 * Author: Lucien Shui
 * Date: 2018/7/24
 * Time: 18:46
 */
require ('postVerify.php');
if (isset($_POST['seed']) && verify($_POST['seed'])) {
    $keyword = '';
    require 'tableEditor.php';
    $it = new tableEditor();
    $text = htmlspecialchars($_POST['text']);
    $type = $_POST['type'];
    if ($type == 'plain' && strpos($text, "#include") !== false) $type = 'cpp';
    $password = $_POST['password'];
    if (!empty($password)) $password = md5($password);
    if (!empty($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $it->temporaryInsert($keyword, $text, $type, $password);
    } else {
        $keyword = $it->insert($text, $type, $password);
        if (~$keyword) $url = '';
    }
    if ($keyword == -1) echo "Sorry, there is something wrong with SQL.";
    else header("Refresh:0;url=/success.php?keyword=" . $keyword);
}
?>