<?php
	session_start();
	$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	$consulta = sprintf("SELECT * FROM Anunciante where usuario = '%s'",mysql_escape_string($_POST['user']));
	$respuesta = $db->query($consulta);
	if (($respuesta->num_rows)!=0){
		$error = false;
		$row = $respuesta->fetch_array();
		if ($row['pass'] == $_POST['pass']){
			$error = false;
			$_SESSION['nombre_empresa'] = $row['nombre'];
			$_SESSION['id'] = $row['id'];
		}else{
			$error = true;
		}
	}else{
		$error = true;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Accediendo</title>
	<link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../../script/jquery.js"></script>
    <script src="../../script/bootstrap.js"></script>
    <meta charset="utf-8">
    <script type="text/javascript">
    setTimeout(function(){
    	location.href = <?php 
    	if (!$error){
    		echo "'../'";
    	}else{
    		echo "'../login/'";
    	}
     ?>;},3000);
    </script>
</head>
<body>
	<?php 
		if (!$error){
			echo '<div class="alert alert-success">
				<center>
				<b>Accediendo a su panel de usuario</b><br>
				Redireccionando...
			</div>';
		}else{
			echo '<div class="alert alert-danger">
				<center>
				<b>Error en el inicio de sesión</b><br>
				Redireccionando...
			</div>';
		}
	?>	
</body>
</html>