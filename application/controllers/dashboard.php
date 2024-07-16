<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

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
        $data['stats_by_type'] = $this->dashboard_model->get_montant_chiffre_affaire_par_type_voiture();
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

    public function get_details_by_type_voiture() {
        $type_voiture = $this->input->post('type_voiture');
        $details = $this->dashboard_model->get_details_by_type_voiture($type_voiture);
        
        $output = '<table class="table">';
        $output .= '<thead><tr><th>Réservation ID</th><th>Voiture</th><th>Service</th><th>Prix</th><th>Date début</th><th>Date fin</th></tr></thead>';
        $output .= '<tbody>';
        foreach ($details as $detail) {
            $output .= '<tr>';
            $output .= '<td>' . $detail['reservation_id'] . '</td>';
            $output .= '<td>' . $detail['voiture'] . '</td>';
            $output .= '<td>' . $detail['service'] . '</td>';
            $output .= '<td>' . $detail['prix'] . '</td>';
            $output .= '<td>' . $detail['date_debut'] . '</td>';
            $output .= '<td>' . $detail['date_fin'] . '</td>';
            $output .= '</tr>';
        }
        $output .= '</tbody>';
        $output .= '</table>';

        echo $output;
    }

    public function details_by_type_voiture($type_voiture) {
        // $data['title'] = 'Détails du type de voiture';
        $data['type_voiture'] = urldecode($type_voiture);
        $data['details'] = $this->dashboard_model->get_details_by_type_voiture($data['type_voiture']);
 
        $data['contents'] = 'details';
        $this->load->view('templates/template-admin', $data);
    }

    public function get_chiffre_affaire_par_voiture() {
        $type_voiture = $this->input->post('type_voiture');
        $data['type_voiture'] = $type_voiture;
        $data['chiffre_affaire_par_voiture'] = $this->dashboard_model->get_chiffre_affaire_par_voiture($type_voiture);

        $data['contents'] = 'chiffre_affaire_par_voiture';
        $data['stats'] = $this->dashboard_model->get_montant_total_chiffre_affaire();
        $data['stats_by_type'] = $this->dashboard_model->get_montant_chiffre_affaire_par_type_voiture();
        $this->load->view('templates/template-admin', $data);
    }
}
?>
