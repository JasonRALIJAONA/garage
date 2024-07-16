<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function get_slots_by_date($date) {
        $query = $this->db->query("CALL VueUtilisationSlotsParJour(?)", array($date));
        return $query->result_array();
    }

    public function get_montant_total_chiffre_affaire() {
        $query = $this->db->get('montant_total_chiffre_affaire');
        return $query->row_array();
    }

    public function get_montant_chiffre_affaire_par_type_voiture() {
        $query = $this->db->get('montant_chiffre_affaire_par_type_voiture');
        return $query->result_array();
    }

    public function get_details_by_type_voiture($type_voiture) {
        $this->db->select('r.id as reservation_id, c.numero_voiture as voiture, s.type as service, s.prix as prix, r.date_debut, r.date_fin');
        $this->db->from('g_reservations r');
        $this->db->join('g_services s', 'r.id_service = s.id');
        $this->db->join('g_clients c', 'r.id_client = c.id');
        $this->db->join('g_typevoiture t', 'c.id_typeVoiture = t.id');
        $this->db->where('t.nom', $type_voiture);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_chiffre_affaire_par_voiture($type_voiture) {
        $this->db->select('c.numero_voiture as voiture, SUM(CASE WHEN r.date_paiement IS NOT NULL THEN s.prix ELSE 0 END) as montant_paye');
        $this->db->from('g_reservations r');
        $this->db->join('g_services s', 'r.id_service = s.id');
        $this->db->join('g_clients c', 'r.id_client = c.id');
        $this->db->join('g_typevoiture t', 'c.id_typeVoiture = t.id');
        $this->db->where('t.nom', $type_voiture);
        $this->db->group_by('c.numero_voiture');
        $query = $this->db->get();

        return $query->result_array();
    }
}
?>