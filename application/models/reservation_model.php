<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reservation_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_all(){
        $query = $this->db->get('g_reservations');
        return $query->result_array();
    }

    public function get_by_id($id){
        $query = $this->db->get_where('g_reservations', array('id' => $id));
        return $query->row_array();
    }

    public function create ($data){
        $this->db->insert('g_reservations', $data);
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('g_reservations', $data);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('g_reservations');
    }
}
?>