<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reservation extends CI_Model{
    public function __construct() {
        $this->load->database();
        $this->load->model('reservation_model');
    }

    public function list(){
        $data = array();

        $data['reservations'] = $this->reservation_model->get_all();
        $data['contents'] = 'list-reservation';

        $this->load->view('templates/template', $data);
    }

}
?>