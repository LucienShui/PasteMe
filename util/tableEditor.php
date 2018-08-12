<?php
require_once 'dbEditor.php';
class tableEditor {
    private $db = null;
    public function insert($text, $type = 'plain', $password = '') {
        if ($this->db == null) $this->db = new dbEditor();
        $keyword = $this->db->get_id();
        if ($this->db->insert($keyword, $text, $type, $password)) {
            $this->db->inc_id();
            return $keyword;
        } return -1;
    }
    public function temporaryInsert($keyword, $text, $type = 'plain', $password = '') {
        if ($this->db == null) $this->db = new dbEditor();
        if ($this->db->insert($keyword, $text, $type, $password)) return $keyword;
        return -1;
    }
    public function password($keyword) {
        if ($this->db == null) $this->db = new dbEditor();
        return $this->db->get_password($keyword);
    }
    public function content($keykeyword) {
        if ($this->db == null) $this->db = new dbEditor();
        return $this->db->get_array($keykeyword);
    }
    public function exists($keyword) {
        if ($this->db == null) $this->db = new dbEditor();
        return $this->db->exists($keyword);
    }
    public function remove($keyword) {
        if ($this->db == null) $this->db = new dbEditor();
        return $this->db->remove($keyword);
    }
}
?>
