<?php
	$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	$consulta = "SELECT * FROM contacto_anunciantes";
	$resultado = $db->query($consulta);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="shortcut icon" type="image/x-icon" href="/icon/favicon.ico">
	<meta charset="utf-8">
	<style type="text/css">
	form{
		width: 50%;
	}
	</style>
</head>
<body>
<center>
<br>
<form method="post" action="enviar.php">
	<input class="form-control" type="text" name="name" placeholder="Nombre">
	<input class="form-control" type="text" name="mail" placeholder="Correo">
	<br>
	<input type="submit" class="btn btn-primary" value="Guardar">
</form>
<br>
<?php
	while ($row=$resultado->fetch_array()){
		echo "<div class='alert alert-";
		switch ($row['estado']) {
			case '0':
				echo 'info';
				break;
			default:
				echo 'success';
				break;
		}
		echo "'>".$row['nombre']."<br>";
		echo $row['correo'];
		echo "</div>";
	}
?>
<br>
<form method="post" action="enviar_correo.php">
	<textarea class="form-control" name="texto">
	<br> Buenas,<br>con tan sólo <b>1€</b> podrás probar la efectividad de la publicidad con PubliTweet. Si quieres más información puedes contactar con nosotros y preguntarnos lo que quieras.<center> <br>contacto@publitweet.esy.es <br> http://publitweet.esy.es/home
	</textarea>
	<input type="submit" class="btn btn-primary" value="Enviar correo">
</form>
</body>
</html>