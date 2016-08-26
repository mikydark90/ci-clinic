<?php

class Logout extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form','url'));
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('user_model');
  }

  public function index() {
    $this->session->unset_userdata('logged_in');
    redirect('home', 'refresh');
  }
}
?>