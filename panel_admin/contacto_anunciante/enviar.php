<?php
	$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	$consulta = sprintf("insert into contacto_anunciantes(nombre,correo) values('%s','%s')",$_POST['name'],$_POST['mail']);
	$resultado = $db->query($consulta);
	header("Location: index.php");
?>