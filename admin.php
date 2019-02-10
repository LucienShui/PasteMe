<?php
/**
 * Created by Lucien
 * Date: 2019/2/10
 * Time: 20:06
 */
$config = require('lib/config.php');
if (isset($_GET['token']) && $_GET['token'] == $config['passwd']) {
    require_once('lib/dbEditor.php');
    $it = new dbEditor();
    require_once('lib/frame.php');
    require_once('lib/postVerify.php');
    head();
    admin($it->get_id() - 1, seed());
    foot();
}