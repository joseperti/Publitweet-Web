<?php
	
	session_start();
	$pass = $_SESSION['pass'];
	if ($pass=="password"){
		$estado = $_POST['estado'];
		$id = $_POST['id'];
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001') or die($db->error);
		$consulta = sprintf("UPDATE Usuarios SET estado = %s WHERE idTwitter = %s",$estado,$id);
		$db->query($consulta);
		$db->close();
	}else{
		echo "error";
	}

?>