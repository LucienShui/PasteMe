<?php
/**
 * Created by Lucien
 * Date: 2018/8/26
 * Time: 11:03
 */
require_once('lib/tableEditor.php');
if (isset($_GET['token'])) {
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
    $chFlag = false;
    for ($i = 0; $i < $len; $i++) {
        if ($key[$i] < '0' || $key[$i] > '9') {
            $chFlag = true;
            break;
        }
    }
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
        $sys_passwd = $array['passwd'];
        if (!empty($sys_passwd)) {
            if (!empty($sys_passwd) && md5($password) == $sys_passwd) $flag = true;
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
            if ($chFlag) {
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
