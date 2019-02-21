<?php
$config = require('config.php');
$connection = mysqli_connect($config['dbhost'], $config['username'], $config['password']);
if (!$connection) die('Error: ' . mysqli_error($connection));
$sqlSet_ = [
    "CREATE DATABASE IF NOT EXISTS {$config['dbname']}",
	"USE {$config['dbname']}",
	"CREATE TABLE IF NOT EXISTS `temp` (
		`key` VARCHAR(16) PRIMARY KEY,
		`text` TEXT,
		`type` VARCHAR (16),
		`passwd` VARCHAR (37),
		`visble` BOOLEAN
	  )",
	"ALTER TABLE `temp` CHANGE `key` `key` VARCHAR(16) NOT NULL"
];
foreach ($sqlSet_ as $sql) if (!$connection->query($sql)) echo 'Error: ' . mysqli_error($connection);
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
class dbEditor {
    private $connection = null;
    private $config;
    public function __construct() {
        $this->config = require ('config.php');
        $config = $this->config;
        $this->connection = mysqli_connect($config['dbhost'],$config['username'],$config['password']);
        if (!$this->connection) die('Error: ' . mysqli_error($this->connection));
        mysqli_query($this->connection, "USE `{$config['dbname']}`");
    }

    private function error() {
        echo 'Error: ' . mysqli_error($this->connection);
        return False;
    }

    public function insert(
			$table, $key_type, 
			$key, $text, $type = 'plain', $password = '', $visble = 1
			) {
        $sql = $this->connection->prepare("INSERT INTO `{$table}` VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param("{$key_type}sssi", $key, $text, $type, $password, $visble);
        if ($sql->execute()) return True;
        return $this->error();
    }
		
		public function get_password($keyword) {
			$sql = $this->connection->prepare("SELECT `password` FROM `pasteme` WHERE `keyword` = ?");
			$sql->bind_param('s', $keyword);
			$sql->execute();
			$sql->store_result();
			$sql->bind_result($password);
			$sql->fetch();
			$sql->close();
			return $password;
		}
		public function get_array($keyword) {
				$sql = $this->connection->prepare("SELECT `text`, `type` FROM `pasteme` WHERE `keyword` = ?");
				$sql->bind_param('s', $keyword);
				$sql->execute();
				$sql->store_result();
				$sql->bind_result($text, $type);
				$sql->fetch();
				$sql->close();
				return array(
						'text' => $text,
						'type' => $type,
				);
		}
		
		public function get_id() {
			$array = mysqli_fetch_array(mysqli_query($this->connection, "SELECT `id` FROM `id` WHERE `name` = 'id'"));
			return $array['id'];
	}
}

$it = new dbEditor();
$id = $it->get_id();
for ($i = 100; $i < $id; $i++) {
	$array = $it->get_array($i);
	$passwd = $it->get_password($i);
	if (empty($password)) $password = '';
	$cur = $i % 10;
	$it->insert("perm{$cur}", 'i', $i, $array['text'], $array['type'], $password);
}
