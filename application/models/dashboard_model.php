<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_model extends CI_Model {

    public function get_slots_by_date($date) {
        $query = $this->db->query("CALL VueUtilisationSlotsParJour(?)", array($date));
        return $query->result_array();
    }
}
?>