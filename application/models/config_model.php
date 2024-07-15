<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class config_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_reference_date() {
        $this->db->select('config_value');
        $this->db->from('configurations');
        $this->db->where('config_key', 'reference_date');
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->config_value;
        } else {
            return null; // ou une valeur par défaut
        }
    }
    
}
?>
