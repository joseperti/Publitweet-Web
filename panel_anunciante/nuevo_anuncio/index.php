<?php
	session_start();
	if (($_SESSION['id']=="") || ($_POST['texto']=="") || ( $_POST['seleccionados']=="") || $_POST['precio']==""){
		$error=true;
	}else{
		$precio_total = 0;
		$precio = floatval($_POST['precio']);
		$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
		$twitteros = $chars = preg_split('/,/', $_POST['seleccionados'], -1, PREG_SPLIT_NO_EMPTY);
		$texto = $_POST['texto'];
		$anunciante = $_SESSION['id'];
		$cantidad_twitteros = $_POST['cantidad_twitteros'];
		$cantidad_seguidores = $_POST['cantidad_seguidores'];
		$consulta = sprintf("insert into Anuncio(texto,anunciante,fecha_inicio,twitteros,seguidores) values ('%s','%s','%s',%s,%s)",
			$texto,$anunciante,date('Y-m-d H:i:s'),$cantidad_twitteros,$cantidad_seguidores);
		$db->query($consulta) or die($db->error);
		$consulta = sprintf("select * from Anuncio where anunciante = '%s' order by id desc",$anunciante);
		$resultado = $db->query($consulta) or die($db->error);
		$row = $resultado->fetch_array();
		$id_anuncio = $row['id'];
		foreach ($twitteros as $key) {
			$consulta = sprintf("SELECT * FROM Twittero where id= %s",$key);
			$individuo = $db->query($consulta) or die($db->error);
			$row = $individuo->fetch_array();
			if (intval($row['followers'])>1000){
				$precio_ind = 1000 * $precio;
			}else{
				$precio_ind = intval($row['followers']) * $precio;
			}
			$precio_total += $precio_ind;
			$consulta = sprintf("insert into envio_anuncio(anunciante,anuncio,destino,fecha,coste_ind) values ('%s','%s','%s','%s',%s)",
				$anunciante,$id_anuncio,$key,date('Y-m-d H:i:s'),$precio_ind);
			$db->query($consulta) or die($db->error);
		}
		$consulta = sprintf("update Anuncio set coste=%s where id=%s",$precio_total,$id_anuncio);
		$db->query($consulta) or die($db->error);
		$consulta = sprintf("select * from Anunciante where id=%s",$_SESSION['id']);
		$resultado = $db->query($consulta) or die($db->error);
		$anunciante = $resultado->fetch_array();
		$saldo_actual = floatval($anunciante['saldo']);
		if ($saldo_actual - $precio_total < 0){
			$error = true;
			$consulta = sprintf("DELETE FROM Anuncio where id=%s",$id_anuncio);
			$resultado = $db->query($consulta) or die($db->error);
			$consulta = sprintf("DELETE FROM envio_anuncio where anuncio=%s",$id_anuncio);
			$resultado = $db->query($consulta) or die($db->error);
		}else{
			$consulta = sprintf("update Anunciante set saldo = %s where id = %s",($saldo_actual - $precio_total),$_SESSION['id']);
			$resultado = $db->query($consulta) or die($db->error);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accediendo</title>
	<link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="../../script/jquery.js"></script>
    <script src="../../script/bootstrap.js"></script>
    <meta charset="utf-8">
    <script type="text/javascript">
    setTimeout(function(){
    	location.href = "../";
    },3000);
    </script>
</head>
<body>
	<?php 
		if (!$error){
			echo '<div class="alert alert-success">
				<center>
				<b>Anuncio creado correctamente</b><br>
				Redireccionando...
			</div>';
		}else{
			echo '<div class="alert alert-danger">
				<center>
				<b>Error al crear anuncio. Falta información
				<br>o no tiene saldo suficiente</b><br>
				Redireccionando...
			</div>';
		}
	?>	
</body>
</html>
