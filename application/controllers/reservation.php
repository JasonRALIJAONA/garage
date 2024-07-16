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
        require_once APPPATH . 'libraries/fpdf185/fpdf.php';
    }

    public function index() {
        // Charger les rendez-vous depuis le modèle
        $reservations = $this->reservation_model->get_all_reservations();

        // Préparer les données pour la vue
        // $data['title'] = 'Calendrier des Rendez-vous';
        
        $data['contents'] = 'calendrier';
        $data['reservations'] = $reservations;
        $this->load->view('templates/template', $data);
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
                $this->generate_pdf($reservation_id);
                return;
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

    private function generate_pdf($reservation_id) {
        $reservation = $this->reservation_model->get_reservation_by_id($reservation_id);
    
        // Initialiser FPDF
        $pdf = new FPDF();
        $pdf->AddPage();
        
        // Titre
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(0, 51, 102); // Couleur du texte
        $pdf->Cell(0, 10, utf8_decode('Devis Réservation'), 0, 1, 'C');
        $pdf->Ln(10);
    
        // Informations de la réservation
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(230, 230, 230); // Couleur de fond
        $pdf->SetDrawColor(50, 50, 100); // Couleur des bordures
        
        $pdf->Cell(40, 10, utf8_decode('Reservation ID :'), 1, 0, 'L', true);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $reservation->id, 1, 1);
        
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, utf8_decode('Numéro Client :'), 1, 0, 'L', true);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, utf8_decode($reservation->numero_voiture), 1, 1); // Utiliser numero_client au lieu de id_client
    
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, utf8_decode('Service :'), 1, 0, 'L', true);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, utf8_decode($reservation->service_type), 1, 1);
    
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, utf8_decode('Date début :'), 1, 0, 'L', true);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $reservation->date_debut, 1, 1);
    
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, utf8_decode('Date fin :'), 1, 0, 'L', true);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $reservation->date_fin, 1, 1);
    
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, utf8_decode('Prix :'), 1, 0, 'L', true);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $reservation->prix, 1, 1);
    
        // Ajouter des bordures et des couleurs pour un meilleur design
        $pdf->SetFillColor(200, 220, 255);
        $pdf->SetDrawColor(50, 50, 100);
    
        // Sauvegarder le PDF dans le répertoire uploads
        $uploadDir = FCPATH . 'uploads';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $pdfFilePath = $uploadDir . '/reservation_' . $reservation->id . '.pdf';
        $pdf->Output($pdfFilePath, 'F');
    
        // Afficher le PDF
        $pdf->Output();
    }
    
    public function get_reservations() {
        $this->load->model('reservation_model');
        $reservations = $this->reservation_model->get_all_reservations();
    
        $events = array();
    
        foreach ($reservations as $reservation) {
            $events[] = array(
                'title' => 'Réservation ' . $reservation->id,
                'start' => $reservation->date_debut,
                'end' => $reservation->date_fin
            );
        }
    
        echo json_encode($events);
    }
    
    
}

?>