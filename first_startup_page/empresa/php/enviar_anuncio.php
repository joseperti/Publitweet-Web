<?php
	session_start();
	$cliente = $_POST['clientes'];
	$categoria = $_POST['categoria'];
	$cif = $_SESSION['cif'];
	$mensaje = $_POST["mensaje"];
	$fecha = date("Y-m-d H:i:s");
	foreach ($cliente as $usuario){
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		$coste ="SELECT * FROM datosusuario WHERE idTwitter=".$usuario;
		$resultado = $db->query($coste);
		$row = $resultado->fetch_array();
		$consulta = "INSERT INTO `anuncio`(`categoria`, `personas`, `Texto`, `FechaCreacion`,`CIF`,`Coste`) VALUES (".$categoria.",".$usuario.",'".$mensaje."','".$fecha."','".$cif."',".$row['Coste'].")";
		$db->query($consulta) or die("Error: ".$db->error);
		echo "Anuncio enviado \n";
	}
?>