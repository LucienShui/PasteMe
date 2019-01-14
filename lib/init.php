<?php
$config = require('config.php');
$connection = mysqli_connect($config['dbhost'], $config['username'], $config['password']);
if (!$connection) die('Error: ' . mysqli_error($connection));
$sqlSet = [
    "CREATE DATABASE IF NOT EXISTS {$config['dbname']}",
    "USE {$config['dbname']}",
    "CREATE TABLE `id` (
      `name` VARCHAR (107) PRIMARY KEY,
      `id` int)",
    "INSERT INTO `id` VALUES ('id', 100)",
    "CREATE TABLE `pasteme` (
      `keyword` VARCHAR (107) PRIMARY KEY,
      `text` TEXT,
      `type` VARCHAR (107),
      `password` VARCHAR (37))"
];
foreach ($sqlSet as $sql) if (!$connection->query($sql)) echo 'Error: ' . mysqli_error($connection);
header("Refresh:0;url={$config['path']}");
