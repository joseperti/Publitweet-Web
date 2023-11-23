<?php

	session_start();
	$idanuncio = $_POST['id']; 
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = sprintf("SELECT * FROM anuncio WHERE personas =%s and id =%s",$_SESSION['id'],$idanuncio);
	$respuesta = $db->query($consulta);
	while ($row = $respuesta->fetch_array()){
		echo "<br><button onclick='publicacacion(this)' value='".$row['id']."'>".$row['Texto']."</button>";
	}
	if ($respuesta->num_rows == 0 ){
		echo "Error en los datos del anuncio";
	}

?>