<?php

class Cuotas extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form','url'));
    $this->load->library('session');
    $this->load->model('user_model');
  }

  public function index() {
    if($this->session->userdata('logged_in')) {
      $data['medicos'] = $this->user_model->getUsuarioMedicos();
      $this->load->view('cuotas',$data);
    } else {
      redirect('/','refresh');
    }
  }
}
?>