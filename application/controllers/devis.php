<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class devis extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('reservation_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function list(){
        $data['devis']=$this->reservation_model->get_all_reservation();
        $data['contents'] = 'list-devis';
        
        $this->load->view('templates/template-admin', $data);
    }

    public function form($id){
        $data['devis']=$this->reservation_model->get_reservation_by_id($id);
        $data['contents'] = 'date-paiement';
        
        $this->load->view('templates/template-admin', $data);
    }

    public function update(){
        $id = $this->input->post('id');
        $date_paiement = $this->input->post('date_paiement');
        // change the hour to maximum
        $date_paiement = $date_paiement . " 23:59:59";
        $data = array(
            'date_paiement' => $date_paiement
        );
        $this->reservation_model->update($id, $data);
        redirect('devis/list');
    }

    
}
?>