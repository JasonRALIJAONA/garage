<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard_model');
    }

    public function slot() {
        // $data['title'] = 'Calendrier des Rendez-vous';
        $data['contents'] = 'filtre-slot';
        $this->load->view('templates/template-admin', $data);
    }

    public function index() {
        // $data['title'] = 'Statistiques';
        $data['contents'] = 'dashboard-page';
        $data['stats'] = $this->dashboard_model->get_montant_total_chiffre_affaire();
        $this->load->view('templates/template-admin', $data);
    }

    public function filter_slots() {
        $filterDate = $this->input->post('filterDate');
        
        if (!empty($filterDate)) {
            $data['results'] = $this->dashboard_model->get_slots_by_date($filterDate);
            
            $data['contents'] = 'results_page';
            $data['filterDate'] = $filterDate;
            // $this->load->view('/results_page', $data); // Charger la vue des résultats

        $this->load->view('templates/template-admin', $data);
        } else {
            echo '<p>Veuillez sélectionner une date.</p>';
        }
    }
}
?>
