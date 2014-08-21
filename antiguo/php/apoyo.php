<?php 
	$db= new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	$contacto = $_POST['contacto'];
	if ($contacto!=""){
		$consulta = sprintf("insert into Seguidor(contacto) values ('%s')",mysql_escape_string($contacto));
		$resultado = $db->query($consulta);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Apoyo PubliTweet</title>
	<script type="text/javascript" src="../script/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script type="text/javascript">
	setTimeout(function(){
		location.href = "../";
	},3000);
	</script>
</head>
<body>
	<CENTER>
	<?php 
		if ($contacto!=""){
			echo "<div class='alert alert-success'>Gracias por tu apoyo.<br>Cuando estemos listos nos pondremos en contacto contigo.<br>Redireccionando</div>";
		}else{
			echo "<div class='alert alert-danger'>Contacto no válido</div>";
		}
	?>
</body>
</html>