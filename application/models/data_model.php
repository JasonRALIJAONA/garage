<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function clear (){
        // delete all data from the database
        $this->db->empty_table('g_reservations');
        $this->db->empty_table('g_services');
        $this->db->empty_table('g_clients');      
    }
    
}
?>