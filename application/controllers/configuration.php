<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Configuration_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['configuration']=$this->Configuration_model->get();
        $data['contents'] = 'date-reference';
        
        $this->load->view('templates/template-admin', $data);
    }

    public function update(){
        $data = array(
            'date_reference' => $this->input->post('date_reference'),
        );
        $this->Configuration_model->update($data);
        redirect('configuration');
    }
    
}
?>