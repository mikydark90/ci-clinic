<?php

class Login extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form','url'));
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('user_model');
  }

  public function index() {
    if($this->input->post('form_login')) {
      //This method will have the credentials validation
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
      if($this->form_validation->run() == FALSE) {
        //Field validation failed.  User redirected to login page
        $this->load->view('home');
      } else {
        $this->load->view('home');
      }
    }
  }

  public function check_database($password){
    $username = $this->input->post('username');
    //query the database
    $result = $this->user_model->login($username, $password);
    if($result) {
      $sess_array = array();
      foreach($result as $row) {
        $sess_array = array(
         'id' => $row->id,
         'username' => $row->username,
         'is_admin' => $row->is_admin);
        $this->session->set_userdata('logged_in', $sess_array);
      }
      return TRUE;
    } else {
      return false;
    }
  }
}
?>