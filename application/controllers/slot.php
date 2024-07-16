<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class slot extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard_model');
    }

    public function index() {
        // $data['title'] = 'Calendrier des Rendez-vous';
        $data['contents'] = 'filtre-slot';
        $this->load->view('templates/template-admin', $data);
    }

}
?>
