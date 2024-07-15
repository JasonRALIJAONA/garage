<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reservation_model extends CI_Model{
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

    public function prendre_rendez_vous($client_id, $service_id, $date_debut) {
        // Calculer la date de fin en fonction de la durée du service
        $service = $this->service_model->get_by_id($service_id);
        $duration = $service['duree']; // Durée du service au format '01:00:00'
        
        // Convertir la durée au format attendu par DateInterval (PnDTnHnMnS)
        $duration_formatted = 'PT' . substr($duration, 0, 2) . 'H' . substr($duration, 3, 2) . 'M' . substr($duration, 6, 2) . 'S';
        
        $date_debut_obj = new DateTime($date_debut);
        $date_fin_obj = clone $date_debut_obj;
        $date_fin_obj->add(new DateInterval($duration_formatted));
    
        // Vérifier la disponibilité du créneau
        $available_slot_id = $this->find_available_slot($date_debut_obj->format('Y-m-d H:i:s'), $date_fin_obj->format('Y-m-d H:i:s'));
    
        if ($available_slot_id === null) {
            return "Aucun créneau disponible pour ce créneau horaire.";
        }
    
        // Effectuer la réservation
        $reservation_data = array(
            'id_slot' => $available_slot_id,
            'id_service' => $service_id,
            'id_client' => $client_id,
            'date_debut' => $date_debut_obj->format('Y-m-d H:i:s'),
            'date_fin' => $date_fin_obj->format('Y-m-d H:i:s')
        );
    
        $this->db->insert('g_reservations', $reservation_data);
    
        return $this->db->insert_id();
    }
    
    private function find_available_slot($date_debut, $date_fin) {
        // Convertir les dates en objets DateTime pour la manipulation
        $date_debut_obj = new DateTime($date_debut);
        $date_fin_obj = new DateTime($date_fin);
    
        // Heures d'ouverture du garage
        $heure_ouverture = '08:00:00';
        $heure_fermeture = '18:00:00';
    
        // Vérifier si le créneau de réservation est dans les heures d'ouverture
        if ($date_debut_obj->format('H:i:s') < $heure_ouverture || $date_fin_obj->format('H:i:s') > $heure_fermeture) {
            return null; // Créneau en dehors des heures d'ouverture
        }
    
        // Requête pour trouver un slot disponible
        $this->db->select('id');
        $this->db->from('g_slots');
        $this->db->where("id NOT IN (
            SELECT id_slot
            FROM g_reservations
            WHERE (date_debut < '$date_fin' AND date_fin > '$date_debut')
        )");
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        } else {
            return null;
        }
    }
    
}
?>