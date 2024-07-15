<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Chargez le modèle nécessaire
        $this->load->model('client_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        // Récupérer la liste des types de voiture depuis le modèle
        $data['types_voiture'] = $this->client_model->get_types_voiture();
    
        // Charger la vue du formulaire de login avec les données
        $this->load->view('login_form', $data);
    }
    

    public function process_login() {
        // $this->form_validation->set_rules('car_number', 'numero', 'required|exact_length[7]');

        // Récupérer les données du formulaire
        $car_number = $this->input->post('car_number');
        $car_type_name = $this->input->post('car_type_name');

        // Vérifier si les champs requis sont remplis
        if (!empty($car_number) && !empty($car_type_name)) {
            // Appeler la méthode du modèle pour vérifier et inscrire le client si nécessaire
            $client_id = $this->client_model->login($car_number, $car_type_name);

            if ($client_id !== NULL) {
                // Rediriger vers une autre page après la connexion réussie
                $this->session->set_userdata('client_id', $client_id);
                redirect('dashboard'); // Remplacez 'dashboard' par votre URL de destination
            }
        } else {
            // Afficher un message d'erreur si les champs sont vides
            $data['error_message'] = "Veuillez remplir tous les champs.";
            $data['types_voiture'] = $this->client_model->get_types_voiture();
            $this->load->view('login_form', $data);
        }
    }
}
?>
