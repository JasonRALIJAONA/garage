<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class service extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('service_model');
        $this->load->helper('form');
    }

    public function list(){
        $data=array();

        $data['services']=$this->service_model->get_all();
        $data['contents'] = 'list-services';

        $this->load->view('templates/template-admin', $data);
    }

    public function view($id){
        $data=array();

        $data['service']=$this->service_model->get_by_id($id);
        $data['contents'] = 'service';

        $this->load->view('templates/template', $data);
    }

    public function create(){
        $info = array(
            'type' => $this->input->post('type'),
            'duree' => $this->input->post('duree'),
            'prix' => $this->input->post('prix')
        );

        $error = [];

        if ($info['duree'] < 0) {
            $error[] = "La durée doit être positive";
        }

        if ($info['prix'] < 0) {
            $error[] = "Le prix doit être positif";
        }

        if (!empty($error)) {
            $data['error'] = $error;
            $data['content'] = "service";
            $this->load->view('templates/template', $data);
            return;
        }

        $this->service_model->create($info);
        redirect('service/list');
    }

    public function delete($id){
        $this->service_model->delete($id);
        redirect('service/list');
    }

    public function update(){
        // Récupérer les données du formulaire
        $id = $this->input->post('id');
        $info = array(
            'type' => $this->input->post('type'),
            'duree' => $this->input->post('duree'),
            'prix' => $this->input->post('prix')
        );

        $error = [];

        if ($info['duree'] < 0) {
            $error[] = "La durée doit être positive";
        }

        if ($info['prix'] < 0) {
            $error[] = "Le prix doit être positif";
        }

        if (!empty($error)) {
            $data['error'] = $error;
            $data['content'] = "service";
            $this->load->view('templates/template', $data);
            return;
        }
        $this->service_model->update($id, $info);
        redirect('service/list');
    }
}
?>