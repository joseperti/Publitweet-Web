<?php
	function actualizar_monedero(){
		session_start();
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		$id = $_SESSION['id'];
		$consulta = "SELECT * FROM empresaganancias WHERE id=".$_SESSION['id'];
		$respuesta = $db->query($consulta) or die($db->error);
		if ($row = $respuesta->fetch_array()){
			$_SESSION['acumulado'] = $row['acumulado'];
			$_SESSION['mes'] = $row['mes'];
			$_SESSION['estado'] = $row['estado'];
			$_SESSION['fechaCreacion'] = $row['fechaCreacion'];
		}
	}
?>