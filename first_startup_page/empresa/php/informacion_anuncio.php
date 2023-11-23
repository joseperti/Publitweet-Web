<?php
	$id_anuncio = $_POST['id'];
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = sprintf("SELECT * FROM anuncio WHERE id=%s",$id_anuncio);
	$respuesta = $db->query($consulta) or die("Error en obtener el anuncio: ".$db->error);
	while($row = $respuesta->fetch_array()){
		$consulta = sprintf("SELECT * FROM Empresa WHERE CIF='%s'",$row['CIF']);
		$empresa = $db->query($consulta);
		echo "<br>Empresa: <br><img src='../../recursos/empresa_img/".$row['Imagen']."'></img>";
		echo "<br>Texto: ".$row['Texto']."<br>";
		echo "<button onclick='publicar(this)' value=".$row['id'].">Publicar</button><button onclick='rechazar(this)' value=".$row['id'].">Rechazar</button>";
		if ($row['Tipo']=="2"){
			echo "<br>Imagen <br><img id='img' height='100' width='100' src='../../anuncios/".$row['Imagen']."'></img><br>";
		}
	}
?>