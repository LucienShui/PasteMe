<?php
$config = require('config.php');
$connection = mysqli_connect($config['dbhost'], $config['username'], $config['password']);
if (!$connection) die('Error: ' . mysqli_error($connection));
$sqlSet = [
    "CREATE DATABASE IF NOT EXISTS {$config['dbname']}",
    "USE {$config['dbname']}",
    "CREATE TABLE IF NOT EXISTS `id` (
      `name` VARCHAR (16) PRIMARY KEY,
      `id` BIGINT
    )",
        "INSERT INTO `id` VALUES ('id', 100)",
        "CREATE TABLE IF NOT EXISTS `temp` (
          `key` VARCHAR(16) PRIMARY KEY,
          `text` TEXT,
          `type` VARCHAR (16),
          `passwd` VARCHAR (37),
            `visble` BOOLEAN
        )",
];
foreach ($sqlSet as $sql) if (!$connection->query($sql)) echo 'Error: ' . mysqli_error($connection);
for ($i = 0; $i < 10; $i++) {
    $sqlSet = [
        "CREATE TABLE IF NOT EXISTS `perm{$i}` (
          `key` BIGINT PRIMARY KEY,
          `text` TEXT,
          `type` VARCHAR (16),
          `passwd` VARCHAR (37),
            `visble` BOOLEAN
        )"
        ];
    foreach ($sqlSet as $sql) if (!$connection->query($sql)) echo 'Error: ' . mysqli_error($connection);
}
echo '<br>如果没有报错的话就代表部署成功啦，快去访问主页看看吧！';
