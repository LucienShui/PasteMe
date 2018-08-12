<?php
require_once 'dbEditor.php';
class tableEditor {
    private $db = null;
    public function insert($text, $type = 'plain', $password = '') {
        if ($this->db == null) $this->db = new dbEditor();
        $id = $this->db->get_id();
        if ($this->db->insert($id, $text, $type, $password)) {
            $this->db->inc_id();
            return $id;
        } return -1;
    }
    public function password($id) {
        if ($this->db == null) $this->db = new dbEditor();
        return $this->db->get_password($id);
    }
    public function content($id) {
        if ($this->db == null) $this->db = new dbEditor();
        return $this->db->get_array($id);
    }
    public function exists($id) {
        if ($this->db == null) $this->db = new dbEditor();
        return $this->db->exists($id);
    }
}
?>
