<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class client_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function login($car_number, $car_type_name) {
        // Préparer la requête pour appeler la procédure stockée
        $sql = "CALL ClientLogin(?, ?)";
        $query = $this->db->query($sql, array($car_number, $car_type_name));
        
        // Retourner le résultat de la procédure
        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return NULL;
        }
    }

    public function get_types_voiture() {
        $query = $this->db->get('g_typevoiture');
        return $query->result_array();
    }
    
}
?>
