<?php
	session_start();
	if (!$_SESSION['connect'] || ($_GET['id']=="")){
		header("Location: ./home");
	}
	$id_usuario = $_GET['id'];
	$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
    $consulta = sprintf("delete from Twittero where id=%s",$id_usuario);
    $resultado = $db->query($consulta) or die($db->error);
    $consulta = sprintf("delete from envio_anuncio where destino=%s",$id_usuario);
    $resultado = $db->query($consulta) or die($db->error);
    header("Location: ../");
?>