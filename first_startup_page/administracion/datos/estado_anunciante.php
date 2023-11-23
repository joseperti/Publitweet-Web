<?php
	
	session_start();
	$pass = $_SESSION['pass'];
	if ($pass=="password"){
		$estado = $_POST['estado'];
		$id = $_POST['id'];
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001') or die($db->error);
		$consulta = sprintf("UPDATE Empresa SET Estado = %s WHERE CIF = '%s'",$estado,$id);
		$db->query($consulta) or die($db->error);
		$db->close();
	}else{
		echo "error";
	}

?>