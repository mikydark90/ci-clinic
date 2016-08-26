<?php
class Pago_model extends CI_Model {
  
  public function __construct() {
    $this->load->database();
  }

  public function getPagosTotal($search) {
    $extraWhere = '';
    /*if($search!='')
      $extraWhere = " apellido_p LIKE '%".$search."%' AND ";*/
    $qS_PacienteTotal = " SELECT  COUNT( * ) AS total
                          FROM data_pago pg
                          WHERE pg.deleted=0 ".$extraWhere." AND pg.estado='Pendiente' ";
    $query = $this->db->query($qS_PacienteTotal);
    if ($query->num_rows() > 0) {
      $row = $query->row();
      return $row->total;
    } else 
      return 0;
  }

  public function getPagos($start,$limit,$search) {
    $result = array();
    $extraWhere = '';
    /*if($search!='')
      $extraWhere = " apellido_p LIKE '%".$search."%' AND ";*/
    $qS_Pagos = " SELECT DISTINCT pg.id, pg.paciente_id, pg.total, pg.estado, pg.saldo_actual, pg.saldo_final,pg.tipo,i.id AS informe_id
                          FROM data_pago pg
                          LEFT OUTER JOIN data_informe i
                          ON (pg.id = i.pago_id)
                          WHERE pg.deleted=0 ".$extraWhere." AND pg.estado='Pendiente'";
    $query = $this->db->query($qS_Pagos);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $qS_Paciente = " SELECT p.id_paciente,p.nombre,p.apellido_p,p.apellido_m,p.fecha_nac,p.ci
                          FROM paciente p                          
                          WHERE p.deleted=0 AND p.id_paciente = ".$row->paciente_id.$extraWhere." ";
        $query = $this->db->query($qS_Paciente);
        $rowPaciente = $query->row();
        $informe = '<button class="informe" disabled onClick="nuevoInforme();">Agregar</button>';
        if($row->informe_id!=NULL){
          $informe = '<button class="informe" disabled onClick="openInforme('.$row->informe_id.');">&nbsp;&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</button>';
        }
        $result[] = array("ID"=> $row->id,
                          "Paciente"=>  $rowPaciente->apellido_p.' '.$rowPaciente->apellido_m.' '.$rowPaciente->nombre,
                          "Monto Total(Bs)"=> $row->total,
                          "Monto Cancelado(Bs)"=>$row->saldo_actual,
                          "Saldo(Bs)"=>$row->saldo_final,
                          "Estado"=>$row->estado,
                          "Forma de Pago"=>$row->tipo,
                          "FN"=>$rowPaciente->fecha_nac,
                          "CI"=>$rowPaciente->ci,
                          "Informe"=>$informe);
      }
    }
    return $result;
  }

  public function getCuotas($pago_id){
    $query = $this->db->query("SELECT * FROM data_pago WHERE id = ".$pago_id);
    if($query->num_rows() == 1){
      $row = $query->row();
      if($row->tipo=='completo') {
        $queryCuotas = $this->db->query("SELECT * FROM data_pago_cuota WHERE pago_id = ".$row->id);
        $row->cuotas = $query->result_array();
      }
      return $row;
    } else {
      return false;
    }
  }

  public function getCuotasRange($startDate, $endDate){
    $query = $this->db->query("SELECT nombre, apellido_p, apellido_m, fecha, pg.tipo,pc.monto, pc.saldo_anterior, pg.saldo_final, pg.estado, pg.total 
                               FROM data_pago_cuota pc,data_pago pg, paciente p 
                               WHERE pc.pago_id = pg.id AND pg.paciente_id = p.id_paciente AND fecha between '".$startDate."' and '".$endDate."' AND pc.deleted=0 
                               ORDER BY fecha");
    return $query->result_array();
  }

  public function save($data){
    $this->db->insert('data_pago', $data);
  }

  public function update($pg_id,$monto){
    $this->db->where('id',$pg_id);
    $this->db->set('saldo_actual', 'saldo_actual+'.$monto, FALSE);
    $this->db->set('saldo_final', 'saldo_final-'.$monto, FALSE);
    $this->db->update('data_pago');
    $this->db->where('id',$pg_id);
    $this->db->where('saldo_final',0);
    $this->db->set('estado', 'Completo');
    $this->db->update('data_pago');
  }

  public function save_cuota($data,$pago_id){
    $query = $this->db->query("SELECT * FROM data_pago WHERE id = ".$pago_id);
    if($query->num_rows() == 1){
      $row = $query->row();
      $data['saldo_anterior'] = $row->saldo_final;
      $this->db->insert('data_pago_cuota', $data);
    }
  } 
}
?>