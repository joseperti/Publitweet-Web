<?php

	session_start();
	$pass = $_SESSION['pass'];
	if ($pass == 'password'){
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		$consulta = "SELECT * FROM anuncio";
		$respuesta = $db->query($consulta);
		echo '<br>Número de anuncios: '.$respuesta->num_rows.'<br>';
		echo '<br><b>Anuncios pendientes de pago: </b><br>';
		$consulta = "SELECT * FROM anuncio WHERE Estado = 0 order by id DESC";
		$respuesta = $db->query($consulta) or die("Error en bdd");
		while ($row = $respuesta->fetch_array()){
			echo '<br>';
			if ($row['Tipo']=="2"){
				echo "<a href='../anuncios/".$row['Imagen']."' target='_blank'><img height='50' width='50' src='../anuncios/".$row['Imagen']."'></img><a>";
			}
			echo '<button onclick="usuarios_de_anuncio(this)" value="'.$row['id'].'">Id: '.$row['id'].'</button> - Fecha: '.$row['FechaCreacion'].' - Texto: '.$row['Texto'].'
			 <button value="'.$row['id'].'" onclick="activar_anuncio(this)">Activar</button>
			<button value="'.$row['id'].'" onclick="eliminar_anuncio(this)">Eliminar</button>';
		}
		echo '<br><br><b>Anuncios en publicación: </b><br>';
		$consulta = "SELECT * FROM anuncio WHERE Estado = 1 order by id DESC";
		$respuesta = $db->query($consulta) or die("Error en bdd");
		while ($row = $respuesta->fetch_array()){
			echo '<br>';
			if ($row['Tipo']=="2"){
				echo "<a href='../anuncios/".$row['Imagen']."' target='_blank'><img height='50' width='50' src='../anuncios/".$row['Imagen']."'></img></a>";
			}
			echo '<button onclick="usuarios_de_anuncio(this)" value="'.$row['id'].'">Id: '.$row['id'].'</button> - Fecha: '.$row['FechaCreacion'].' - Texto: '.$row['Texto'].'
			 <button value="'.$row['id'].'" onclick="activar_anuncio(this)">Activar</button>
			<button value="'.$row['id'].'" onclick="eliminar_anuncio(this)">Eliminar</button>';
		}
		echo '<br><br><b>Anuncios eliminados: </b><br>';
		$consulta = "SELECT * FROM anuncio WHERE Estado = 3 order by id DESC";
		$respuesta = $db->query($consulta) or die("Error en bdd");
		while ($row = $respuesta->fetch_array()){
			echo '<br>';
			if ($row['Tipo']=="2"){
				echo "<a href='../anuncios/".$row['Imagen']."' target='_blank'><img height='50' width='50' src='../anuncios/".$row['Imagen']."'></img></a>";
			}
			echo 'Id: '.$row['id'].' - Fecha: '.$row['FechaCreacion'].' - Texto: '.$row['Texto'];
		}

		$db->close();
	}else{
		die("Error");
	}

?>