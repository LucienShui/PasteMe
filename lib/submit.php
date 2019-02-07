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
    $it = new tableEditor();
    $text = htmlspecialchars($_POST['text']);
    $type = $_POST['type'];
    if ($type == 'plain' && strpos($text, "#include") !== false) $type = 'cpp';
    $password = $_POST['password'];
    if (!empty($password)) $password = md5($password);
    $keyword = $it->insert($text, $type, $password, empty($_GET['keyword']) ? null : $_GET['keyword']);
    if ($keyword == -1) echo "Sorry, there is something wrong with SQL.";
    else {
        $config = require('config.php');
        header("Refresh:0;url={$config['path']}success.php?keyword={$keyword}");
    }
}
?>