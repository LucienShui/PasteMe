<?php
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

    public function insert($keyword, $text, $type = 'plain', $password = '') {
        $sql = $this->connection->prepare("INSERT INTO `pasteme` VALUES (?, ?, ?, ?)");
        $sql->bind_param('dsss', $keyword, $text, $type, $password);
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

    public function exists($keyword) {
        $sql = $this->connection->prepare("SELECT `keyword` FROM `pasteme` WHERE `keyword` = ?");
        $sql->bind_param('s', $keyword);
        $sql->execute();
        $sql->store_result();
        return $sql->num_rows > 0;
    }

    public function get_id() {
        $array = mysqli_fetch_array(mysqli_query($this->connection, "SELECT * FROM `id`"));
        return $array['id'];
    }

    public function inc_id() {
        mysqli_query($this->connection, "UPDATE `id` set `id` = `id` + 1");
    }
}
?>