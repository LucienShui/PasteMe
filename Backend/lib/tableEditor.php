<?php
/**
 * Author: Lucien Shui
 * Date: 2018/2/23
 * Time: 16:09
 */
require_once('dbEditor.php');
class tableEditor {
    // private $char_set = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    private $char_set = 'qwertyuiopasdfghjklzxcvbnm0123456789';
    private $char_set_length = 36;
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
            if ($key === 'read_once') {
                do {
                    $key = '';
                    for ($i = 0; $i < 8; $i++) $key .= $this->char_set[mt_rand(0, $this->char_set_length - 1)];
                } while ($this->query($key) !== False);
            }
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

    public function erase($key) {
        return $this->db->erase($key);
    }

    public function invisble($key) {
        return $this->db->invisble($key);
    }

    public function size() : int {
        return $this->db->get_id() - 1;
    }
}
?>
