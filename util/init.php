<?php
$config = require('config.php');
$connection = mysqli_connect($config['dbhost'], $config['username'], $config['password']);
if (!$connection) die('Error: ' . mysqli_error($connection));
$sqlSet = [
    "CREATE DATABASE IF NOT EXISTS {$config['dbname']}",
    "USE {$config['dbname']}",
    "CREATE TABLE IF NOT EXISTS `id` (`id` int PRIMARY KEY)",
    "INSERT INTO `id` VALUES (100)",
    "CREATE TABLE IF NOT EXISTS `pasteme` (
      `keyword` VARCHAR(107) PRIMARY KEY,
	  `text` text,
	  `type` varchar(107),
	  `password` varchar(37))"
];
foreach ($sqlSet as $sql) if (!$connection->query($sql)) die('Error' . mysqli_error($connection));
echo 'Success';
//unlink('init.php');
header("Refresh:0;url=/");
?>
