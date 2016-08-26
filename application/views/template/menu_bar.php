<div id="wrapper" style="width:800px; margin:0 auto;">
  <a href="/home" class="active"><span>Inicio</span></a>
<?php if($this->session->userdata('logged_in')) { ?>
  <a href="/paciente">Registrar Paciente</a>
  <a href="/pago">Nuevo Tratamiento</a>
  <a href="/cuotas">Registrar pago</a>
  <a href="/reporte">Reportes</a>
  <a href="/logout">Logout</a>
<?php } ?>  
</div>