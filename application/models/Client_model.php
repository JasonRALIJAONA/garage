<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class client_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function prendre_rendez_vous($client_id, $service_id, $date_debut) {
        // Appeler la procédure stockée
        $query = $this->db->query("CALL PrendreRendezVous(?, ?, ?)", array($client_id, $service_id, $date_debut));
    
        // Vérifier si une erreur a été retournée
        if ($query === FALSE) {
            $error = $this->db->error();
            return $error['message'];
        } else {
            // Aucun résultat direct à récupérer comme avec une requête SQL normale
            // La procédure stockée manipule directement les données dans la base de données
            // Vous pouvez simplement retourner un message de succès ou d'échec
            return "Rendez-vous pris avec succès !"; 
        }
    }
    

    public function login($car_number, $car_type_name) {
        // Appeler la procédure stockée
        $query = $this->db->query("CALL ClientLogin(?, ?)", array($car_number, $car_type_name));
        
        // Vérifier si une erreur a été retournée
        if ($query === FALSE) {
            $error = $this->db->error();
            if ($error['code'] == 1062) { // Duplicate entry error code
                return 'Le client existe déjà';
            } else {
                return $error['message'];
            }
        } else {
            $result = $query->row();
            $query->free_result(); 
            
            // Assurez-vous de libérer tous les jeux de résultats restants (s'il y en a)
            while ($this->db->conn_id->more_results() && $this->db->conn_id->next_result()) {
                $this->db->conn_id->store_result();
            }

            return $result->id;
        }
    }


    public function get_types_voiture() {
        $query = $this->db->get('g_typevoiture');
        return $query->result_array();
    }
    
}
?>
