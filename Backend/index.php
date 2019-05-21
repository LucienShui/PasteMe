<?php
/**
 * Created by Lucien
 * Date: 2018/8/26
 * Time: 11:03
 */
require_once('lib/tableEditor.php');
if (!empty($_POST)) {
    $key = '';
    $table = new tableEditor();
    $text = $_POST['content'];
    $type = $_POST['type'];
    if ($type == 'plain' && strpos($text, "#include") !== false) $type = 'cpp';
    $password = $_POST['password'];
    if (!empty($password)) $password = md5($password);
    $key = null;
    if (isset($_POST['keyword'])) $key = $_POST['keyword'];
    else if (isset($_POST['read_once'])) $key = 'read_once';
    $key = $table->insert($text, $type, $password, $key);
    echo json_encode(array(
        'status' => 201,
        'message' => 'success',
        'keyword' => $key,
    ));
} else if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $key = '';
    $password = '';
    $pos = strpos($token, ",");
    if ($pos === false) {
        $key = $token;
    } else {
        $key = substr($token, 0, $pos);
        $password = substr($token, $pos + 1, strlen($token) - $pos + 1);
    }
    $len = strlen($key);
    $table = new tableEditor();
    $array = $table->query($key);
    if ($array === false) {
        echo json_encode(array(
            'status' => 404,
            'message' => 'No such key',
        ));
    }
    else {
        $flag = false;
        $sys_password = $array['passwd'];
        if (!empty($sys_password)) {
            if (!empty($sys_password) && md5($password) == $sys_password) $flag = true;
        } else {
            $flag = true;
        }
        if ($flag) {
            if (isset($_GET['browser'])) {
                echo json_encode(array(
                    'status' => 200,
                    'content' => htmlspecialchars_decode($array['text']),
                    'type' => $array['type'],
                ));
            } else {
                echo str_replace("\r", "", htmlspecialchars_decode($array['text'])) . "\n";
            }
            if (preg_match('/[a-zA-Z]/', $key)) {
                $table->erase($key);
            }
        } else {
            echo json_encode(array(
                'status' => 403,
                'message' => 'Wrong password',
            ));
        }
    }
} else {
    echo json_encode(array(
        'status' => 501,
        'message' => 'Wrong params',
    ));
}
