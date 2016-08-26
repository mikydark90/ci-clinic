<?php $siteUrl = preg_replace('/([^:])(\/{2,})/', '$1/',(base_url().'/')); ?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/styles.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/switchery.min.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $siteUrl;?>template/css/jquery.steps.css">
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/jquery.steps.min.js"></script>
  <script type="text/javascript" src="<?php echo $siteUrl;?>template/js/switchery.min.js"></script>
</head>

<body>
<?php $this->load->view('template/menu_bar');?>
  <div id="wrapper" style="width:800px; margin:0 auto;">
<?php 
if(!$this->session->userdata('logged_in')) {
  $attributes = array('id' => 'form_login', 'name' => 'form_login', 'class' => 'login');
  echo form_open('login',$attributes); ?> 
    <div class="col-2">
      <label>
        Nombre de Usuario
        <input name="username" tabindex="1">
      </label>
    </div>
    <div class="col-2">
    </div>
    <div class="col-2">
      <label>
        Clave de Usuario
        <input type="password" name="password" tabindex="2">
      </label>
    </div>
    <div class="col-2">
    </div>
    <div class="col-2 col-submit">
      <button class="submitbtn">Ingresar</button>
    </div>
    <input type="hidden" name="form_login" value="1">
<?php echo form_close(); 
  } else { ?>

<?php } ?>
  </div>

  


<script type="text/javascript">
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});



</script>
</body>
</html>