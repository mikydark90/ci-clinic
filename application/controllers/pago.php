<?php

class Pago extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form','url'));
    $this->load->library('session');
    $this->load->model('pago_model');
    $this->load->model('informe_model');
  }

  public function index() {
    if($this->session->userdata('logged_in')) {
      $this->load->view('pago');
    } else 
      redirect('/','refresh');
  }

  public function get_pagos() {
    $start = $_POST['start'];
    $draw = $_POST['draw'];
    $len = $_POST['length'];
    $search = $_POST['search'];
    $total=0;
    $results = array();
    $total   = $this->pago_model->getPagosTotal($search['value']);
    $results = $this->pago_model->getPagos($start,$len,$search['value']);
    echo json_encode(
      array('draw' => $draw,
            'recordsTotal'=> $total,
            'recordsFiltered'=> $total,
            'data'=> $results)
    );
  }

  public function get_informe() {
    $informe_id = $this->input->post('i_id');
    $result = $this->informe_model->getInforme($informe_id);
    echo json_encode($result);
  }
}
?>