<?php
/**
 * Author: Lucien Shui
 * Date: 2018/3/24
 * Time: 12:41
 */
class dbEditor {
    private $connection = null;
    private $config;
    public function __construct() {
        $this->config = require('config.php');
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
        $key, $text, $type, $password, $visble
        ) {
        $sql = $this->connection->prepare("INSERT INTO `{$table}` VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param("{$key_type}sssi", $key, $text, $type, $password, $visble);
        if ($sql->execute()) return True;
        return $this->error();
    }

    public function query($table, $key_type, $key) {
        $sql = $this->connection->prepare("SELECT `text`, `type`, `passwd`, `visble` FROM `{$table}` WHERE `key` = ?"); 
        $sql->bind_param($key_type, $key);
        $sql->execute();
        $sql->store_result();
        if ($sql->num_rows > 0) {
            $sql->bind_result($text, $type, $passwd, $visble);
            $sql->fetch();
            $sql->close();
            return array(
                'text' => $text,
                'type' => $type,
                'passwd' => $passwd, 
                'visble' => $visble,
            );
        } 
        return False;
    }

    public function erase($key) {
        $sql = $this->connection->prepare("DELETE FROM `temp` WHERE `key` = ?");
        $sql->bind_param('s', $key);
        if ($sql->execute()) return True;
        return False;
    }

    public function invisble($key) {
        $cur = $key % 10;
        $sql = $this->connection->prepare("UPDATE `perm{$cur}` set `visble` = 0 WHERE `key` = ?");
        $sql->bind_param('i', $key);
        if ($sql->execute()) return True;
        return False;
    }

    public function get_id() {
        $array = mysqli_fetch_array(mysqli_query($this->connection, "SELECT `id` FROM `id` WHERE `name` = 'id'"));
        return $array['id'];
    }

    public function inc_id() {
        mysqli_query($this->connection, "UPDATE `id` set `id` = `id` + 1");
    }
}
