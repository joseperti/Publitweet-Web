<?php
	session_start();
	$id = $_POST['id'];
	$pass = $_SESSION['pass'];
	if ($pass=="password"){
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		$consulta = sprintf("UPDATE anuncio SET Estado = 3 WHERE id =%s ",$id);
		$db->query($consulta) or die($db->error);
		$consulta = sprintf("DELETE FROM usuarioanuncio WHERE idanuncio =%s ",$id);
		$db->query($consulta) or die($db->error);
		$db->close();
	}else{
		die("Error");
	}

?>