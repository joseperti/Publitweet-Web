<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Apoyo PubliTweet</title>
	<script type="text/javascript" src="../script/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script type="text/javascript">
	</script>
</head>
<body>
	<CENTER>
	Contactos añadidos:
	<?php 
		$bd= new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
		echo $bd->connect_error;
	    $sql="Select * from Seguidor";
	    $resultado = $bd->query($sql);
	?>
	<br>
	<?php 
		while($row = $resultado->fetch_array()){
			echo "<br>".$row['id']."-".$row['contacto']."<br>";
		}
	?>
</body>
</html>