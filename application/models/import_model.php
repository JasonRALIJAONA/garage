<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class import_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('type_model');
        $this->load->model('reservation_model');
        $this->load->model('client_model');
        $this->load->model('service_model');
    }

    public function import_csv($service_path , $travaux_path){
        $this->import_service($service_path);
        $this->import_vehicule($travaux_path);
        $this->import_reservations($travaux_path);
    }

    public function import_service($filePath) {
        $csvData = array();
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row > 0) { // Skip header row
                    $csvData[] = array(
                        'type' => $data[0],
                        'duree' => $data[1],
                    );
                }
                $row++;
            }
            fclose($handle);
        }
    
        // Batch insert data
        if (!empty($csvData)) {
            var_dump($csvData);
            $this->db->insert_batch('g_services', $csvData);
        }
    }

    public function import_vehicule($filePath) {
        $id_type=$this->type_model->dict();
        $csvData = array();
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row > 0) { // Skip header row
                    $csvData[] = array(
                        'numero_voiture' => $data[0],
                        'id_typeVoiture' => $id_type[$data[1]],
                    );
                }
                $row++;
            }
            fclose($handle);
        }
        // filter the csvdata
        $serialized = array_map('serialize', $csvData);
        $unique = array_unique($serialized);
        $csvData = array_map('unserialize', $unique);    
    
        // Batch insert data
        if (!empty($csvData)) {
            var_dump($csvData);
            $this->db->insert_batch('g_clients', $csvData);
        }
    }

    public function import_reservations($filePath) {
        $dict_client=$this->client_model->dict();
        $dict_service=$this->service_model->dict();
        // $csvData = array();
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row > 0) { // Skip header row
                    $dateParts = explode('/', $data[2]);
                    if (count($dateParts) == 3) {
                        $formattedDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
                        $date_debut = $formattedDate . ' ' . $data[3];
                        $this->reservation_model->prendre_rendez_vous($dict_client[$data[0]], $dict_service[$data[4]], $date_debut);
                    }
                }
                $row++;
            }
            fclose($handle);
        }
    }
}
?>