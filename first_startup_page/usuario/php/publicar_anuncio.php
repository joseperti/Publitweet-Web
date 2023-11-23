<?php 
	require_once 'tmhoauth.php';
	require_once '../../php/twitteroauth.php';
	session_start();
	$id_anuncio = $_POST['id'];
	$usuario = $_SESSION['id'];
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = sprintf("SELECT * FROM anuncio WHERE id=%s",$id_anuncio);
	$respuesta = $db->query($consulta) or die("Error en obtener el anuncio: ".$db->error);
	if ($row = $respuesta->fetch_array()){
		$coste = $row['Coste'];
		$twitter = $_SESSION['conexionTwitter'];
		$texto_tweet = $row['Texto'];
		$texto_anunciante = $row['Texto'];
		if ($row['Tipo'] =="1"){
			$texto_tweet = $texto_tweet." ".$row['Link']." #publi";
			$twitter->post('statuses/update', array('status' => $texto_tweet));
			//Actualizamos el estado del anuncio publicado por el usuario
		}else if($row['Tipo'] =="2"){
			$texto_tweet = $row['Texto']." ".$row['Link']." #publi";
			$tmhOAuth = $_SESSION['tmh'];
			$image = '../../anuncios/'.$row['Imagen'];
			$code = $tmhOAuth->request('POST', $tmhOAuth->url('1.1/statuses/update_with_media'),
			  array(
			    'status'   => $texto_tweet,
			    'media[]'  => file_get_contents($image)
			  ),
	 		  true,
	  	   	  true
			);
		}
		//Obtenemos el id del tweet en el que se ha publicado el anuncio
		$tweet_leido = "";
		$idTweet = 0;
		//Veamos que se ha publicado en el timeline del usuario
		//while ($tweet_leido != $texto_tweet){
		//	$datos = $twitter->get("https://api.twitter.com/1.1/statuses/user_timeline.json?count=1");
		//	$datos = $datos[0];
		//	$tweet_leido = $datos->text;
		//	$idTweet = $datos->id_str;
		//}
		//Guardamos el anuncio publicado por el usuario para la posterior verificación
		$consulta = sprintf("UPDATE usuarioanuncio SET Estado=1,fecha='%s',Texto='%s',idTweet=%s WHERE (idTwitter=%s AND idanuncio=%s)",
			date("Y-m-d H:i:s"),$texto_anunciante,$idTweet,$usuario,$id_anuncio);
		$db->query($consulta) or die($db->error);
		//Actualizamos el monedero del usuario añadiendo al dinero sin verificar el coste del anuncio
		echo "11";
	}
?>