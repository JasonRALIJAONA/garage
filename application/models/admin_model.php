<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // retourner l'id de l'admin ayant $pseudo et $mdp
    public function login($pseudo , $mdp) {
        $sql="SELECT id FROM g_admins WHERE pseudo = ? AND mdp = sha1(?)";
        $query = $this->db->query($sql, array($pseudo, $mdp));
        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return NULL;
        }
    }    
}
?>
