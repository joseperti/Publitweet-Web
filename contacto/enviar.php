<?php
	if ($_POST['correo']=="" || $_POST['mensaje']==""){

	}else{
		mail("contacto@publitweet.esy.es", "Mensaje de: ".$_POST['correo'], $_POST['mensaje']);
	}
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Envío de mensaje</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="../../../script/bootstrap.js"></script>
	<script type="text/javascript">
		setTimeout(function(){
			location.href = "../";
		},3000);
	</script>
</head>
<body>
<center>
	<div class="alert alert-success">
		Gracias por tu mensaje.
		<br>
		Redireccionando...
	</div>
</center>
</body>
</html>