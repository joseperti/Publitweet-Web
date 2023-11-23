<?php
	session_start();
	$pass = $_SESSION['pass'];
	if ($pass == 'password'){
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		$consulta = "SELECT * FROM Empresa";
		$respuesta = $db->query($consulta);
		while ($row = $respuesta->fetch_array()){
			echo '<br>';
			switch ($row['Estado']) {
				case '0':
					echo '<span style="background-color:#32CD32">Estado </span>';
					break;
				
				case '1':
					echo '<span style="background-color:#FFDEAD">Estado </span>';
					break;

				case '2':
					echo '<span style="background-color:#FFD700">Estado </span>';
					break;

				default:
					echo "Error";
					break;
			}
			echo 'Nombre: '.$row['Nombre'].' - Id: '.$row['idTwitter'].' 
			- Fecha: '.$row['FechaAlta'].' - CIF: '.$row['CIF'].' -  Telefono: '.$row['Telefono'].' - Mail: '.$row['Email'].'
			 <button style="background-color:#32CD32" onclick="estado_anunciante(0,this)" value="'.$row['CIF'].'">Activar</button>
			 <button style="background-color:#FFDEAD" onclick="estado_anunciante(1,this)" value="'.$row['CIF'].'">Baneo 1 día</button>
			 <button style="background-color:#FFD700" onclick="estado_anunciante(2,this)" value="'.$row['CIF'].'">Baneo 7 días</button>';
		}
		$db->close();
	}else{
		die("Error");
	}
?>