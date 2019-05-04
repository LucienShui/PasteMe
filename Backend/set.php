<?php
/**
 * Author: Lucien Shui
 * Date: 2018/7/24
 * Time: 18:46
 */
$keyword = '';
require_once('lib/tableEditor.php');
$table = new tableEditor();
$text = $_POST['content'];
$type = $_POST['type'];
if ($type == 'plain' && strpos($text, "#include") !== false) $type = 'cpp';
$password = $_POST['password'];
if (!empty($password)) $password = md5($password);
$keyword = null;
if (isset($_POST['read_once'])) $keyword = 'read_once';
$keyword = $table->insert($text, $type, $password, $keyword);
echo json_encode(array(
    'status' => 201,
    'message' => 'success',
    'keyword' => $keyword,
));
