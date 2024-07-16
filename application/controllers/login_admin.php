<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Chargez le modèle nécessaire
        $this->load->model('admin_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        // Charger la vue du formulaire de login avec les données
        $this->load->view('login_admin');
    }
    

    public function process_login() {
        // $this->form_validation->set_rules('car_number', 'numero', 'required|exact_length[7]');

        // Récupérer les données du formulaire
        $nom = $this->input->post('nom');
        $mdp = $this->input->post('mdp');

        // Vérifier si les champs requis sont remplis
        if (!empty($nom) && !empty($mdp)) {
            // Appeler la méthode du modèle pour vérifier et inscrire le client si nécessaire
            $admin_id = $this->admin_model->login($nom, $mdp);

            if ($admin_id !== NULL) {
                // Rediriger vers une autre page après la connexion réussie
                $this->session->set_userdata('admin_id', $admin_id);
                redirect('dashboard');
            }else{
                // Afficher un message d'erreur si les informations d'identification sont incorrectes
                $data['erreur'] = "Nom d'utilisateur ou mot de passe incorrect.";
                $this->load->view('login', $data);
            }
        } else {
            // Afficher un message d'erreur si les champs sont vides
            $data['erreur'] = "Veuillez remplir tous les champs.";
            $this->load->view('login', $data);
        }
    }
}
?>
