<?php

class Status_model extends CI_Model {
    public function getAllStatus() {
        return $this->db->get('statuses')->result();
    }
}