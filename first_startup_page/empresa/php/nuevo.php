<?php
	session_start();
	$usuario = md5($_POST['usuario']);
	$password = md5($_POST['password']);
	if (strlen($usuario)>100){
		die("20");
	}
	$cif = $_POST['cif'];
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$razonsocial = $_POST['razonsocial'];
	$provincia = $_POST['provincia'];
	$poblacion = $_POST['poblacion'];
	$direccion = $_POST['direccion'];
	$cpostal = $_POST['cpostal'];
	$fechaalta = date("Y-m-d");
	$estado = '0';
	$email = $_POST['email'];
	$telefono = $_POST['telefono'];
	//Comprobación de datos
	$array = array($_POST['usuario'],$_POST['password'],$cif,$nombre,$apellidos,$razonsocial,$provincia,$poblacion,$direccion,$cpostal,$email,$telefono);
	$cont = 0;
	foreach ($array as $valor) {
		$cont ++;
		if ($valor==""){
			die("Rellene el campo:".$cont);
		}
	}
	if ( !is_numeric($cpostal) || !is_numeric($telefono)){
		die("Error en los datos");
	}

	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	//Consulta de datos como usuario empresa
	$consulta = "SELECT * FROM EmpresaAcceso WHERE (Usuario='".mysqli_real_escape_string($db,$usuario)."' or CIF='".mysqli_real_escape_string($db,$cif)."')";
	$integridad = $db->query($consulta) or die("Error: " .$db->error);
	if ($integridad->num_rows!="0"){
		die("01");
	}else{
		//Guardamos el acceso de usuario y la clave
		$consulta ="INSERT INTO EmpresaAcceso(Usuario,Pass,CIF) VALUES('".mysqli_real_escape_string($db,$usuario)."','".mysqli_real_escape_string($db,$password)."','".mysqli_real_escape_string($db,$cif)."')";
		$resultado = $db->query($consulta) or die("Error al ingresar");
		//Ahora guardamos los datos como empresa
		$consulta ="INSERT INTO Empresa(CIF,RazonSocial,Provincia,
			Poblacion,Direccion,CPostal,FechaAlta,Estado,Email,Telefono,Nombre,Apellidos) VALUES
			('".mysqli_real_escape_string($db,$cif)."','".mysqli_real_escape_string($db,$razonsocial)."','".mysqli_real_escape_string($db,$provincia)."','".mysqli_real_escape_string($db,$poblacion)."','"
				.mysqli_real_escape_string($db,$direccion)."',".mysqli_real_escape_string($db,$cpostal).",'".mysqli_real_escape_string($db,$fechaalta)."',".mysqli_real_escape_string($db,$estado).",
				'".mysqli_real_escape_string($db,$email)."',".mysqli_real_escape_string($db,$telefono).",'".mysqli_real_escape_string($db,$nombre)."','".mysqli_real_escape_string($db,$apellidos)."')";
		$registrado = $db->query($consulta) or die("Error al guardar los datos: ".$db->error);
		//Inicializamos las ganancias de empresas
		$consulta = "INSERT INTO empresaganancias(id,CIF,fechaCreacion) VALUES (null,'".mysqli_real_escape_string($db,$cif)."',".mysqli_real_escape_string($db,$fechaalta).")";
		$db->query($consulta) or die($db->error);
		die("11");
	}
?>