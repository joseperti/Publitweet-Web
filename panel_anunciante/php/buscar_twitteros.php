<?php

	$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	$consulta = sprintf("SELECT * FROM Twittero");
	$respuesta = $db->query($consulta);
	$cont = 0;
	while ($row=$respuesta->fetch_array()){
		echo "<div class='twittero alert alert-success' title='".$row['nick_twitter']."'onmouseover='clase_info(this)' onmouseout='clase_success(this)' onclick='seleccionar_twittero(".$row['id'].",".$row['followers'].",this)'>
		<center><img width='50' height='50' src='".$row['imagen']."'><span class='panel panel-default datos-twittero'>Followers:<br>".$row['followers']."<br>".$row['pais']."<br>".$row['ciudad']."</span></div>";
		$cont++;
		if ($cont == 3){
			echo "<br>";
			$cont = 0;
		}
	}

?>