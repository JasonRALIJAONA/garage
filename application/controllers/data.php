<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Data_model');
    }

    public function clear(){
        $this->data_model->clear();
        redirect('Service/list');
    }
}

?>