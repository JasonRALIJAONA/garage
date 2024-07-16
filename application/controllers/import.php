<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class import extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('import_model');
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['contents'] = 'importer';
        $this->load->view('templates/template-admin', $data);
    }

    public function import_csv(){
        $service_path = $_FILES["services"]["tmp_name"];
        $travaux_path = $_FILES["travaux"]["tmp_name"];
        $this->import_model->import_csv($service_path , $travaux_path);

        redirect('service/list');
    }
}
?>