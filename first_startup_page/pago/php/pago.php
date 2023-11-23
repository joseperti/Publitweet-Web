<?php

	$email = $_POST['email'];
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001') or die("Error en el acceso a BBDD");
	$consulta = sprintf("SELECT * FROM Empresa WHERE Email='%s'",mysqli_real_escape_string($email));
	$respuesta = $db->query($consulta);
	if ($respuesta->num_rows == 0){
		die("Error en el correo");
	}else{
		$row = $respuesta->fetch_row();
		$cif = $row['CIF'];
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < 9; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    mail($email,'Unituit.com solicitud de cambio de contraseña','Buenas, le comunicamos que su nueva contraseña es: "'.$randomString.'" \n
	    	(sin las comillas dobles)');
	    $password = md5($randomString);
	    $consulta = sprintf("UPDATE EmpresaAcceso SET Pass='%s' WHERE CIF='%s'",$password,$cif);
		$respuesta = $db->query($consulta) or die("Error en la renovación de contraseña");
		die("Revise su correo");
	}

?>