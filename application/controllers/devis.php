<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class devis extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('reservation_model');
    }

    public function list(){
        $data['devis']=$this->reservation_model->get_all_reservation();
        $data['contents'] = 'list-devis';
        
        $this->load->view('templates/template-admin', $data);
    }

    
}
?>