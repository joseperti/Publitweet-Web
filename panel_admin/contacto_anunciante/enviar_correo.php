<?php
	$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	$consulta = sprintf("select * from contacto_anunciantes");
	$resultado = $db->query($consulta);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="shortcut icon" type="image/x-icon" href="/icon/favicon.ico">
	<meta charset="utf-8">
</head>
<body>
<center>
<?php
	$mensaje = "<html><head><style>body{width:50%;text-align: justify;}</style></head><body><img src='http://publitweet.esy.es/resources/logos/logo180_61.png'><br>".$_POST['texto']."</body></html>";
	$headers = "From: PubliTweet". "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	while ($row = $resultado->fetch_array()){
		switch ($row['estado']) {
			case '0':
				mail($row['correo'],'PubliTweet: Publicidad en Twitter',$mensaje,$headers);
				break;
			default:
				break;
		}
		echo "<div class='alert alert-";
		switch ($row['estado']) {
			case '0':
				echo 'success';
				break;
			default:
				echo 'danger';
				break;
		}
		echo "'>";
		echo 'Enviado: '.$row['correo'];
		echo "</div>";
	}
	$consulta = sprintf("update contacto_anunciantes set estado = 1");
	$resultado = $db->query($consulta);
?>
</body>
</html>