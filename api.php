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
    $passwd = '';
    $pos = strpos($token, ",");
    if ($pos === false) {
        $key = $token;
    } else {
        $key = substr($token, 0, $pos);
        $passwd = substr($token, $pos + 1, strlen($token) - $pos + 1);
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
            'code' => 404,
            'data' => array(
                'message' => 'key not found',
            )
        ));
    }
    else {
        $flag = false;
        $sys_passwd = $array['passwd'];
        if (!empty($sys_passwd)) {
            if (!empty($sys_passwd) && md5($passwd) == $sys_passwd) $flag = true;
        } else {
            $flag = true;
        }
        if ($flag) {
            if (isset($_GET['browser'])) {
                echo json_encode(array(
                    'code' => 200,
                    'data' => array(
                        'message' => 'success',
                        'content' => $array['text'],
                        'type' => $array['type'],
                    )
                ));
            } else {
                echo str_replace("\r", "", htmlspecialchars_decode($array['text'])) . "\n";
            }
            if ($chFlag) {
                $table->erase($key);
            }
        } else {
            echo json_encode(array(
                'code' => 406,
                'data' => array(
                    'message' => 'passwd wrong',
                )
            ));
        }
    }
} else {
    echo json_encode(array(
        'code' => 500,
        'data' => array(
            'message' => 'wrong args',
        )
    ));
}
