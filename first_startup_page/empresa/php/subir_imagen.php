<?php
	session_start();
	$numero_img = $_SESSION['numero_img'];
	$imagen = $_FILES;
	foreach($imagen as $valor){
		$extensiones = array("image/png","image/jpg","image/jpeg");
		//Como condiciones iniciales veremos que el peso del archivo sea menor que 500KB
		// y que sea un tipo de extensión permitida
		if ($valor['size']<5000000 && (in_array($valor['type'],$extensiones))){
			//Se guarda la imagen en la carpeta unituit.com/anuncios/ con el nombre asignado
			//El nombre vendrá dado por autoincremento
			move_uploaded_file($valor["tmp_name"],"../../anuncios/" . $numero_img.".png");
			echo "Imagen subida con éxito";
		}else{
			//Revertimos el guardado en la bbdd de los datos anteriores
			$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
			$consulta = sprintf("SELECT * FROM anuncio WHERE Imagen='%s'",$numero_img.".png");
			$respuesta = $db->query($consulta);
			$respuesta = $respuesta->fetch_array();
			$id_anuncio = $respuesta['id'];
			//Eliminamos los datos
			$borrado_anuncio = sprintf("DELETE FROM anuncio WHERE id=%s",$id_anuncio);
			$respuesta = $db->query($borrado_anuncio);
			$borrado_usuarioanuncio = sprintf("DELETE FROM usuarioanuncio WHERE idanuncio=%s",$id_anuncio);
			$respuesta = $db->query($borrado_usuarioanuncio);	
			die("00");
		}
	}
?>