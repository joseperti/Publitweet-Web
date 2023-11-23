<?php
	$id_anuncio = $_POST['id'];
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = sprintf("SELECT * FROM anuncio WHERE id=%s",$id_anuncio);
	$respuesta = $db->query($consulta) or die("Error en obtener el anuncio: ".$db->error);
	while($row = $respuesta->fetch_array()){
		$consulta = sprintf("SELECT * FROM Empresa WHERE CIF='%s'",$row['CIF']);
		$empresa = $db->query($consulta);
		$empr = $empresa->fetch_array();
		echo "<CENTER><br><span class='label'>Empresa:</span> <br><img height='200' width='250'  src='../../recursos/empresa_img/".$empr['Imagen']."'></img>";
		echo "<br><span class='label'>Información del producto:<br>".$row['Informacion']."<br>Texto:<br> ".$row['Texto']."<br></span>";
		echo "<button onclick='publicar(this)' class='anuncio_est' value=".$row['id'].">Publicar</button><button class='anuncio_est' onclick='rechazar(this)' value=".$row['id'].">Rechazar</button>";
		if ($row['Tipo']=="2"){
			echo "<br>Imagen <br><img id='img' height='400' width='400' src='../../anuncios/".$row['Imagen']."'></img><br>";
		}
	}
?>