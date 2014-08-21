<?php
	session_start();
	$id_anuncio = $_GET['id'];
	if ($id_anuncio==""){
		header("Location: ../");
	}
	$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	$consulta = sprintf("update envio_anuncio set estado = 2 where anuncio = %s and destino = %s",$id_anuncio,$_SESSION['id']);
	$resultado = $db->query($consulta);
	header("Location: ../");
?>