<?php

class Paciente extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form','url'));
    $this->load->library('session');
    $this->load->model('paciente_model');
    $this->load->model('pago_model');
    $this->load->model('informe_model');
  }

  public function index() {
    if($this->session->userdata('logged_in')) {
      $this->load->view('paciente');
    } else {
      redirect('/','refresh');
    }
  }

  public function registrar() {
    $f_nac = explode('-',$this->input->post('fecha_nac'));
    $data_paciente = array();
    $data_paciente['nombre'] = $this->input->post('nombres');
    $data_paciente['apellido_p'] = $this->input->post('apellido_p');
    $data_paciente['apellido_m']=$this->input->post('apellido_m');
    $data_paciente['direccion']=$this->input->post('direccion');
    $data_paciente['ci']=$this->input->post('ci');
    $data_paciente['fecha_nac']= date('Y-m-d',mktime(0,0,0,$f_nac[1],$f_nac[0],$f_nac[2]));
    $data_paciente['sexo']=$this->input->post('sexo');
    $data_paciente['celular']=$this->input->post('celular');
    $data_paciente['telefono']=$this->input->post('telefono');
    $this->paciente_model->save($data_paciente);
    redirect('/paciente','refresh');
  }

  public function registrar_pago() {
    $data_pago = array();
    $data_pago['paciente_id'] = $this->input->post('id');
    $data_pago['tipo']=$this->input->post('tipo');
    $data_pago['total']=$this->input->post('total');
    $data_pago['saldo_actual']=0;
    $data_pago['saldo_final']=$this->input->post('total');
    $data_pago['user_id']=0;
    $pago_cuota['creation_date']=date('Y-m-d H:i:s');
    $data_pago['estado']='Pendiente';
    $this->pago_model->save($data_pago);
  }

  public function registrar_cuota() {
    $pago_cuota = array();
    $pago_cuota['pago_id'] = $this->input->post('pg_id');
    $pago_cuota['monto']=$this->input->post('total');
    $pago_cuota['fecha']=date('Y-m-d H:i:s');
    $pago_cuota['user_id']=0;
    $this->pago_model->save_cuota($pago_cuota,$this->input->post('pg_id'));
    $this->pago_model->update($pago_cuota['pago_id'],$pago_cuota['monto']);
  }

  public function get_pacientes() {
    $start = $_POST['start'];
    $draw = $_POST['draw'];
    $len = $_POST['length'];
    $search = $_POST['search'];
    $total=0;
    $results = array();
    $total   = $this->paciente_model->getPacientesTotal($search['value']);
    $results = $this->paciente_model->getPacientes($start,$len,$search['value']);
    echo json_encode(
      array('draw' => $draw,
            'recordsTotal'=> $total,
            'recordsFiltered'=> $total,
            'data'=> $results)
    );
  }

  public function registrar_informe() {
    $$data_informe = array();
    $data_informe['pago_id'] = $this->input->post('pg_id');
    $data_informe['medico_id'] = $this->input->post('medico_id');
    $data_informe['fecha'] = date('Y-m-d H:i:s', strtotime('-4 hours', time()));
    $data_informe['origen']=$this->input->post('clinica');
    $data_informe['referencia']=$this->input->post('enviado');
    $data_informe['analisis']=$this->input->post('org_tej');
    $data_informe['desc_1']=$this->input->post('desc_1');
    $data_informe['desc_2']=$this->input->post('desc_1');
    $data_informe['deleted']=0;
    if($this->session->userdata('logged_in')){
      $data_session = $this->session->userdata('logged_in');
      $data_informe['usuario_id']=$data_session['id'];
    } else {
      $data_informe['usuario_id']=0;
    }
    $this->informe_model->save($data_informe);
    redirect('/cuotas');
  }
}
?>