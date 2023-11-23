<?php
	session_start();
	$cliente = $_POST['clientes'];
	$categoria = $_POST['categoria'];
	$cif = $_SESSION['cif'];
	$mensaje = $_POST["mensaje"];
	$link = $_POST['link'];
	$coste = $_POST['coste'];
	$texto_producto = $_POST['texto_producto'];
	$fecha = date("Y-m-d H:i:s");
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = "SELECT * FROM anuncio";
	$numero = $db->query($consulta);
	$_SESSION['numero_img'] = $numero->num_rows;
	$consulta = "INSERT INTO `anuncio`(`categoria`, `Texto`,`Imagen`, `FechaCreacion`,`CIF`,`Coste`,`Tipo`,`Link`,`Informacion`) 
	VALUES (".$categoria.",'".$mensaje."','".$_SESSION['numero_img'].".png','".$fecha."',
	'".$cif."',".$coste.",2,'".$link."','".$texto_producto."')";
	$db->query($consulta) or die("Error: ".$db->error);
	$idanuncio =$db->insert_id;
	foreach ($cliente as $usuario){
		$coste ="SELECT * FROM datosusuario WHERE idTwitter=".$usuario;
		$resultado = $db->query($coste);
		$row = $resultado->fetch_array();
		$consulta ="INSERT INTO usuarioanuncio(idTwitter,idanuncio,Coste) VALUES (".$usuario.",".$idanuncio.",".$row['Coste'].")";
		$db->query($consulta);
		$coste = $coste + (double) $row['Coste'];
		$consulta = sprintf("UPDATE datosusuario SET UltimoRecibido = '%s' WHERE idTwitter = '%s' ",date('Y-m-d H:i:s'),$usuario);
		$db->query($consulta) or die($db->error);
	}
	$actualizar_coste = sprintf("UPDATE anuncio SET Coste = %s WHERE id = %s",$coste,$idanuncio);
	$cuerpo = $cif." ha creado un anuncio de tipo visual a fecha: ".fecha."\nDatos del anuncio:\nmMensaje: ".$mensaje."\nInformación del producto: ".$texto_producto
	;
	mail('pagos@unituit.com','Se ha realizado un anuncio: '.$cif,$cuerpo);
	echo "Anuncio enviado";
?>