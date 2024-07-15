<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class client extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('client_model');
    }

    public function login($car_number, $car_type_name) {
        // Appeler la méthode du modèle pour effectuer le login
        $client_id = $this->Client_model->login($car_number, $car_type_name);

        if ($client_id !== NULL) {
            $this->session->set_userdata('user', $client_id)
            // echo "Client ID: " . $client_id;
        } else {
            echo "Login échoué.";
        }
    }
}
?>
