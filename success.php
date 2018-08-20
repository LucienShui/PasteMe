<?php
/**
 * User: Lucien Shui
 * Date: 2018/7/23
 * Time: 20:55
 */
require 'lib/frame.php';
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $config = include_once('lib/config.php');
    head();
    success($keyword, $config['website'] . $keyword);
    foot();
}
?>