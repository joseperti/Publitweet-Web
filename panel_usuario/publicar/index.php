<?php
	require_once '../php/twitteroauth.php';
	require_once '../php/config_user.php';
	require_once('../php/tmhoauth.php');
	session_start();
	$id_anuncio = $_GET['id'];
	if ($id_anuncio==""){
		header("Location: ../");
	}
	$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	$consulta = sprintf("select * from Anuncio where id=%s",$id_anuncio);
    $resultado = $db->query($consulta);
    $row = $resultado->fetch_array();
	$tmhOAuth = $_SESSION['twitter_conexion'];
	$code = $tmhOAuth->request('POST', $tmhOAuth->url('1.1/statuses/update'),
	  array(
	    'status' => $row['texto'] ." #PubliTweet"
	  ),
		  true,
	   	  true
	);
	if ($code == 200 || $code == 403){
		$consulta = sprintf("select * from envio_anuncio where anuncio=%s and destino=%s",$id_anuncio,$_SESSION['id']);
		$anuncio = $db->query($consulta) or die($db->error);
		$anuncio = $anuncio->fetch_array();
		if ($anuncio['estado']=='0'){
			$consulta = sprintf("update envio_anuncio set estado = 1 where anuncio = %s and destino = %s",$id_anuncio,$_SESSION['id']);
			$resultado = $db->query($consulta) or die($db->error);
			$consulta = sprintf("update Anuncio set publicaciones = publicaciones + 1 where id=%s",$id_anuncio);
			$resultado = $db->query($consulta) or die($db->error);
			$consulta = sprintf("update Twittero set saldo = saldo + %s, publicaciones = publicaciones + 1 where id_twitter='%s'",$anuncio['coste_ind'],$_SESSION['twitter_id']);
			$resultado = $db->query($consulta) or die($db->error);
		}
		$code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline.json?count=1')
			);
		$respuesta = $tmhOAuth->response['response'];
		$datos = json_decode($respuesta,true);
		$tweet = $datos[0]['id_str'];
		$datos = $datos[0]['user'];
		$_SESSION['twitter_last_tweet'] = $tweet;
		header("Location: ../");
	}
?>