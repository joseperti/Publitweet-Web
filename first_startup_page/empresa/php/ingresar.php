<?php
	session_start();
	$nombre = $_POST['usuario'];
	$usuario = md5($nombre);
	$password = md5($_POST['pass']);
	//Conexión a la bdd
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = "SELECT * FROM EmpresaAcceso WHERE Usuario='".$usuario."'";
	$integridad = $db->query($consulta) or die("Error en acceso");
	if ($integridad->num_rows!=0){
		$integridad = $integridad->fetch_array();
		if ($password==$integridad[1]){
			$consulta = "SELECT * FROM Empresa WHERE CIF='".$integridad['CIF']."'";
			$datos = $db->query($consulta) or die("Error en empresa");
			$row = $datos->fetch_array();
			if (!is_null($datos)){
				$_SESSION['cif'] = $row['CIF'];
				$_SESSION['user'] = $nombre;
				$_SESSION['imagen'] = "../../recursos/empresa_img/".$row['Imagen'];
				$_SESSION['email'] = $row['Email'];
				$_SESSION['apellidos'] = $row['Apellidos'];
				$_SESSION['nombre'] = $row['Nombre'];
				$_SESSION['telefono'] = $row['Telefono'];
				$_SESSION['provincia'] = $row['Provincia'];
				echo "11";
			}else{
				die("No hay datos");
			}
		}else{
			die("-Contraseña o usuario incorrectos");
		}
	}else{
		die("Contraseña o usuario incorrecto");
	}
?>