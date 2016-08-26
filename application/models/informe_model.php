<?php
class Informe_model extends CI_Model {
  
  public function __construct() {
    $this->load->database();
  }

  public function save($data){
    $this->db->insert('data_informe', $data);
  }

  public function getInforme($informe_id){
    $qS_Pagos = " SELECT DISTINCT p.id_paciente,UPPER(CONCAT(p.nombre,' ',p.apellido_p,' ',p.apellido_m)) AS full_name,DATE_FORMAT(p.fecha_nac,'%d-%m-%Y') AS fecha_nac,p.ci, DATE_FORMAT(i.fecha,'%d-%m-%Y') AS fecha,i.origen,i.referencia,i.analisis,i.desc_1,i.desc_2, UPPER(CONCAT(u.nombres,' ',u.apellidos)) AS medico
                  FROM data_pago pg, data_informe i, paciente p, usuario u
                  WHERE pg.id = i.pago_id AND p.id_paciente=pg.paciente_id AND pg.deleted=0 AND u.id=i.medico_id AND i.id=".$informe_id;
    $query = $this->db->query($qS_Pagos);
    if ($query->num_rows() > 0) {
      $row = $query->row();
      return $row;
    } else {
      return false;
    }
  }
}
?>