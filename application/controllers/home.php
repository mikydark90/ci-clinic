<?php

class Home extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form','url'));
    $this->load->library('session');
  }

  public function index() {
    $this->load->view('home');
  }
}
?>