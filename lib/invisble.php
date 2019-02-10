<?php
/**
 * Author: Lucien Shui
 * Date: 2019/2/10
 * Time: 16:41
 */
require_once('postVerify.php');
if (isset($_POST['seed']) && verify($_POST['seed']) && isset($_POST['key'])) {
    require_once('tableEditor.php');
    $config = require('config.php');
    $it = new tableEditor();
    $array = $it->query($_POST['key']);
    if ($array === false) echo '删除失败，请确认索引是否存在';
    else if ($array['visble'] == 0) echo '该索引已被删除过';
    else {
        $it->invisble($_POST['key']);
        echo '删除成功';
    }
    ?>
    <p><a type="button" href="<?php echo "{$config['protocol']}{$config['domain']}{$config['path']}";?>">返回主页</a></p>
    <?php
}