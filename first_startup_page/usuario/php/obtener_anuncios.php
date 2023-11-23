<?php
	/*Cosas por hacer:
	*	- Verificación en anuncios de tipo visual
	*/
	require_once '../../php/twitteroauth.php';
	session_start();
	require_once 'actualizar_monedero.php';
    actualizar_monedero();

    //Verificaciones de franjas horarias
    $f0 = strtotime(date("H:i"));
    $f1 = strtotime("10:30");
    $f2 = strtotime("12:30");
    $f3 = strtotime("16:00");
    $f4 = strtotime("17:30");
    $f5 = strtotime("19:30");
    $f6 = strtotime("22:00");
    $f7 = strtotime("00:00");
    $f8 = strtotime("07:00");
    $coste_franja_horaria = 1;
    echo "<span class='label'>";
    if ($f0>=$f7 && $f0<=$f8){
    	die("Franja horaria no permitida para publicar anuncios");
    }else if(($f0>=$f1 && $f0<=$f2)){
    	echo "Franja horaria de 11:00-13:30 óptima";
    }else if(($f0>=$f3 && $f0<=$f4)){
    	echo "Franja horaria de 17:00-18:30 óptima";
    }else if(($f0>=$f5 && $f0<=$f6)){
    	echo "Franja horaria de 20:30-23:00 óptima";
    }else{
    	echo "Se te aplicará un 30% de bajada de pago por la franja horaria";
    	$coste_franja_horaria = 0.7;
    }
    echo "</span><CENTER><br>";
	$estadoverificacion = 1;
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = sprintf("SELECT * FROM usuarioanuncio WHERE idTwitter =%s and fecha IS NULL and Estado = 0",$_SESSION['id']);
	$respuesta = $db->query($consulta);
	$cantidad_muestra = 1;
	while (($row = $respuesta->fetch_array()) && ($cantidad_muestra<=5)){
		$consulta = sprintf("SELECT * FROM anuncio WHERE id=".$row['idanuncio']);
		$anuncio = $db->query($consulta);
		$row = $anuncio->fetch_array();
		if ($row['Tipo']=="2"){
			//Al pulsar- Publicación o rechazo del anuncio
			echo "<br><div id='panelanuncio'><button class='anuncio_est'  onclick='informacion_anuncio(this)' value='".$row['id']."'><img id='img' height='100' width='100' src='../../anuncios/".$row['Imagen']."'></img></button>
			</div>";
		}else if($row['Tipo']=="1"){ 
			//Al pulsar- Publicación o rechazo del anuncio
			echo "<br><div ><button class='anuncio_est' onclick='informacion_anuncio(this)' value='".$row['id']."'>".$row['Texto']."</button>
			</div>";
		}
		$cantidad_muestra ++;
	}
	if ($respuesta->num_rows == 0 ){
		echo "<span class='label'>No hay anuncios disponibles para usted</span>";
	}
	//Verificación de anuncios
	$twitter = $_SESSION['conexionTwitter'];
	$consulta = sprintf("SELECT * FROM usuarioanuncio WHERE idTwitter =%s and estado=%s",$_SESSION['id'],$estadoverificacion);
	$respuesta = $db->query($consulta);
	if ($respuesta->num_rows != 0){
		echo "<br><span class='label'>Anuncio en proceso de verificación. <br>
	Recuerda no twittear nada hasta que esté verificado</span><br>";
	}
	while ($row = $respuesta->fetch_array()){
		echo "<br><button onclick='' value='".$row['id']."'>".$row['Texto']."<br>".$row['fecha']."</button>";
	}
	//Veamos los que han cumplido el tiempo
	//El límite de verificación actual es 5 Minutos !!!!! IMPORTANTE !!!!!
	$consulta = sprintf("SELECT * FROM usuarioanuncio WHERE idTwitter =%s and estado=%s and date_add(fecha,interval 5 minute) <= '%s'",
		$_SESSION['id'],$estadoverificacion,date("Y-m-d H:i:s"));
	$respuesta = $db->query($consulta) or die($db->error);
	while ($row = $respuesta->fetch_array()){
		//Vemos el ultimo tweet del usuario
		$datos = $twitter->get("https://api.twitter.com/1.1/statuses/user_timeline.json?count=1");
		$datos = $datos[0];
		$tweet_leido = $datos->text;
		if (($row['Texto']==$tweet_leido) || (strpos($tweet_leido, $row['Texto'])!== false) || (strpos($tweet_leido, '#publi')!== false)){
			$verificar = sprintf("UPDATE usuarioanuncio SET estado=2 WHERE idTwitter=%s and idanuncio=%s",$_SESSION['id'],$row['idanuncio']);
			$db->query($verificar) or die("Error al verificar: ".$db->error);
			$sumar_ganancia = sprintf("UPDATE gananciausuario SET acumulado = acumulado + %s
				WHERE idTwitter=%s",doubleval($row['Coste'])*$coste_franja_horaria,$_SESSION['id']);
			$db->query($sumar_ganancia) or die("Error en la ganancia: ").$db->error;
			echo "<-".doubleval($row['Coste'])*$coste_franja_horaria."€";
		}else{
			$strike_usuario = sprintf("UPDATE gananciausuario SET Strikes = Strikes + 1 WHERE idTwitter=%s",$_SESSION['id']);
			$db->query($strike_usuario) or die("Error al hacer strike: ".$db->error);
			$strike_anuncio = sprintf("UPDATE usuarioanuncio SET estado=9 WHERE idTwitter=%s and idanuncio=%s",$_SESSION['id'],$row['idanuncio']);
			$db->query($strike_anuncio) or die("Error al hacer strike: ".$db->error);
			die("<br><span class='label'>No se ha respetado la publicación de anuncio</span>");
		}
	}
?>