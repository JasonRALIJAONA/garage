<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Chargez le modèle nécessaire
        $this->load->model('Client_model');
        $this->load->model('Service_model');

        $this->load->model('Reservation_model');

        $this->load->helper('form');
        $this->load->library('form_validation');
        require_once APPPATH . 'libraries/fpdf185/fpdf.php';
    }

    public function index() {
        // Charger les rendez-vous depuis le modèle
        $reservations = $this->Reservation_model->get_all_reservations();

        // Préparer les données pour la vue
        // $data['title'] = 'Calendrier des Rendez-vous';
        
        $data['clients'] = $this->Client_model->get_all();
        $data['services'] = $this->Service_model->get_all();
        
        $data['contents'] = 'calendrier';
        $data['reservations'] = $reservations;
        $this->load->view('templates/template-admin', $data);
    }

    public function process_reservation() {
        // Récupérer les données du formulaire
        $client_id = $this->session->userdata('client_id');
        $service_id = $this->input->post('service_id');
        $date_debut = $this->input->post('date_debut');
    
        // Vérifier si les champs requis sont remplis
        if (!empty($client_id) && !empty($service_id) && !empty($date_debut)) {
            // Appeler la méthode du modèle pour prendre le rendez-vous
            $reservation_id = $this->Reservation_model->prendre_rendez_vous($client_id, $service_id, $date_debut);
    
            if (is_string($reservation_id)) {
                // Afficher un message d'erreur
                // Préparer les données pour la vue d'accueil
                $data['clients'] = $this->Client_model->get_all();
                $data['services'] = $this->Service_model->get_all();
                $data['reservations'] = $this->Reservation_model->get_all_reservations();
                $data['contents'] = 'accueil';

                $data['error_message'] = $reservation_id;
                $this->load->view('templates/template', $data);
                return;
            } else {
                // Générer le PDF et obtenir l'URL du fichier
                $pdf_url = base_url('reservation/view_pdf/' . $reservation_id);
    
                // Préparer les données pour la vue d'accueil
                $data['clients'] = $this->Client_model->get_all();
                $data['services'] = $this->Service_model->get_all();
                $data['reservations'] = $this->Reservation_model->get_all_reservations();
                $data['contents'] = 'accueil';
                
                // Charger la vue avec les données nécessaires
                $this->load->view('templates/template', $data);
    
                // Ajouter un script JavaScript pour ouvrir le PDF dans un nouvel onglet
                echo '<script type="text/javascript">
                    window.open("' . $pdf_url . '", "_blank");
                </script>';
                return;
            }
        } else {
            // Afficher un message d'erreur si les champs sont vides
            $data['error_message'] = "Veuillez remplir tous les champs.";
        }
    
        // Charger la vue avec les données nécessaires
        $data['services'] = $this->Service_model->get_all();
        $data['contents'] = 'view_pdf';
        $this->load->view('templates/template', $data);
    }
    
    
    
    private function generate_pdf($reservation_id) {
        $reservation = $this->Reservation_model->get_reservation_by_id($reservation_id);
    
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
        
        return $pdfFilePath;
    }

    public function view_pdf($reservation_id) {
        $this->load->helper('url');
    
        $filePath = $this->generate_pdf($reservation_id);
        
        // Rediriger vers le fichier PDF généré
        redirect(base_url('uploads/' . basename($filePath)));
    }
    
    
    public function get_reservations() {
        $this->load->model('Reservation_model');
        $reservations = $this->Reservation_model->get_all_reservations();
    
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

    public function add_rdv() {
        $client_id = $this->input->post('client');
        $service_id = $this->input->post('service');
        $date_debut = $this->input->post('date_debut');

        // Calculer la date de fin en fonction de la durée du service
        $service = $this->Service_model->get_by_id($service_id);
        $duration = $service['duree']; // Durée du service au format '01:00:00'
        
        // Convertir la durée au format attendu par DateInterval (PnDTnHnMnS)
        $duration_formatted = 'PT' . substr($duration, 0, 2) . 'H' . substr($duration, 3, 2) . 'M' . substr($duration, 6, 2) . 'S';
        
        $date_debut_obj = new DateTime($date_debut);
        $date_fin_obj = clone $date_debut_obj;
        $date_fin_obj->add(new DateInterval($duration_formatted));

        // Vérifier la disponibilité du créneau
        $available_slot_id = $this->find_available_slot($date_debut_obj->format('Y-m-d H:i:s'), $date_fin_obj->format('Y-m-d H:i:s'));
    
        if ($available_slot_id === null) {
            echo json_encode(['error' => "Aucun créneau disponible pour ce créneau horaire."]);
            return;
        }

        // Effectuer la réservation
        $reservation_data = array(
            'id_slot' => $available_slot_id,
            'id_service' => $service_id,
            'id_client' => $client_id,
            'date_debut' => $date_debut_obj->format('Y-m-d H:i:s'),
            'date_fin' => $date_fin_obj->format('Y-m-d H:i:s')
        );
    
        $this->db->insert('g_reservations', $reservation_data);
        echo json_encode(['success' => true]);
    }
    
}

?>