<?php
class Paciente_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function getPacientesTotal($search) {
    $extraWhere = '';
    if($search!='')
      $extraWhere = " apellido_p LIKE '%".$search."%' AND ";
    $qS_PacienteTotal = " SELECT COUNT(*) AS total
                          FROM paciente
                          WHERE ".$extraWhere." deleted=0";
    $query = $this->db->query($qS_PacienteTotal);
    if ($query->num_rows() > 0) {
      $row = $query->row();
      return $row->total;
    } else 
      return 0;
  }

  public function getPacientes($start,$limit,$search) {
    $result = array();
    $extraWhere = '';
    if($search!='')
      $extraWhere = " apellido_p LIKE '%".$search."%' AND ";
    $qS_PacienteTotal = " SELECT *
                          FROM paciente
                          WHERE ".$extraWhere." deleted=0 ";
    $query = $this->db->query($qS_PacienteTotal);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $result[] = array('ID'=>$row->id_paciente,'Apellidos' => $row->apellido_p.' '.$row->apellido_m, 'Nombres' => $row->nombre);
      }
    }
    return $result;
  }

  public function save($data){
    $this->db->insert('paciente', $data);
  } 
}

?>