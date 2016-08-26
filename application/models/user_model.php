<?php
Class User_model extends CI_Model
{
  public function __construct() {
    $this->load->database();
  }

  function login($username, $password){
    $this->db->select('id, email, is_admin,username');
    $this->db->from('usuario');
    $this->db->where('username', $username);
    $this->db->where('password', MD5($password));
    $this->db->limit(1);
    $query = $this->db->get();
    
    if($query->num_rows() == 1){
      return $query->result();
    }else{
      return false;
    }
  }

  function getUsuarioMedicos(){
    $this->db->select('id, apellidos, nombres');
    $this->db->from('usuario');
    $this->db->where('medico',1);
    $query = $this->db->get();
    return $query->result_array();
  }
}
?>