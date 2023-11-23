<?php
	/*Diferenciaremos los tipos de acceso de los usuarios:
	-Habilitado: permiso normal de acceso
	-Deshabilitado: permiso denegado al usuario
	En caso de que no haya constancia del usuario en la BBDD se
	direccionará a "nuevo.php" que se encargará de recopilar los
	datos primordiales del usuario
	*/
	session_start();
	header('Content-type: text/html; charset=utf-8');
	require_once('php/coste.php');
	require_once '../php/twitteroauth.php';
	require_once '../php/config_user.php';
	require_once('php/actualizar_monedero.php');
	$twitter = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$_SESSION["temp_token"],$_SESSION["temp_token_secret"]);
	$twitter_token = $twitter->getAccessToken($_REQUEST["oauth_verifier"]);
	if ($twitter->http_code == 200){
		  //Verificado
		$SESSION["twitter_token"]=$twitter_token["oauth_token"];
		$SESSION["twitter_secret"]=$twitter_token["oauth_token_secret"];
		$SESSION["twitter_status"]=true;

		require_once('php/tmhoauth.php');

		$id_anuncio = $_POST['id'];
		$usuario = $_SESSION['id'];
		//creamos tmhOAuth también
		$tmhOAuth = new tmhOAuth(array(
			'consumer_key' => 'L25ZwtCeYuz25aw1H4q3OA',
			'consumer_secret' => 'A1vVs4Cc3tAlUEOqWXlqzuLwNes9ujNXNkciqbNrPU',
			'user_token' => $twitter_token["oauth_token"],
			'user_secret' => $twitter_token["oauth_token_secret"],
			'curl_ssl_verifypeer' => false
		));
		$_SESSION['tmh'] = $tmhOAuth;
		//Lo guardamos en la sesión
		$verif = "Verificado";
		$datos = $twitter->get("https://api.twitter.com/1.1/statuses/user_timeline.json?count=1");
		$datos = $datos[0];
		//Hacemos que el usuario haga follow a @unituit
		$code = $tmhOAuth->request('POST', $tmhOAuth->url('1.1/friendships/create.json'),
			  array(
			    'screen_name'   => 'unituit',
			    'follow'  => 'true'
			  ),
	 		  true,
	  	   	  true
			);
		$_SESSION['conexionTwitter'] = $twitter;
		//Guardaremos los datos en una sesión para poder movernos entre las distintas páginas
		$_SESSION['datos'] = $datos;
		$usuario = $datos->user->id_str;
		$_SESSION['usuario'] = $datos->user->screen_name;
		$_SESSION['id'] = $datos->user->id_str;
		$_SESSION['followers'] = $datos->user->followers_count;
		if ($_SESSION['followers']<100){
			die("Debes tener al menos 100 followers");
		}
		$coste = coste($_SESSION['followers']);
		$pais = $datos->place->country_code;
		$_SESSION['coste'] = $coste;
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		$registrado = $db->query("SELECT * FROM Usuarios WHERE (idTwitter =".$usuario.")");
		$filas = mysqli_num_rows($registrado);
		if ($row = $registrado->fetch_array()){
			if ($row['estado']=="0"){
				$consulta = sprintf("UPDATE datosusuario SET Coste=%s,Pais='%s',UltimoAcceso='%s',screen_name='%s',Followers=%s WHERE idTwitter=%s",$coste,$pais,date("Y-m-d H:i:s"),$_SESSION['usuario'],$_SESSION['followers'],$usuario);
				$registrado = $db->query($consulta) or die($db->error);
				$resultado = $db->query("SELECT * FROM datosusuario WHERE (idTwitter =".$usuario.")");
				$row = $resultado->fetch_array();
				$_SESSION['correo'] = $row['Email'];
				$_SESSION['direccion'] = $row['Direccion'];
				actualizar_monedero();
				//Geolocalizacion activada para usar unituit. Tweet de control.
				//if ($_SESSION['direccion']!=""){
				header("Location:panel_usuario");
				//}else{
				//	header("Location:../loc/localizacion.html");
				//}
			}elseif ($row['estado']=="1"){
				//Usuario con permiso denegado
				header("Location:http://unituit.com/final/disabled/ban_1_dias.html");
			}elseif ($row['estado']=="2"){
				//Usuario con permiso denegado
				header("Location:http://unituit.com/final/disabled/ban_7_dias.html");
			}
		}else{
			//No hay datos del usuario
			//Filtro para más de 100 followers
			$twitter->post('statuses/update', array('status' => 'Uniéndome a unituit.com @unituit'));
			header("Location:nuevo_usuario");
		}
	}else{
		  //Error de acceso
		echo "Error en la carga";
		//header("Location : ../error/error.html");
	}
?>
