<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
</head>
<body BGCOLOR="#FFFFF" style="text-align:center">
<CENTER>
  <div align="center"><img src="angeles.jpg" width="606" height="82" alt="Tamaño original" border="3"></div>
  <div align="center"> <h2> Informe Histopatologico </h2>	</div>
<TABLE style="width:100%;">

<TR>
   <TD>Nombre:</TD>
   <TD> <INPUT TYPE="text" NAME="nombre" SIZE=20 MAXLENGTH=20 value="<?php echo $informe->full_name;?>" > F.Nac.:
        <INPUT TYPE="text" NAME="edad" SIZE=10 MAXLENGTH=8> CI: 
        <INPUT TYPE="text" NAME="dni" SIZE=10 MAXLENGTH=8></TD>

<TR>
   <TD>Enviado por Dr(a):</TD>
   <TD> <INPUT TYPE="text" NAME="apellidos" SIZE=61 MAXLENGTH=48></TD>
<TR>
   <TD>Clinica u Hospital:</TD>
   <TD> <INPUT TYPE="text" NAME="domicilio" SIZE=28 MAXLENGTH=48>Organo/Tejido:
   <INPUT TYPE="text" NAME="dni" SIZE=14 MAXLENGTH=8> </TD>

</TABLE>

		<TEXTAREA NAME="texto1" ROWS=13 COLS=82 ><?php echo $informe->desc_1;?></TEXTAREA>
		<P>
		
	</FORM>
	<FORM >
		<TEXTAREA NAME="texto1" ROWS=13 COLS=82 ></TEXTAREA>
		<P>
		
	</FORM align="center">
	
	<div align="center"> <h3> Dr. User </h3>	</div>
	<div align="center"> <h4> Fecha Informe </h4>	</div>
	<div align="center"> <h3> Nombre Hospital </h3>	</div>
</CENTER>
</body>
</html>