<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model{
    public function get_all() {
        $liste = array();

        $query= $this->db->query('SELECT customer_id, first_name, last_name FROM customer');

        foreach ($query->result_array() as $row) {
            $liste[]=$row;
        }

        return $liste;
    }

    public function get_by_id($id){
        $sql="SELECT * FROM customer WHERE customer_id=%s";
        $sql=sprintf($sql, $this->db->escape($id));
        $query= $this->db->query($sql);
        
        return $query->row_array();
    }

    public function get_by_name($first_name , $last_name){
        $liste = array();

        $sql="SELECT * FROM `customer` WHERE `first_name` LIKE %s AND `last_name` LIKE %s ";
        $sql=sprintf($sql, $this->db->escape("%".$first_name."%"), $this->db->escape("%".$last_name."%"));

        $query= $this->db->query($sql);

        foreach ($query->result_array() as $row) {
            $liste[]=$row;
        }

        return $liste;
        
    }
}

?>