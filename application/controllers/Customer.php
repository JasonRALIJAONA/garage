<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->helper('form');
    }

    public function list(){
        $data=array();

        $data['customers']=$this->customer_model->get_all();
        $data['contents'] = 'list-customer';
        $data['title'] = 'Sakila';
        $data['description'] = 'Entrainement CodeIgniter';
        $data['keywords'] = 'Sakila, CodeIgniter';

        $this->load->view('templates/template', $data);
    }

    public function profile(){
        $data=array();

        $data['customer']=$this->customer_model->get_by_id($this->input->get('id'));
        $data['contents'] = 'profile';
        $data['title'] = 'Sakila';
        $data['description'] = 'Entrainement CodeIgniter';
        $data['keywords'] = 'Sakila, CodeIgniter';

        $this->load->view('templates/template', $data);
    }

    public function research(){
        $data=array();

        $data['customers']=$this->customer_model->get_by_name($this->input->post('first_name'), $this->input->post('last_name'));
        $data['contents'] = 'list-customer';
        $data['title'] = 'Sakila';
        $data['description'] = 'Entrainement CodeIgniter';
        $data['keywords'] = 'Sakila, CodeIgniter';

        $this->load->view('templates/template', $data);
    }
}
?>