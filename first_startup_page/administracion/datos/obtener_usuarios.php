<?php
	session_start();
	$pass = $_SESSION['pass'];
	if ($pass == 'password'){
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		$consulta = "SELECT * FROM datosusuario D,Usuarios U WHERE D.idTwitter = U.idTwitter ORDER BY D.FechaAlta DESC";
		$respuesta = $db->query($consulta);
		while ($row = $respuesta->fetch_array()){
			echo '<br>';
			switch ($row['estado']) {
				case '0':
					echo '<span style="background-color:#32CD32">Estado</span>';
					break;
				
				case '1':
					echo '<span style="background-color:#FFDEAD">Estado</span>';
					break;

				case '2':
					echo '<span style="background-color:#FFD700">Estado</span>';
					break;

				default:
					echo "Error";
					break;
			}
			echo 'Nombre: '.$row['Nombre'].' - Twitter: <a href="https://twitter.com/'.$row['screen_name'].'" target="_blank">'.$row['screen_name'].' </a>
			- Fecha: '.$row['FechaAlta'].' - Ult.Acceso: '.$row['UltimoAcceso'].'
			 - Followers: '.$row['Followers'].' - 
			 <button style="background-color:#32CD32" onclick="estado_usuario(0,this)" value="'.$row['idTwitter'].'">Activar</button>
			 <button style="background-color:#FFDEAD" onclick="estado_usuario(1,this)" value="'.$row['idTwitter'].'">Baneo 1 día</button>
			 <button style="background-color:#FFD700" onclick="estado_usuario(2,this)" value="'.$row['idTwitter'].'">Baneo 7 días</button>';
		}
		$db->close();
	}else{
		die("Error");
	}

?>