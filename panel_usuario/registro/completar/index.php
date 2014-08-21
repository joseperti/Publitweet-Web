<?php
	require_once '../../php/twitteroauth.php';
	require_once '../../php/config_user.php';
	require_once('../../php/tmhoauth.php');
	session_start();
	$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	$consulta = sprintf("insert into Twittero(id_twitter,nick_twitter,fecha_registro,estado,
		followers,following,mail,nombre,edad,interes,imagen,pais,ciudad) values('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
		$_SESSION['twitter_id'],$_SESSION['twitter_screen_name'],date("Y-m-m H:i:s"),"1",
		$_SESSION['twitter_followers'],$_SESSION['twitter_following'],
		$_POST['mail'],$_POST['nombre'],$_POST['edad'],"",$_SESSION['twitter_imagen'],
		$_POST['pais'],$_POST['ciudad']);
	$resultado = $db->query($consulta) or die($db->error);
	$tweetear = isset($_POST['tweet']);
	if ($tweetear){
		$tmhOAuth = $_SESSION['twitter_conexion'];
		$code = $tmhOAuth->request('POST', $tmhOAuth->url('1.1/statuses/update'),
		  array(
		    'status' => "Registrado en @PubliTweetWeb para ganar dinero con mis tweets"
		  ),
			  true,
		   	  true
		);
	}
	unset($_SESSION["twitter_status"]);
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Completando Registro</title>
	<link href="../../../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="../../../script/bootstrap.js"></script>
	<script type="text/javascript">
		setTimeout(function(){
			location.href = "../../login/";
		},3000);
	</script>
</head>
<body>
<center>
	<div class="alert alert-success">
		<h1>Bienvenido a PubliTweet</h1>
		Acceda otra vez e irá a su panel
		<br>
		Redireccionando...
	</div>
</center>
</body>
</html>