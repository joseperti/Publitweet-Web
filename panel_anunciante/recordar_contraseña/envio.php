<?php
	session_start();
	if ($_POST['correo']!=""){
		$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
		$cuenta = $_POST['correo'];
		$consulta = sprintf("SELECT * from Anunciante where usuario = '%s'",$cuenta);
		$resultado = $db->query($consulta);
		if ($row = $resultado->fetch_array()){
			// Cabecera que especifica que es un HMTL
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Cabeceras adicionales
			$cabeceras .= 'From: PubliTweet - Contraseña' . "\r\n";
			mail($_POST['correo'],'Recuperación de contraseña - PubliTweet','Su contraseña: <br>'.$row['pass'],$cabeceras);
		}
		header('Location: ../../home/');
	}else{
		header("Location: index.html");
	}
?>