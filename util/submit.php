<?php
/**
 * User: Lucien Shui
 * Date: 2018/7/24
 * Time: 18:46
 */
require 'tableEditor.php';
$url = '';
if (isset($_POST['text'])) {
    $text = htmlspecialchars($_POST['text']);
    $type = $_POST['type'];
    $password = $_POST['password'];
    $it = new tableEditor();
    $id = $it->insert($text, $type, $password);
    if (~$id) $url = $id;
}
header("Refresh:0;url=/" . $url);
?>