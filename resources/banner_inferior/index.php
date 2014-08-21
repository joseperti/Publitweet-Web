<?php
	
	$array_images = ['image1.jpg','image2.jpg','image3.jpg','image4.jpg'];

?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	body{
		background-size: 100%,100%;
		background-attachment: fixed;
	}
	p{
		background-color: rgba(0,0,0,0.5);
		color:white;
		font-family: Verdana;
		text-align: center;
	}
</style>
</head>
<body background='
	<?php
		echo "../".$array_images[array_rand($array_images)];
	?>
'>
<center>
<p>
	<img width='200' src="../logo/publitweet300_50.png">
	<br>
	Bienvenido a su panel de usuario
	<br>
	Esto es una versión <b>no definitiva de PubliTweet</b>.
	Si tiene algún problema no dude en consultárnoslo:
	<br>
	contacto@publitweet.esy.es
</p>
</body>
</html>