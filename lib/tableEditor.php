<?php
require_once('dbEditor.php');
class tableEditor {
    private $db = null;
    public function __construct() {
        $this->db = new dbEditor();
    }
    public function insert($text, $type, $password, $key = null) {
        if ($key === null) {
            $key = $this->db->get_id();
            $buf = $key % 10;
            if ($this->db->insert("perm{$buf}", 'i', $key, $text, $type, $password, 1)) {
                $this->db->inc_id();
                return $key;
            }
        } else {
            if ($this->db->insert("temp", "s", $key, $text, $type, $password, 1)) return $key;
        }
        return -1;
    }
    
    public function query($key) {
        if (filter_var($key, FILTER_VALIDATE_INT) === False) {
            return $this->db->query("temp", "s", $key);
        } else {
            $buf = $key % 10;
            return $this->db->query("perm{$buf}", "i", $key);
        }
    }

    public function remove($key) {
        return $this->db->remove($key);
    }
}
?>
