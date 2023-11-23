<?php
	$categoria = $_POST['categoria'];
	$provincia = $_POST['provincia'];
	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
	$consulta = sprintf("SELECT * FROM datosusuario U,categoriasusuario C WHERE (U.idTwitter = C.idTwitter and C.idCategoria=%s and U.Provincia='%s') ORDER BY U.Coste DESC",$categoria,$provincia);
	$resultado = $db->query($consulta);
	if ($resultado->num_rows == 0){
		echo "<br>No hay usuarios en esta provincia y en esta categoría<br>";
	}else{
		while ($row =$resultado->fetch_array()){
			echo "<br><button onclick='sumar_cliente(this)' value='".$row['Followers']."' name='".$row['idTwitter']."'> ".$row['Nombre']." ,coste: ".$row['Followers']."</button><br>";
		}
		$db->close();
	}
	
?>