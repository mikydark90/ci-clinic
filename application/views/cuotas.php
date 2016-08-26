<?php $siteUrl = preg_replace('/([^:])(\/{2,})/', '$1/',(base_url().'/')); ?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Lista de Tratamientos</title>
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/styles.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/switchery.min.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/bootstrap.min.css">
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/switchery.min.js"></script>
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/jquery.dataTables.js"></script>
  <script src="<?php echo $siteUrl;?>template/js/bootstrap.min.js"></script>
</head>

<body>
<?php $this->load->view('template/menu_bar');?>
  <div id="wrapper" style="width:800px; margin:0 auto;">
  <table id="tbl_pagos" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Paciente</th>
        <th>Monto Total(Bs)</th>
        <th>Monto Cancelado(Bs)</th>
        <th>Saldo</th>
        <th>Estado</th>
        <th>Forma de Pago</th>
        <th>FN</th>
        <th>CI</th>
        <th>Informe</th>
      </tr>
    </thead>
  </table>
  <button type="button" class="btn btn-info btn-lg" onclick="openPago();">Registrar Pago</button>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registrar Pago</h4>
      </div>
      <div class="modal-body">
        <label>Nombre&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <span id="paciente"></span>
        </br>
        <label class="etiqueta">Forma de Pago:</label>
        <span id="tipo"></span>
        </br>
        <label class="etiqueta">Monto Total:</label>
        <span id="monto_total" name="monto_total"></span>
        </br>
        <label class="etiqueta">Monto:</label>
        <input id="total" name="total" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="guardarPago();">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <?php $attributes = array('id' => 'informe_form', 'name' => 'informe_form');
      echo form_open('paciente/registrar_informe', $attributes); ?> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Informe Histopatologico</h4>
      </div>
      <div class="modal-body">
        <label>Nombre&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <span id="paciente1"></span>
        </br>
        <div>
          <div style="width:50%;float: left;">
            <label class="etiqueta">Fecha de Nac:</label>
            <span id="fecha1"></span>
          </div>
          <div style="width:50%;float: right;">
            <label class="etiqueta">CI:</label>
            <span id="ci" name="ci"></span>
          </div>
        </div>
        </br>
        <label class="etiqueta">Enviado Por Dr(a):</label>
        <input id="enviado" name="enviado" />
        </br>
        <label class="etiqueta">Clinica u Hospital:</label>
        <input id="clinica" name="clinica" />
        </br>
        <label class="etiqueta">Organo / Tejido:&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input id="org_tej" name="org_tej" />
        </br>
        <textarea id="desc_1" name ="desc_1" rows="5" style="width:100%;"> </textarea>
        </br>
        <textarea id="desc_2" name ="desc_2" rows="5" style="width:100%;"> </textarea>
        <div>
          <p style="text-align:center">
              <select id="medico_id" name="medico_id">
                <option value="0">Seleccione un Doctor</option>
                <?php foreach ($medicos as $medico) {
                  echo '<option value="'.$medico['id'].'">DR. '.strtoupper($medico['nombres'].' '.$medico['apellidos']).'</option>';
                } ?>
              </select>
          </p>
          <p style="text-align:center"><label class="etiqueta">Fecha:</label> <?php echo date('d-m-Y',strtotime('-4 hours', time()));?></p>
          <p style="text-align:center"></p>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="pg_id" name="pg_id" >
        <button type="button" class="btn btn-default" onClick="guardarInforme();">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <?php echo form_close(); ?>
    </div>

  </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Informe Histopatologico</h4>
      </div>
      <div class="modal-body">
        <label>Nombre:&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <span id="i_paciente1"></span>
        </br>
        <div>
          <div style="width:50%;float: left;">
            <label class="etiqueta">Fecha de Nac:</label>
            <span id="i_fecha1"></span>
          </div>
          <div style="width:50%;float: right;">
            <label class="etiqueta" >CI:</label>
            <span id="i_ci"></span>
          </div>
        </div>
        </br>
        <label class="etiqueta">Enviado Por Dr(a):</label>
        <span id="i_enviado"></span>
        </br>
        <label class="etiqueta">Clinica u Hospital:</label>
        <span id="i_clinica"></span>
        </br>
        <label class="etiqueta">Organo / Tejido:&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <span id="i_org_tej"></span>
        </br>
        <textarea id="i_desc_1" rows="5" style="width:100%;" disabled> </textarea>
        </br>
        <textarea id="i_desc_2" rows="5" style="width:100%;" disabled> </textarea>
        <div>
          <p style="text-align:center">
            <label class="etiqueta">Dr(a): </label><span id="i_medico"></span>
          </p>
          <p style="text-align:center"><label class="etiqueta">Fecha:</label><span id="i_fecha"></span></p>
          <p style="text-align:center"></p>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="informe_id" name="informe_id" >
        <button type="button" class="btn btn-default" onClick="imprimirInforme();">Imprimir</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
