<?php
	
	session_start();
	$pass = $_SESSION['pass'];
	if ($pass == 'password'){
		$id_anuncio = $_POST['id_anuncio'];
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		$consulta = sprintf("SELECT * FROM usuarioanuncio WHERE idanuncio='%s'",$id_anuncio);
		$respuesta = $db->query($consulta);
		while ($usuario = $respuesta->fetch_array()){
			$consulta = sprintf("SELECT * FROM datosusuario WHERE idTwitter='%s'",$usuario['idTwitter']);
			$datosusuario = $db->query($consulta);
			$row = $datosusuario->fetch_array();
			echo '<br>Nombre: '.$row['Nombre'].' - Twitter: <a href="https://twitter.com/'.$row['screen_name'].'" target="_blank">'.$row['screen_name'].' </a>
			- Fecha: '.$row['FechaAlta'].' - Ult.Acceso: '.$row['UltimoAcceso'].'
			 - Followers: '.$row['Followers'];
		}

	}else{
		die("Error en la autentificación");
	}

?>