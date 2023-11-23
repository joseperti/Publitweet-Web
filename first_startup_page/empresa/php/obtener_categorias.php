<?php
			//Obtener las categorias, conexión a la bbdd
			$usuario = $_GET['name'];
			echo $usuario;
			$conex = new mysqli('localhost', 'unituitc_prueba', 'jose&uni13','unituitc_jose');
			$categorias = $conex->query("SELECT * FROM CATEGORIAS");
			$conex->close();
?>