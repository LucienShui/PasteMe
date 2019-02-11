<?php
/**
 * Created by Lucien
 * Date: 2019/2/10
 * Time: 20:06
 */
$config = require('lib/config.php');
if (isset($_GET['token']) && $_GET['token'] == $config['passwd']) {
    require_once('lib/tableEditor.php');
    $table = new tableEditor();
    require_once('lib/frame.php');
    require_once('lib/postVerify.php');
    head();
    if (isset($_POST['seed']) && verify($_POST['seed']) && isset($_POST['key'])) {
        $array = $table->query($_POST['key']);
        if ($array === false) admin('删除失败，请确认索引是否存在', seed());
        else if ($array['visble'] == 0) admin('该索引已被删除过', seed());
        else {
            $table->invisble($_POST['key']);
            admin('删除成功', seed());
        }
    } else admin("当前有 {$table->size()} 个 Paste", seed());
    foot();
}