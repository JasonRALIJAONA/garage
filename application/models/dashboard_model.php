<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_model extends CI_Model {

    public function get_slots_by_date($date) {
        $query = $this->db->query("CALL VueUtilisationSlotsParJour(?)", array($date));
        return $query->result_array();
    }

    public function get_montant_total_chiffre_affaire() {
        $query = $this->db->get('montant_total_chiffre_affaire');
        return $query->row_array();
    }
}
?>