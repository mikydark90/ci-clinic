<?php $siteUrl = preg_replace('/([^:])(\/{2,})/', '$1/',(base_url().'/')); ?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Horizontal Application Form - Template Monster Demo</title>
  <meta name="author" content="Jake Rocheleau">
  <link rel="shortcut icon" href="http://static.tmimgcdn.com/img/favicon.ico">
  <link rel="icon" href="http://static.tmimgcdn.com/img/favicon.ico">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/styles.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/switchery.min.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/jquery.steps.css">
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/jquery.steps.min.js"></script>
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/switchery.min.js"></script>
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/jquery-birthday-picker.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>

<body>
<?php $this->load->view('template/menu_bar');?>
  <div id="wrapper" style="width:800px; margin:0 auto;">
<?php $attributes = array('id' => 'paciente_form', 'name' => 'paciente_form', 'class'=> 'login');
  echo form_open('paciente/registrar', $attributes); ?> 
      <div class="col-4">
              <label>
                Apellido Paterno
                <input placeholder="Apellido Paterno" id="apellido_p" name="apellido_p" tabindex="1">
              </label>
            </div>
            <div class="col-4">
              <label>
                Apellido Materno
                <input placeholder="Apellido Materno" id="apellido_m" name="apellido_m" tabindex="2">
              </label>
            </div>
            <div class="col-2">
              <label>Nombres
              <input placeholder="Nombre Completo" id="nombres" name="nombres" tabindex="3">
              </label>
            </div>
            <div class="col-2">
              <label>
                Direccion
                <input placeholder="Direccion" id="direccion" name="direccion" tabindex="4">
              </label>
            </div>
            <div class="col-4">
              <label>
                C.I.
                <input placeholder="" id="ci" name="ci" tabindex="5">
              </label>
            </div>
            <div class="col-4">
              <label>
                Telefono
                <input placeholder="Telefono" id="telefono" name="telefono" tabindex="6">
              </label>
            </div>
            <div class="col-4">
              <label>
                Celular
                <input placeholder="Celular" id="celular" name="celular" tabindex="7">
              </label>
            </div>
            <div class="col-4">
              <label>
                Sexo
                <select tabindex="8" name="sexo">
                  <option value="M">Masculino</option>
                  <option value="F">Femenino</option>
                </select>
              </label>
            </div>
            <div class="col-2">
              <label>
                Fecha de Nacimiento
                <input type="text" tabindex="9" id="fecha_nac" name="fecha_nac">
              </label>
              
            </div>
            <div class="col-submit">
              <button class="submitbtn">Continuar</button>
            </div>
<?php echo form_close(); ?>
  </div>


  


<script type="text/javascript">
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
$(function() {
  $( "#fecha_nac" ).datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: "-75:+0",
    dateFormat: 'dd-mm-yy'
  });
});



</script>
</body>
</html>