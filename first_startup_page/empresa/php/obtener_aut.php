<?php
	$followers = $_GET['followers'];
	if (is_float($followers) || is_int($followers)){
		die("Introduzca un valor correcto: ".$coste);
	}
	$followers_totales = intval($followers);
	$categoria = $_GET['Categoria'];
	$provincia = $_GET['provincia'];
	$followers = 0;
	$usuarios = "";

	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = sprintf("SELECT * FROM datosusuario D,categoriasusuario C WHERE (D.idTwitter = C.idTwitter) and (C.idCategoria = %s) and (D.Provincia='%s') 
		ORDER BY UltimoRecibido ASC",$categoria,$provincia);
	$respuesta = $db->query($consulta) or die($db->error);
	while ($row = $respuesta->fetch_array()){
		if ($followers_totales>=($followers+intval($row['Followers']))){
				$followers += intval($row['Followers']);
			if ($usuarios == ""){
				$usuarios = $usuarios.$row['idTwitter'];
			}else{
				$usuarios = $usuarios."-".$row['idTwitter'];
			}
		}
	}
	echo $usuarios;
?>