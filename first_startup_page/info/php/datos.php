<?php

	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001') or die("Error en el acceso a BBDD");
	$consulta = "SELECT * FROM Empresa";
	$respuesta = $db->query($consulta);
	echo "<CENTER>";
	echo "<br>Número de empresas: ".$respuesta->num_rows;
	$consulta = "SELECT idTwitter,SUM(Followers) FROM datosusuario";
	$respuesta = $db->query($consulta);
	echo "<br>Número de usuarios: ".$respuesta->num_rows;
	$row = $respuesta->fetch_array();
	echo "<br> Número total de followers: ".$row['SUM(Followers'];

?>