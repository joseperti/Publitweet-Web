<?php
	$categoria = $_GET['categoria'];
	$provincia = $_GET['provincia'];
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = sprintf("SELECT COUNT(*),SUM(D.Followers) FROM datosusuario D,categoriasusuario C WHERE (D.idTwitter = C.idTwitter and C.idCategoria = %s)",$categoria);
	$respuesta = $db->query($consulta);
	$respuesta = $respuesta->fetch_array();
	if ($respuesta['COUNT(*)']=="0"){
		echo("<br>No hay usuarios en esta categoría");
	}else{
		echo("<br>Categoría - Usuarios: ".$respuesta['COUNT(*)'] . "-Followers: ".$respuesta['SUM(D.Followers)']);
	}
	$consulta = sprintf("SELECT COUNT(*),SUM(Followers) FROM datosusuario WHERE (Provincia = '%s')",$provincia);
	$respuesta = $db->query($consulta);
	$respuesta = $respuesta->fetch_array() or die($db->error);
	if ($respuesta['COUNT(*)']=="0"){
		echo("<br>No hay usuarios en esta provincia");
	}else{
		echo("<br>Provincia - Usuarios: ".$respuesta['COUNT(*)'] . "-Followers: ".$respuesta['SUM(Followers)']);
	}
	$consulta = sprintf("SELECT COUNT(*),SUM(D.Followers) FROM datosusuario D,categoriasusuario C WHERE (D.idTwitter = C.idTwitter and C.idCategoria = %s and D.Provincia='%s')",$categoria,$provincia);
	$respuesta = $db->query($consulta);
	$respuesta = $respuesta->fetch_array();
	if ($respuesta['COUNT(*)']=="0"){
		echo("<br>No hay usuarios en esta provincia y esta categoría");
	}else{
		echo("<br>En categoría y provincia - <br>Usuarios: ".$respuesta['COUNT(*)'] . "-Followers: ".$respuesta['SUM(D.Followers)']);
	}
?>