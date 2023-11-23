<?php
	function actualizar_monedero(){
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		$id = $_SESSION['id'];
		$consulta = "SELECT * FROM gananciausuario WHERE idTwitter=".$_SESSION['id'];
		$respuesta = $db->query($consulta) or die($db->error);
		if ($row = $respuesta->fetch_array()){
			$_SESSION['acumulado'] = $row['acumulado'];
			$_SESSION['mes'] = $row['mes'];
			$_SESSION['estado'] = $row['estado'];
			$_SESSION['fechaCreacion'] = $row['fechaCreacion'];
			$_SESSION['strikes'] = $row['Strikes'];
			$_SESSION['rechazos'] = $row['Rechazos'];
		}
	}
?>