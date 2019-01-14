<?php
/**
 * Created by Lucien
 * Date: 2018/8/24
 * Time: 20:36
 */
function seed() {
    $config = require('config.php');
    $seed = $config['seed'];
    return password_hash($seed, PASSWORD_DEFAULT);
}
function verify($key) {
    $config = require('config.php');
    $seed = $config['seed'];
    return password_verify($seed, $key);
}