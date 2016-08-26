<?php

class Reporte extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form','url'));
    $this->load->library('session');
    $this->load->model('paciente_model');
    $this->load->model('pago_model');
  }

  public function index() {
    if($this->session->userdata('logged_in')) {
      $firstDayUTS = mktime (0, 0, 0, date("m"), 1, date("Y"));
      $lastDayUTS = mktime (0, 0, 0, date("m"), date('t'), date("Y"));
      $firstDay = date("Y-m-d 0:00:00", $firstDayUTS);
      $lastDay = date("Y-m-d 23:59:59", $lastDayUTS);
      $data['c_month'] = date("m", $firstDayUTS);
      $data['pagos'] = $this->pago_model->getCuotasRange($firstDay,$lastDay);
      $this->load->view('reporte',$data);
    } else {
      redirect('/','refresh');
    }
  }

  public function get_reportes() {
    if($this->session->userdata('logged_in')) {
      $firstDayUTS = mktime (0, 0, 0, $this->input->post('m'), 1, $this->input->post('y'));
      $lastDayUTS = mktime (0, 0, 0, $this->input->post('m'), date('t'), $this->input->post('y'));
      $firstDay = date("Y-m-d 0:00:00", $firstDayUTS);
      $lastDay = date("Y-m-d 23:59:59", $lastDayUTS);
      $results = $this->pago_model->getCuotasRange($firstDay,$lastDay);
      $monto_cobrado = 0;
      $pagos = '';
      foreach ($results as $key => $value) {
        $c_class = '';
        if($value['estado']=='Completo')
          $c_class = 'class="success"';
        $pagos .=  '<tr '.$c_class.'role="row">
                      <td>'.ucwords($value['apellido_p'].' '.$value['apellido_m'].' '.$value['nombre']).'</td>
                      <td>'.$value['total'].'</td>
                      <td>'.$value['tipo'].'</td>
                      <td>'.date("d-m-Y", strtotime($value['fecha'])).'</td>
                      <td>'.$value['saldo_anterior'].'</td>
                      <td>'.$value['monto'].'</td>
                      <td>'.$value['saldo_final'].'</td>
                      <td>'.$value['estado'].'</td>
                    </tr>';
        $monto_cobrado = $monto_cobrado+$value['monto'];
      }
      $total = '<tr><td></td><td></td><td></td><td colspan="2" style="text-align:right;">Total:</td><td>'.$monto_cobrado.'</td><td></td><td></td></tr>';
      echo json_encode(
        array('pagos' => $pagos,
              'total'=> $total)
      );
    } else {

    }
  }
}
?>