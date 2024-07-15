<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reservation extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Chargez le modèle nécessaire
        $this->load->model('client_model');
        $this->load->model('reservation_model');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function process_reservation() {
        // Récupérer les données du formulaire
        $client_id = $this->session->userdata('client_id');
        $service_id = $this->input->post('service_id');
        $date_debut = $this->input->post('date_debut');
    
        // Vérifier si les champs requis sont remplis
        if (!empty($client_id) && !empty($service_id) && !empty($date_debut)) {
            // Appeler la méthode du modèle pour prendre le rendez-vous
            $reservation_id = $this->reservation_model->prendre_rendez_vous($client_id, $service_id, $date_debut);
    
            if (is_string($reservation_id)) {
                // Afficher un message d'erreur
                $data['error_message'] = $reservation_id;
            } else {
                // Rediriger ou afficher un message de succès
                redirect('reservation/success'); // Redirection vers une page de succès par exemple
            }
        } else {
            // Afficher un message d'erreur si les champs sont vides
            $data['error_message'] = "Veuillez remplir tous les champs.";
        }
    
        // Charger la vue avec les données nécessaires
        $data['services'] = $this->service_model->get_all();
        $data['contents'] = 'accueil';

        $this->load->view('templates/template', $data);
    }
    
}

?>