<?php
	session_start();
	$cliente = $_POST['clientes'];
	$categoria = $_POST['categoria'];
	$cif = $_SESSION['cif'];
	$mensaje = $_POST["mensaje"];
	$link = $_POST['link'];
	$texto_producto = $_POST['texto_producto'];
	$coste = floatval($_POST['coste']);
	$fecha = date("Y-m-d H:i:s");
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = "SELECT * FROM anuncio";
	$numero = $db->query($consulta);
	$_SESSION['numero_img'] = $numero->num_rows;
	$consulta = "INSERT INTO `anuncio`(`categoria`, `Texto`, `FechaCreacion`,`CIF`,`Coste`,`Tipo`,`Link`,`Informacion`) 
	VALUES (".$categoria.",'".str_replace("http://", " ", $mensaje)."','".$fecha."','".$cif."',".$coste.",1,'".$link."','".$texto_producto."')";
	$db->query($consulta) or die("Error: ".$db->error);
	$idanuncio =$db->insert_id;
	foreach ($cliente as $usuario){
		$coste ="SELECT * FROM datosusuario WHERE idTwitter=".$usuario;
		$resultado = $db->query($coste);
		$row = $resultado->fetch_array();
		$consulta ="INSERT INTO usuarioanuncio(idTwitter,idanuncio,Coste) VALUES (".$usuario.",".$idanuncio.",".$row['Coste'].")";
		$db->query($consulta);
		$coste += $row['Coste'];
		$consulta = sprintf("UPDATE datosusuario SET UltimoRecibido = '%s' WHERE idTwitter = '%s' ",date('Y-m-d H:i:s'),$usuario);
		$db->query($consulta) or die($db->error);
	}
?>