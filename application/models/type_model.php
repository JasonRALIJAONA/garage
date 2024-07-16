<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_all(){
        $query=$this->db->get('g_typevoiture');
        return $query->result_array();
    }

    public function dict(){
        $data=$this->get_all();
        $tab=array();
        
        for ($i=0; $i < count($data); $i++) { 
            $tab[$data[$i]['nom']]=$data[$i]['id'];
        }

        return $tab;
    }
}
?>