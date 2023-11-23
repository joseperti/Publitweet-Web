<?php
	session_start();
	$categorias = $_POST['categorias'];
	$id = $_SESSION['id'];
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001') or die("Error en el acceso a BBDD");
	$db->query("DELETE FROM categoriasusuario WHERE idTwitter=".$id) or die("Error en el borrado");
	foreach ($categorias as $cat){
		if ($cat!=null){
			$db->query("INSERT INTO categoriasusuario VALUES (".$id.",".$cat.",0)") or die("Error en las categorias");
		}
	}
	echo "Guardado";

?>