<?php $siteUrl = preg_replace('/([^:])(\/{2,})/', '$1/',(base_url().'/')); ?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/styles.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/switchery.min.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/bootstrap.min.css">
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/switchery.min.js"></script>
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/jquery.dataTables.js"></script>
  <script src="<?php echo $siteUrl;?>template/js/bootstrap.min.js"></script>
<style type="text/css">
label.etiqueta{
  width: 110px !important;
}
</style>
</head>

<body>
<?php $this->load->view('template/menu_bar');?>
  <div id="wrapper" style="width:800px; margin:0 auto;">
    <table id="tbl_pacientes" class="display" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Apellidos</th>
          <th>Nombres</th>
        </tr>
      </thead>
    </table>
  </div>
  <div id="wrapper" style="width:800px; margin:0 auto;">
    <button type="button" class="btn btn-info btn-lg" onclick="openNuevo();">Nuevo Tratamiento</button>
  </div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registrar Nuevo Tratamiento</h4>
      </div>
      <div class="modal-body">
        <label class="etiqueta">Nombre:</label>
        <span id="paciente"></span>
        </br>
        <label class="etiqueta">Forma de Pago:</label>
        <select id="tipo_pago" name="tipo_pago" style="height: 28px;">
          <option value="Contado">Al Contado</option>
          <option value="Cuotas">Cuotas</option>
        </select>
        </br>
        <label class="etiqueta">Costo Total:</label>
        <input id="total" name="total" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="guardarPago();">Guardar</button>
        <button type="button" class="btn btn-default" onclick="cerrarPago();">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
var c_id = 0;
var c_paciente = '';
$(document).ready(function() {
  jQuery('#tbl_pacientes').dataTable( {
    "ordering": false,
    "pageLength": 10,
    "serverSide": true,
    "search": "none",
    "bLengthChange": false,
    "ajax": {
      "url": "<?php echo $siteUrl;?>paciente/get_pacientes",
      "type": "POST",
      "data": {}
    },
    "columns": [
      { "data": "ID","bVisible": false },
      { "data": "Apellidos" },
      { "data": "Nombres" },
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
  });
  var table = jQuery('#tbl_pacientes').DataTable();
  $('#tbl_pacientes tbody').on( 'click', 'tr', function () {
    if ( $(this).hasClass('selected') ) {
      $(this).removeClass('selected');
    }
    else {
      table.$('tr.selected').removeClass('selected');
      $(this).addClass('selected');
    }
  });
});
function openNuevo(){
  var table = jQuery('#tbl_pacientes').DataTable();
  for (var i = 0; i < table.rows('.selected').data().length; i++) { 
    c_id = table.rows('.selected').data()[i].ID;
    c_paciente = table.rows('.selected').data()[i].Apellidos+' '+table.rows('.selected').data()[i].Nombres
  }
  if(c_id!=0){
    $('#paciente').text(c_paciente);
    $('#myModal').modal('show');
  }
  else
    alert('Seleccione un Paciente');
}
function guardarPago(){
  if(c_id!=0){
    if($('#total').val()>0){
      $.ajax({
        'url' : '<?php echo $siteUrl;?>paciente/registrar_pago',
        'type' : 'POST', 
        'data' : {'id':c_id,'total':$('#total').val(),'tipo':$('#tipo_pago').val()},
        'success' : function(data){ 
        $('#myModal').modal('hide');
        window.location= '<?php echo $siteUrl;?>cuotas';
        }
      });
    }
  } else {
    c_id = 0;
    c_paciente='';
    var table = jQuery('#tbl_pacientes').DataTable();
    table.$('tr.selected').removeClass('selected');
    $('#myModal').modal('hide');
  }
}
function cerrarPago(){
  c_id = 0;
  c_paciente='';
  var table = jQuery('#tbl_pacientes').DataTable();
  table.$('tr.selected').removeClass('selected');
  $('#myModal').modal('hide');
}
</script>
</body>
</html>