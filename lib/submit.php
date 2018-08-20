<?php
/**
 * Author: Lucien Shui
 * Date: 2018/7/24
 * Time: 18:46
 */
$keyword = '';
if (isset($_POST['text'])) {
    require 'tableEditor.php';
    $it = new tableEditor();
    $text = htmlspecialchars($_POST['text']);
    $type = $_POST['type'];
    $password = $_POST['password'];
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $it->temporaryInsert($keyword, $text, $type, $password);
    } else {
        $keyword = $it->insert($text, $type, $password);
        if (~$keyword) $url = '';
    }
}
header("Refresh:0;url=/success.php?keyword=" . $keyword);
?>