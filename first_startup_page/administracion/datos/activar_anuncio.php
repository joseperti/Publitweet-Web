<?php
	session_start();
	$id = $_POST['id'];
	$pass = $_SESSION['pass'];
	if ($pass=="password"){
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		$consulta = sprintf("UPDATE anuncio SET Estado = 1 WHERE id =%s ",$id);
		$db->query($consulta) or die($db->error);
		$consulta = sprintf("UPDATE usuarioanuncio SET Estado = 0 WHERE idanuncio = %s ",$id);
		$db->query($consulta) or die($db->error);
		//Actualizamos UltimoRecibido
		$consulta = sprintf("SELECT * FROM usuarioanuncio WHERE idanuncio = %s",$id);
		$respuesta = $db->query($consulta) or die($db->error);
		$db->close();
	}else{
		die("Error");
	}
?>