var c_id = 0;
var c_paciente = '';
var c_costo_total = 0;
var c_costo_actual = 0;
var c_saldo_actual = 0;
var c_forma = '';
$(document).ready(function() {
  jQuery('#tbl_pagos').dataTable( {
    "ordering": false,
    "pageLength": 10,
    "serverSide": true,
    "search": "none",
    "bLengthChange": false,
    "ajax": {
      "url": "<?php echo $siteUrl;?>pago/get_pagos",
      "type": "POST",
      "data": {}
    },
    "columns": [
      { "data": "ID","bVisible": false },
      { "data": "Paciente" },
      { "data": "Monto Total(Bs)" },
      { "data": "Monto Cancelado(Bs)" },
      { "data": "Saldo(Bs)" },
      { "data": "Estado" },
      { "data": "Forma de Pago" },
      { "data": "FN","bVisible": false },
      { "data": "CI","bVisible": false },
      { "data": "Informe" },
    ],
    "language": {
      "search": "Buscar Paciente:",
      "paginate": {
        "first":      "Primero",
        "last":       "Ultimo",
        "next":       "Siguiente",
        "previous":   "Anterior"
      } 
    }     
  } );
  var table = jQuery('#tbl_pagos').DataTable();
  $('#tbl_pagos tbody').on( 'click', 'tr', function () {
    if ( $(this).hasClass('selected') ) {
      $(this).removeClass('selected');
      $(this).find('.informe').prop('disabled', true);
    } else {
      table.$('tr.selected').find('.informe').prop('disabled', true);
      table.$('tr.selected').removeClass('selected');
      $(this).addClass('selected');
      $(this).find('.informe').prop('disabled', false);
    }
  });
});
function openPago(){
  var table = jQuery('#tbl_pagos').DataTable();
  for (var i = 0; i < table.rows('.selected').data().length; i++) { 
    c_id = table.rows('.selected').data()[i].ID;
    c_paciente = table.rows('.selected').data()[i].Paciente;
    c_forma = table.rows('.selected').data()[i]['Forma de Pago'];
    if(c_forma=='Contado'){
      c_costo_actual = table.rows('.selected').data()[i]['Monto Total(Bs)'];
    }
    c_costo_total = table.rows('.selected').data()[i]['Monto Total(Bs)'];
    c_saldo_actual = table.rows('.selected').data()[i]['Monto Cancelado(Bs)'];
  }
  if(c_id!=0){
    $('#paciente').text(c_paciente);
    $('#tipo').text(c_forma);
    $('#monto_total').text(c_costo_total+'(Bs)');
    $('#total').val(c_costo_actual);
    $('#myModal').modal('show');
  }
  else
    alert('Seleccione un Paciente');
}
function guardarPago(){
  if(c_id!=0){
    if($.isNumeric($('#total').val())){
      if((c_saldo_actual*1)+$('#total').val()*1<=c_costo_total*1){
        $.ajax({
          'url' : '<?php echo $siteUrl;?>paciente/registrar_cuota',
          'type' : 'POST', 
          'datatype': 'json',
          'data' : {'pg_id':c_id,'total':$('#total').val(),'tipo':$('#tipo_pago').text()},
          'success' : function(data){ 
          $('#myModal').modal('hide');
          window.location= '<?php echo $siteUrl;?>cuotas';
          }
        });
      } else {
        alert('Ingrese un Valor menor al saldo ' +(c_saldo_actual*1)+$('#total').val()*1 );
      }
    } else {
      alert('Ingrese un Valor');
    }
  } else {
    c_id = 0;
    c_paciente='';
    var table = jQuery('#tbl_pacientes').DataTable();
    table.$('tr.selected').removeClass('selected');
    $('#myModal').modal('hide');
  }
}
function openInforme(id){
  $.ajax({
    'url' : '<?php echo $siteUrl;?>pago/get_informe',
    'type' : 'POST', 
    'dataType': 'json',
    'data' : {'i_id':id},
    'success' : function(response){
      $('#i_paciente1').text(response.full_name);
      $('#i_fecha1').text(response.fecha_nac);
      $('#i_ci').text(response.ci);
      $('#i_enviado').text(response.referencia);
      $('#i_clinica').text(response.origen);
      $('#i_org_tej').text(response.analisis);
      $('#i_desc_1').val(response.desc_1);
      $('#i_desc_2').val(response.desc_2);
      $('#i_medico').text(response.medico);
      $('#i_fecha').text(response.fecha);
      $('#informe_id').val(id);
      $('#myModal2').modal('show');
    }
  });
}
function nuevoInforme(){
  var table = jQuery('#tbl_pagos').DataTable();
  var c_fn = '';
  var c_ci = '-';
  for (var i = 0; i < table.rows('.selected').data().length; i++) { 
    c_id = table.rows('.selected').data()[i].ID;
    c_paciente = table.rows('.selected').data()[i].Paciente;
    c_fn = table.rows('.selected').data()[i].FN;
    c_ci = table.rows('.selected').data()[i].CI;
  }
  if(c_id!=0){
    $('#paciente1').text(c_paciente);
    $('#pg_id').val(c_id);
    $('#fecha1').text(c_fn);
    $('#ci').text(c_ci);
    $('#myModal1').modal('show');
  }
  else
    alert('Seleccione un Paciente');
}
function guardarInforme(){
  if($('#pg_id').val()!=0){
    $('#informe_form').submit();
  } else {
    alert('Seleccione un Paciente')
    $('#pg_id').val(0);
  }
}
function imprimirInforme(){
  if($('#informe_id').val()!='')
    window.open('/imprimir/'+$('#informe_id').val());
}
</script>
</body>
</html>
