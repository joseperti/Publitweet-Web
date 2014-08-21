<?php 
	session_start();
	require_once '../php/twitteroauth.php';
	require_once '../php/config_user.php';
	require_once('../php/tmhoauth.php');
	$twitter = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$_SESSION["temp_token"],$_SESSION["temp_token_secret"]);
	$twitter_token = $twitter->getAccessToken($_REQUEST["oauth_verifier"]);
	$acept = ($twitter->http_code == 200);
	if ($acept){
		$SESSION["twitter_token"]=$twitter_token["oauth_token"];
		$SESSION["twitter_secret"]=$twitter_token["oauth_token_secret"];
		$SESSION["twitter_status"]=true;	
		$tmhOAuth = new tmhOAuth(array(
			'consumer_key' => CONSUMER_KEY,
			'consumer_secret' => CONSUMER_SECRET,
			'user_token' => $twitter_token["oauth_token"],
			'user_secret' => $twitter_token["oauth_token_secret"],
			'curl_ssl_verifypeer' => false
		));
		//Hacemos que el usuario haga follow a @PubliTweetWeb
		$code = $tmhOAuth->request('POST', $tmhOAuth->url('1.1/friendships/create.json'),
		  array(
		    'screen_name'   => 'PubliTweetWeb',
		    'follow'  => 'true'
		  ),
 		  true,
  	   	  true
		);
		$code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline.json?count=1')
			);
		$respuesta = $tmhOAuth->response['response'];
		$datos = json_decode($respuesta,true);
		$tweet = $datos[0]['id_str'];
		$datos = $datos[0]['user'];
		//Cargamos los datos en la SESSION:
		$_SESSION['twitter_conexion'] = $tmhOAuth;
		$_SESSION['twitter_id'] = $datos['id_str'];
		$_SESSION['twitter_imagen'] = str_replace("_normal", "",$datos['profile_image_url_https']);
		$_SESSION['twitter_bg_imagen'] =  $datos["profile_background_image_url_https"];
		$_SESSION['twitter_name'] = $datos['name'];
		$_SESSION['twitter_screen_name'] = $datos['screen_name'];
		$_SESSION['twitter_last_tweet'] = $tweet;
		$_SESSION['twitter_followers'] =  $datos['followers_count'];
		$_SESSION['twitter_following'] = $datos['friends_count'];
		$_SESSION["twitter_status"] = true;
		//Acceso a la base de datos
		$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
		$consulta = sprintf("SELECT * FROM Twittero where id_twitter = '%s'",$datos['id_str']);
		$resultado = $db->query($consulta) or die($db->error);
		if (($resultado->num_rows) != 0){
			$consulta = sprintf("update Twittero set nick_twitter = '%s' ,followers  = %s ,following  = %s , imagen = '%s' where id_twitter='%s'",
				$_SESSION['twitter_screen_name'],$_SESSION['twitter_followers'],$_SESSION['twitter_following'],
				$_SESSION['twitter_imagen'],$_SESSION['twitter_id']);
			$db->query($consulta);
			$url = "'../'";
			$row = $resultado->fetch_array();
			$_SESSION['id'] = $row['id'];
		}else{
			$consulta = sprintf("insert into Twittero_accedido(screen_name,fecha) values('%s','%s')",$datos['screen_name'],date("Y-m-d H:i:s"));
			$resultado = $db->query($consulta) or die($db->error);
			$url = "'../registro/'";
		}
	}else{
		echo "Error";
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Accediendo</title>
 	<script type="text/javascript">
 	location.href = <?php echo $url; ?>;
 	</script>
 </head>
 <body>
 	<center>
  		Se está cargando su panel..
 	</center>
 </body>
 </html>