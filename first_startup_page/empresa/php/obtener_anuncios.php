<?php
	function obtener_anuncios(){
		session_start();
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		$consulta = sprintf("SELECT Imagen,Texto,SUM(Coste),id,Tipo,Estado FROM anuncio WHERE `CIF`='%s' GROUP BY Texto ORDER BY FechaCreacion DESC",$_SESSION['cif']);
		$respuesta = $db->query($consulta) or die("Error:".$db->error);
		echo "<CENTER>";
		while ($row = $respuesta->fetch_array()){
			if ($row['Tipo']=="2"){
				//De tipo Visual
				echo "<br><button class='anuncio_est' onclick='estadisticasanuncio(this)' value='".$row['id']."''>".$row['Texto']." </button>
				<br>Imagen:<a href='../../anuncios/".$row['Imagen']."' target='_blank'> <img height='50' width='50' src='../../anuncios/".$row['Imagen']."'></img></a>";
			}else{
				echo "<br><button class='anuncio_est' onclick='estadisticasanuncio(this)' value='".$row['id']."'>".$row['Texto']." </button>";
			}
			if ($row['Estado']=="0"){
				echo "<br><span class='label'>Pendiente de pago</span>";
			}else if ($row['Estado']=="3"){
				echo "<br><span class='label'>Se ha eliminado el anuncio por no haber realizado el pago</span>";
			}
			echo "<br>";
		}
	}
	obtener_anuncios();
?>