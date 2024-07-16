<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reservation_model extends CI_Model{
    public function __construct() {
        $this->load->database();
        $this->load->model('service_model');
    }

    public function get_reservation_by_id($reservation_id) {
        $this->db->select('r.*, s.type AS service_type, s.prix, c.numero_voiture');
        $this->db->from('g_reservations r');
        $this->db->join('g_clients c', 'r.id_client = c.id');
        $this->db->join('g_services s', 'r.id_service = s.id');
        $this->db->where('r.id', $reservation_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_all_reservation() {
        $this->db->select('r.*, s.type AS service_type, s.prix, c.numero_voiture , r.date_paiement');
        $this->db->from('g_reservations r');
        $this->db->join('g_clients c', 'r.id_client = c.id');
        $this->db->join('g_services s', 'r.id_service = s.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_reservations() {
        $query = $this->db->get('g_reservations'); // Assurez-vous que le nom de votre table est correct
        return $query->result();
    }

    public function get_all_services() {
        $query = $this->db->get('g_services');
        return $query->result_array();
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

    public function prendre_rendez_vous($client_id, $service_id, $date_debut, $prix = null) {
        // Calculer la date de fin en fonction de la durée du service
        $service = $this->service_model->get_by_id($service_id);
        $duration = $service['duree']; // Durée du service au format '01:00:00'
        
        // Convertir la durée au format attendu par DateInterval (PnDTnHnMnS)
        $duration_formatted = 'PT' . substr($duration, 0, 2) . 'H' . substr($duration, 3, 2) . 'M' . substr($duration, 6, 2) . 'S';
        
        $date_debut_obj = new DateTime($date_debut);
        $date_fin_obj = clone $date_debut_obj;
        $date_fin_obj->add(new DateInterval($duration_formatted));
    
        // Heures d'ouverture du garage
        $heure_ouverture = '08:00:00';
        $heure_fermeture = '18:00:00';
    
        // Vérifier si la réservation commence en dehors des heures d'ouverture
        if ($date_debut_obj->format('H:i:s') < $heure_ouverture || $date_debut_obj->format('H:i:s') >= $heure_fermeture) {
            return "Les réservations doivent commencer entre 08:00 et 18:00.";
        }
    
        // Vérifier si la réservation dépasse l'heure de fermeture
        if ($date_fin_obj->format('H:i:s') > $heure_fermeture) {
            // Calculer le temps restant après 18h
            $time_remaining = $date_fin_obj->getTimestamp() - (clone $date_debut_obj)->setTime(18, 0, 0)->getTimestamp();
            
            // Reprendre le travail le lendemain à 8h
            $date_fin_obj = new DateTime($date_debut_obj->format('Y-m-d') . ' 08:00:00');
            $date_fin_obj->modify('+1 day');
            $date_fin_obj->add(new DateInterval('PT' . $time_remaining . 'S'));
        }
    
        // Vérifier la disponibilité du créneau
        $available_slot_id = $this->find_available_slot($date_debut_obj->format('Y-m-d H:i:s'), $date_fin_obj->format('Y-m-d H:i:s'));
    
        if ($available_slot_id === null) {
            return "Aucun créneau disponible pour ce créneau horaire.";
        }
    
        // Si le prix n'est pas fourni, utiliser le prix du service
        if ($prix === null) {
            $prix = $service['prix'];
        }
    
        // Effectuer la réservation
        $reservation_data = array(
            'id_slot' => $available_slot_id,
            'id_service' => $service_id,
            'id_client' => $client_id,
            'date_debut' => $date_debut_obj->format('Y-m-d H:i:s'),
            'date_fin' => $date_fin_obj->format('Y-m-d H:i:s'),
            'prix' => $prix
        );
    
        $this->db->insert('g_reservations', $reservation_data);
    
        return $this->db->insert_id();
    }
    
    private function find_available_slot($date_debut, $date_fin) {
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