<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('data_model');
    }

    public function clear(){
        $this->data_model->clear();
        redirect('service/list');
    }
}

?>