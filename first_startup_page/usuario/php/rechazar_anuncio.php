<?php
	session_start();
	$idanuncio = $_POST['idanuncio'];
	$idusuario = $_SESSION['id'];
	$fecha = date("Y-m-d H:i:s");
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = sprintf("UPDATE usuarioanuncio SET Estado=8,fecha='%s' WHERE idTwitter=%s and idanuncio=%s",$fecha,$idusuario,$idanuncio);
	$db->query($consulta) or die("Error: ".$db->error);
	$consulta = sprintf("UPDATE gananciausuario SET Rechazos = Rechazos + 1 WHERE idTwitter = %s",$idusuario);
	$db->query($consulta) or die("Error: ".$db->error);
	echo "Realizado";
?>