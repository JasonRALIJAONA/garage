<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class configuration extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('configuration_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['configuration']=$this->configuration_model->get();
        $data['contents'] = 'date-reference';
        
        $this->load->view('templates/template-admin', $data);
    }

    public function update(){
        $data = array(
            'date_reference' => $this->input->post('date_reference'),
        );
        $this->configuration_model->update($data);
        redirect('configuration');
    }
    
}
?>