<?php
	$nombre=$_POST['name'];
	$contrasena =$_POST['password'];
	if (($nombre=="unituituser") && ($contrasena=="password")){
		session_start();
		$_SESSION['pass'] = $contrasena;
		header("Content-Type: text/html; charset=UTF-8");
		echo '<script src="script/anuncios.js"></script>
			<script src="script/usuarios.js"></script>';
		$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001');
		echo '<CENTER>
		<div id="seleccion" bgcolor="#00FFFF">
		</div>
		<div id="estadisticas_block"> Estadísticas de Unituit<br>';
			$consulta = "SELECT * FROM datosusuario";
			$respuesta = $db->query($consulta);
			$usuarios_totales = $respuesta->num_rows;
			echo '<br>Número de usuarios: '.$usuarios_totales.'<br>';
			$consulta = "SELECT SUM(Followers) FROM datosusuario";
			$respuesta = $db->query($consulta);
			$row = $respuesta->fetch_array();
			$followers_totales = $row['SUM(Followers)'];
			echo '<br>Numero total de seguidores: '.$followers_totales.'<br>';
			echo '<br>Estadisticas de categorias:<br>';
			$consulta = "SELECT C.nombre,C.id,CU.idCategoria,SUM(Followers),CU.idCategoria,CU.idTwitter,D.idTwitter,COUNT(CU.idTwitter)
			 FROM categoriasusuario CU,datosusuario D,Categorias C WHERE (CU.idTwitter = D.idTwitter and C.id=CU.idCategoria) 
			 GROUP BY CU.idCategoria ";
			$respuesta = $db->query($consulta);
			while($row = $respuesta->fetch_array()){
				echo '<br>Categoria: '.$row['nombre'].' .Usuarios: '.$row['COUNT(CU.idTwitter)'].'.Followers: '.$row['SUM(Followers)'];
			}
			echo '<br><br><b>Evolucion de Unituit.com</b><br>';
			$db->close();

			//Guardamos los nuevos datos en bbdd unituitc_adminis
			$fecha = date("Y-m-d H:i:s");
			$db = new mysqli('localhost', 'unituitc_adminis', 'admin&uni13','unituitc_administracion') or die("error conexion administracion");
			$consulta = sprintf("SELECT * FROM evolucion WHERE Fecha>=date_sub('%s',interval 12 hour)",$fecha);
			$respuesta = $db->query($consulta);
			if ($respuesta->num_rows == "0"){
				$consulta = sprintf("INSERT INTO evolucion(Fecha,Usuarios,Activos,PInactivos,Inactivos,Followers)
				 VALUES ('%s',%s,0,0,0,%s)",$fecha,$usuarios_totales,$followers_totales);
				$respuesta = $db->query($consulta);
			}
			//Obtenemos los datos guardados por día
			$consulta = sprintf("SELECT * FROM evolucion");
			$respuesta = $db->query($consulta);
			$puntos_usuario = '[[0,0]';
			$puntos_followers = '[[0,0]';
			$orden = 1;
			echo "<br>Guardado de 12h-12h<br>";
			while ($row = $respuesta->fetch_array()){
				echo '<br>Fecha: '.$row['Fecha'].' - Usuarios: '.$row['Usuarios'].' - Followers: '.$row['Followers'];
				$puntos_usuario = $puntos_usuario.',['.$orden.','.$row['Usuarios'].']';
				$puntos_followers = $puntos_followers.',['.$orden.','.$row['Followers'].']';
				$orden ++;
			}
			$puntos_usuario = $puntos_usuario . ']';
			$puntos_followers = $puntos_followers . ']';
			echo "<br>
			<script> 
			$(function () { 
				console.log('Dibujando grafica');
				var d1 = ".$puntos_usuario.";
				$.plot($('#grafica_usuarios'),[{label:'Usuarios',data:d1,color:'green'}],{xaxis: {ticks:".$orden.",min:0,max:".$orden."},yaxis: {ticks:10,min: 0,max:".($usuarios_totales)."}
					,points: {show:true,color:'blue'},lines:{show:true,color:'green'},grid:{backgroundColor:{colors: ['#B0E0E6','#ADD8E6']}}}); 
				d1 = ".$puntos_followers.";
				$.plot($('#grafica_followers'),[{label:'Followers',data:d1,color:'blue'}],{xaxis: {ticks:".$orden.",min:0,max:".$orden."},yaxis: {ticks:5,min: 0,max:".((int) $followers_totales*1.5)."}
					,points: {show:true,color:'blue'},lines:{show:true,color:'green'},grid:{backgroundColor:{colors: ['#B0E0E6','#ADD8E6']}}}); 
			});
			</script>
			<br>Gráfica: <br>
			<div id='grafica_usuarios' style='width:640px;height:480px'></div><br>
			<div id='grafica_followers' style='width:640px;height:480px'></div></div><br>";
		$db->close();

		//Bloque de anuncios

		echo '<div id="anuncios_block">
			<br>Anuncios:<br>';
		echo '</div>';

		//Bloque de usuarios

		echo '<div id="usuarios_block">
			<br>Usuarios:<br>
			</div>';

		//Bloque de empresas

		echo '<div id="empresas_block">
			<br>Anunciantes:<br>
			</div>';


		//Ejecutamos los javascript
		echo "<br>
		<script>
			inicio();
		</script>";

	}else{
		header('Location: http://unituit.com');
	}
	
?>