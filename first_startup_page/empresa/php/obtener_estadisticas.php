<?php
	$id = $_POST['id'];
	echo "<CENTER><br>id: ".$id.",";
	$db = mysqli_connect('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	//Numero de twitteros a los que se han enviado
	$consulta = "SELECT COUNT(idanuncio) FROM usuarioanuncio WHERE idanuncio=".$id;
	$resultado = $db->query($consulta) or die($db->error);
	$row = $resultado->fetch_array();
	$total = $row['COUNT(idanuncio)'];
	echo "Estadisticas de anuncio: <br>".$total.' (total de twitteros)<br>';
	//Numero de veces twitteado
	$consulta = sprintf("SELECT COUNT(idanuncio) FROM usuarioanuncio WHERE (idanuncio=%s and fecha IS NOT NULL)",$id);
	$resultado = $db->query($consulta) or die($db->error);
	$row = $resultado->fetch_array();
	echo $row['COUNT(idanuncio)']." (total de publicaciones)<br>";
	if ($total!=0){
		echo "<br>Avance del anuncio: ".(int) (($row['COUNT(idanuncio)']/$total)*100)."%";
	}
	
	//Obtenemos el array de fecha-numero publicaciones
	$consulta = sprintf("SELECT COUNT(idanuncio),fecha FROM usuarioanuncio WHERE (idanuncio=%s and fecha IS NOT NULL) GROUP BY fecha",$id);
	$resultado = $db->query($consulta) or die($db->error);
	echo "<br> Evolución: <br>";
	//Puntos de la evolución del anuncio
	$array_puntos = "[[";
	$punto = 0;
	while($row = $resultado->fetch_array()){
		echo $row['COUNT(idanuncio)']."-".$row['fecha'];
		if ($punto==0){
			$array_puntos = $array_puntos."[".$punto.",".$row['COUNT(idanuncio)']."]";
			$punto += 1;
		}else{
			$array_puntos = $array_puntos.",[".$punto.",".$row['COUNT(idanuncio)']."]";
			$punto += 1;
		}
	}
	$array_puntos = $array_puntos."]]";
	echo "<script id='source'> 
		$(function () { 
			console.log('Dibujando grafica');
			var d1 =".$array_puntos."; 
			$.plot($('#grafica'),d1,{color:'blue',points: {show:true,color:'blue'},lines:{show:true}}); 
		});
		</script>
		<div id='grafica' style='width:300px;height:300px'></div>";

	//Datos del link acortado
	$consulta = sprintf("SELECT Link FROM anuncio WHERE (id=%s)",$id);
	$resultado = $db->query($consulta) or die($db->error);
	$array = $resultado->fetch_array();
	$link = $array['Link'];
	if ($link!=""){
		echo "
		<script>
			jQuery.urlShortener({
		    shortUrl: '".$link."',
		    projection: 'FULL',
		    success: function (info) {
		    	$('#estadisticas_link').html(
		    		'Url: '+info.longUrl + '<br> Clicks siempre: ' + info.analytics.allTime.shortUrlClicks 
		    		+ '<br> Clicks este mes: ' + info.analytics.month.shortUrlClicks
		    		+ '<br> Clicks esta semana: ' + info.analytics.week.shortUrlClicks);
		    },
		    error: function(err)
		    {
		        alert(JSON.stringify(err));        
		    }
		});
		</script>
		Estadísticas del Link
		<div id='estadisticas_link'>
		</div>";
	}
?>