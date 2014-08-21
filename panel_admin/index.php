<?php
	session_start();
	$usuario = "ftw";
	$pass = "123";
	if ($_SESSION['user']=="" || $_SESSION['pass']=="" || $_SESSION['user'] != $usuario || $_SESSION['pass']!=$pass){
		header("Location: ../home");
	}else{
		echo "Bienvenido";
		if ($_GET['display']==""){
			$_GET['display'] = 'usuario';
		}
		$_SESSION['connect'] = true;
		$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Panel de Administración</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" type="image/x-icon" href="/icon/favicon.ico">
    <script src="../script/jquery.js"></script>
    <script src="../script/bootstrap.js"></script>
    <meta charset="utf-8">
    <style type="text/css">
    body{
        font-family: Verdana;
    }
	.contenedor{
		height: 100%;
	}
	.seccion{
        margin-top: 50px;
		width: 100%;
		min-height: 100%;
        text-align: center;
	}
    .ultimos_tweets{
    }
    table{
    	width: 100%;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a href="../"><img src="../resources/logos/logo165_37.png" class="navbar-brand"></a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li data-target="#myCarousel"><a href="?display=usuario">Usuarios</a></li>
	        <li data-target="#myCarousel"><a href="?display=anunciante">Anunciantes</a></li>
	        <li data-target="#myCarousel"><a href="?display=anuncios">Anuncios</a></li>
	      </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="cerrar_sesion">Cerrar sesión</a></li>
          </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

<div class="contenedor">
	<div id="myCarousel" class="carousel slide">
      <!-- Carousel items -->
      <div class="carousel-inner">
        <div class="<?php if($_GET['display']=='usuario'){echo "active ";} ?> item">
        	<div class="seccion s_1" id="s_1">
				<?php
					if ($_GET['user_id']==""){
						$consulta = "SELECT * FROM Twittero order by fecha_registro desc";
						$twitteros = $db->query($consulta);
						while ($row = $twitteros->fetch_array()){
							echo "<a href='?user_id=".$row['id']."&display=usuario'><div class='alert alert-info'>Id: ".$row['id']."<br><img src='".$row['imagen'].
							"' width='200'><br>@".$row['nick_twitter']."</div></a>";
						}
					}else{
						$consulta = "SELECT * FROM Twittero where id=".$_GET['user_id'];
						$twitteros = $db->query($consulta);;
						while ($row = $twitteros->fetch_array()){
							echo "<center><table><tr><td>";
							echo "<center><div class='alert alert-info'>Id: ".$row['id']."<br>
							<img src='".$row['imagen']."' width='200'><br>@".$row['nick_twitter']."
							<br><br><a href='eliminar_usuario?id=".$row['id']."' class='btn btn-danger'>✖ Eliminar</a></div>";
							echo "</td><td><center>";
							echo "Aqui va el último tweet";
							echo "</td></tr></table>";
							echo "<div class='alert alert-warning'><h2>Anuncios</h2>";
							$consulta = "SELECT * FROM envio_anuncio,Anuncio where envio_anuncio.anuncio = Anuncio.id and envio_anuncio.destino = ".$row['id'];
							$anuncios = $db->query($consulta);
							while ($anuncio = $anuncios->fetch_array()){
								echo "<div class='alert alert-";
								switch ($anuncio['estado']) {
									case '0':
										echo "warning";
										break;
									case '1':
										echo "success";
										break;
									default:
										# code...
										break;
								}
								echo "'>".$anuncio['texto'];
								echo "</div>";
							}
							echo "</div>";
						}
					}
				?>
			</div>
        </div>
        <div class="<?php if($_GET['display']=='anunciante'){echo "active";} ?> item">
        	<div class="seccion s_2" id="s_2">
                <?php
					if ($_GET['user_id']==""){
						$consulta = "SELECT * FROM Anunciante order by fecha_registro desc";
						$twitteros = $db->query($consulta);
						while ($row = $twitteros->fetch_array()){
							echo "<a href='?user_id=".$row['id']."&display=anunciante'><div class='alert alert-info'>Id: ".$row['id']."<br><img src='../img_empresa/".$row['id'].
							".png' width='200'><br>".$row['usuario']."</div></a>";
						}
					}else{
						$consulta = "SELECT * FROM Anunciante where id=".$_GET['user_id'];
						$twitteros = $db->query($consulta);;
						while ($row = $twitteros->fetch_array()){
							echo "<center><table><tr><td>";
							echo "<center><div class='alert alert-info'>Id: ".$row['id']."<br>
							<img src='../img_empresa/".$row['id'].".png' width='200'><br>".$row['usuario']."
							<br><br><a href='eliminar_anunciante?id=".$row['id']."' class='btn btn-danger'>✖ Eliminar</a></div>";
							echo "</td><td><center>";
							echo "Aqui va el último tweet";
							echo "</td></tr></table>";
							echo "<div class='alert alert-warning'><h2>Anuncios</h2>";
							$consulta = "SELECT * FROM envio_anuncio,Anuncio where envio_anuncio.anuncio = Anuncio.id and Anuncio.anunciante = ".$row['id'];
							$anuncios = $db->query($consulta);
							while ($anuncio = $anuncios->fetch_array()){
								echo "<div class='alert alert-";
								switch ($anuncio['estado']) {
									case '0':
										echo "warning";
										break;
									case '1':
										echo "success";
										break;
									default:
										# code...
										break;
								}
								echo "'>".$anuncio['texto'];
								echo "</div>";
							}
							echo "</div>";
						}
					}
				?>
			</div>
        </div>
        <div class="item <?php if($_GET['display']=='anuncios'){echo "active";} ?>">
            <div class="seccion s_3" id="s_3">
            <?php
            if ($_GET['id']==""){
						$consulta = "SELECT * FROM Anuncio order by fecha_inicio desc";
						$twitteros = $db->query($consulta);
						while ($row = $twitteros->fetch_array()){
							echo "<a href='?id=".$row['id']."&display=anuncios'><div class='alert alert-info'><center>Id: ".$row['id']."<br><br><div style='max-width:40%;'>".$row['texto']."</div></div></a>";
						}
			}else{
						$consulta = "SELECT * FROM Anuncio, Anunciante where Anuncio.anunciante=Anunciante.id and Anuncio.id=".$_GET['id'];
						$twitteros = $db->query($consulta);;
						while ($row = $twitteros->fetch_array()){
							echo "<center><table><tr><td>";
							echo "<center><div class='alert alert-info'>Id: ".$row['id']."<br>
							<br><div style='max-width:40%;'>".$row['texto']."
							</div><br><br><a  class='btn btn-danger'>✖ Eliminar</a></div>";
							echo "</td><td><center>";
							echo "Fecha inicio: ".$row['fecha_inicio']."<br>Coste: ".$row['coste']."€<br>Twitteros: ".$row['publicaciones']."/".$row['twitteros']."<br>Seguidores: ".$row['seguidores'];
							echo "</td></tr></table>";
							echo "<center><a href='?user_id=".$row['id']."&display=anunciante'><div class='alert alert-info'>Id: ".$row['id']."<br>
							<img src='../img_empresa/".$row['id'].".png' width='200'><br>".$row['usuario']."
							</div></a>";
						}
					}
            ?>
            </div>
        </div>
      </div>
</div>
</div>
</body>
</html>