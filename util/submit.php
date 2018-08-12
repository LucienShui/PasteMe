<?php
/**
 * User: Lucien Shui
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
    if (isset($_POST['keyword'])) {
        $keyword = $_POST['keyword'];
        $it->temporaryInsert($keyword, $text, $type, $password);
    } else {
        $keyword = $it->insert($text, $type, $password);
        if (~$keyword) $keyword = '';
    }
}
header("Refresh:0;url=/" . $keyword);
?>