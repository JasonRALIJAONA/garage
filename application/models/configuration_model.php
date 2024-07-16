<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class configuration_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function update($data){
        $this->db->update('configuration', $data);
    }

    public function get(){
        $query = $this->db->get('configuration');
        return $query->row();
    }
}
?>