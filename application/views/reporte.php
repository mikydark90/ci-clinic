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
  <div id="wrapper" style="width:900px; margin:0 auto;">
  <label>Mes: </label>
  <select id="mes" name="mes">
    <option value="0">Seleccione Mes</option>
    <option value="1">Enero</option>
    <option value="2">Febrero</option>
    <option value="3">Marzo</option>
    <option value="4">Abril</option>
    <option value="5">Mayo</option>
    <option value="6">Junio</option>
    <option value="7">Julio</option>
    <option value="8">Agosto</option>
    <option value="9">Septiembre</option>
    <option value="10">Octubre</option>
    <option value="11">Noviembre</option>
    <option value="12">Diciembre</option>
  </select>
  <label>Año: </label>
  <select id="year" name="year">
    <option value="2016">Seleccione Año</option>
    <option value="2016">2016</option>
    <option value="2017">2017</option>
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>
  </select>  
  <button type="button" class="btn btn-info btn-lg" onclick="reporte_mes();">Buscar</button>
  <div id="tbl_pagos_wrapper" class="">
  <div id="tbl_pagos_filter" class="dataTables_filter">
  <table id="tbl_pagos" class="display dataTable no-footer" width="100%" style="width: 100%;">
  <thead>
    <tr role="row">
      <th>Paciente</th>
      <th>Costo Total</th>
      <th>Forma de Pago</th>
      <th>Fecha Pago</th>
      <th>Saldo Anterior</th>
      <th>Monto</th>
      <th>Saldo Actual</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
<?php 
  $monto_cobrado = 0;
  /*foreach ($pagos as $key => $value) {
    $c_class = '';
    if($value['estado']=='Completo')
      $c_class = 'class="success"';
    echo '<tr '.$c_class.'role="row">
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
  }*/
?>
  </tbody>
  <tfoot>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td colspan="2" style="text-align:right;">Total:</td>
      <td><?php echo $monto_cobrado;?></td>
      <td></td>
      <td></td>
    </tr>
  </tfoot>
  </table>
  </div>
  </div>
  </div>
<script type="text/javascript">
function reporte_mes(){
  var m_id = $('#mes').val();
  var y_id = $('#year').val();
  if((m_id!=0)&&(y_id!=0)){
    $.ajax({
      'url' : '<?php echo $siteUrl;?>reporte/get_reportes',
      'type' : 'POST', 
      'data' : {'m':m_id,'y':y_id},
      'dataType': 'json',
      'success' : function(result){ 
        $('#tbl_pagos tbody').empty();
        $('#tbl_pagos tbody').append(result.pagos);
        $('#tbl_pagos tfoot').empty();
        $('#tbl_pagos tfoot').append(result.total);
      }
    });
  } else {
    if(m_id==0)
      alert('Elija un mes');
    else
      alert('Elija un Año');
  }
}
</script>
</body>
</html>