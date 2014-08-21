<?php 
	session_start();
	$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	$consulta = sprintf("insert into Anunciante(fecha_registro,usuario,pass,
		nombre, persona_contacto,correo_contacto,telefono_contacto,descripcion) values('%s','%s','%s','%s','%s','%s','%s','%s')",date("Y-m-d H:i:s"),
	$_POST['correo'],$_POST['password'],$_POST['nombre'],$_POST['persona_contacto'],$_POST['correo'],$_POST['telefono_contacto'],$_POST['descripcion']);
	$respuesta = $db->query($consulta) or die($db->error);
	$consulta = "SELECT * FROM Anunciante Order by id desc";
	$resultado = $db->query($consulta) or die($db->error);
	$row = $resultado->fetch_array();
	move_uploaded_file($_FILES['file']["tmp_name"],"../../../img_empresa/".$row['id'].".png");
	mail($_POST['correo'],'Registro en PubliTweet',"PubliTweet\nGracias por unirte a PubliTweet","From: PubliTweet");
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="../../../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<title>Completando Registro</title>
	<script type="text/javascript">
		setTimeout(function(){
			location.href = "../../login/";
		},3000);
	</script>
</head>
<body>
<center>
	<div class="alert alert-info">
		<h1>Bienvenido a PubliTweet</h1>
	Redireccionando a su panel de usuario en unos 3 seg. ...
	</div>
</center>
</body>
</html>