<?php
	session_start();
	//Variables
	require_once('coste.php');
	try{
		$pais = $_POST['pais'];
		$direccion = $_POST['direccion'];
		$provincia= $_POST['provincia'];
		//Comprobamos que existe registro del pais y la direccion en el formulario
		//if ( $pais=="" || $direccion ==""){
		//	die("01");
		//}
		$usuario = $_SESSION['usuario'];
		if ($usuario == ""){
			die("Error");
		}
		$id = $_SESSION['id'];
		$followers = $_SESSION['followers'];

		if ($followers < 100){
			die("02");
		}
		
		$nombre = $_POST['nombre'];
		$correo = $_POST['correo'];
		$comercial = $_POST['comercial'];
		$categorias = $_POST['categorias'];
		if ($nombre=="" || $correo=="" || $categorias==""){
			die("Rellene todos los campos");
		}
		$coste = coste($followers);
		$fecha = date("Y-m-d H:i:s");
		//Acceso
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001') or die("Error en el acceso a BBDD");
		//Insertamos el usuario en el registro
		$consulta = sprintf("INSERT INTO Usuarios VALUES (%s,0)",mysqli_real_escape_string($db,$id));
		$db->query($consulta) or die("Error en la consulta");
		//Insertamos los datos del usuario
		$consulta = "INSERT INTO datosusuario(DNI,Nombre,Email,idTwitter,Coste,FechaAlta,screen_name,Direccion,Provincia,Followers,Comercial) VALUES ('null','".mysqli_real_escape_string($db,$nombre)."',
			'".mysqli_real_escape_string($db,$correo)."',".mysqli_real_escape_string($db,$id).",".mysqli_real_escape_string($db,$coste).",'".mysqli_real_escape_string($db,$fecha)."',
			'".$_SESSION['usuario']."','Ninguna','".mysqli_real_escape_string($db,$provincia)."',".$followers.",'".$comercial."')";
		$respuesta = $db->query($consulta) or die($db->error);
		//Insertamos las categorías del usuario
		foreach ($categorias as $cat){
			if ($cat!=null){
				$db->query("INSERT INTO categoriasusuario VALUES (".mysqli_real_escape_string($db,$id).",".mysqli_real_escape_string($db,$cat).",0)") 
				or die("Error en las categorias");
			}
		}
		//Iniciamos a 0 las ganancias del usuario. Rellenamos con la id del usuario y la fecha de creación
		$consulta = "INSERT INTO gananciausuario(idTwitter,fechaCreacion) VALUES (".mysqli_real_escape_string($db,$id).",'".mysqli_real_escape_string($db,$fecha)."')";
		$db->query($consulta) or die($db->error);
		die("11");
	}catch (Exception $e){
		die("Error en la conexión");
	}
?>
<!-- Códigos de error:
		- 01 : Error de la localización
		- 02 : Número de followers insuficiente	
	Código de fin:
		- 11 : Nuevo usuario registrado sin fallos
-->