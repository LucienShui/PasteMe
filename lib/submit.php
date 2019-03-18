<?php
/**
 * Author: Lucien Shui
 * Date: 2018/7/24
 * Time: 18:46
 */
require_once('postVerify.php');
if (isset($_POST['seed']) && verify($_POST['seed'])) {
    $keyword = '';
    require_once('tableEditor.php');
    $table = new tableEditor();
    $text = htmlspecialchars($_POST['text']);
    $type = $_POST['type'];
    if ($type == 'plain' && strpos($text, "#include") !== false) $type = 'cpp';
    $password = $_POST['password'];
    if (!empty($password)) $password = md5($password);
    $keyword = null;
    if (isset($_GET['keyword'])) $keyword = $_GET['keyword'];
    else if (isset($_POST['read_once'])) $keyword = 'read_once';
    $keyword = $table->insert($text, $type, $password, $keyword);
    echo $keyword;
}
?>