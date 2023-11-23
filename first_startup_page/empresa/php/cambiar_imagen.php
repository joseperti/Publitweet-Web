<?php
	@session_start();
	$cif = $_SESSION['cif'];;
	$imagen = $_FILES;
	foreach($imagen as $valor){
		$extensiones = array("image/png","image/jpg","image/jpeg");
		//Como condiciones iniciales veremos que el peso del archivo sea menor que 500KB
		// y que sea un tipo de extensión permitida
		if ($valor['size']<5000000 && (in_array($valor['type'],$extensiones))){
			//Se guarda la imagen en la carpeta unituit.com/anuncios/ con el nombre asignado
			//El nombre vendrá dado por autoincremento
			move_uploaded_file($valor["tmp_name"],"../../recursos/empresa_img/" . $cif.".png");
			$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
			$consulta = sprintf("UPDATE Empresa SET Imagen='%s' WHERE CIF = '%s'",$cif.".png",$cif);
			$respuesta = $db->query($consulta) or die($db->error);
			$_SESSION['imagen'] = "../../recursos/empresa_img/".$cif.".png";
		}else{
			die("Error al subir imagen");
		}
	}
	die("Imagen subida con éxito");
?>