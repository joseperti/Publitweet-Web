<?php
	session_start();
	$categorias = array();
	$total = 0;
	$id=$_SESSION['id'];
	$consulta = "SELECT * FROM categoriasusuario WHERE idTwitter =".$id;
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$resultado = $db->query($consulta);
	while ($row = $resultado->fetch_row()){
		$categorias[$total] = $row[1];
		$total++;
	}
	echo json_encode($categorias);
?>