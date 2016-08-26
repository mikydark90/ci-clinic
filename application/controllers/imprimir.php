<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Imprimir extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form','url'));
    $this->load->model('informe_model');
  }

  public function index($informe_id) {
    $this->load->library('m_pdf'); 
    $data['informe'] = $this->informe_model->getInforme($informe_id);
    //load the view and saved it into $html variable
    $html=$this->load->view('informe', $data, true);

    //this the the PDF filename that user will get to download
    $pdfFilePath = "output_pdf_name.pdf";

    $param = '"en-GB-x","A4","","",10,10,10,10,6,3';
    $pdfer = new mPDF($param);

    $pdfer->WriteHTML($html);

    $pdfer->output($pdfFilePath, "D");
  }
}