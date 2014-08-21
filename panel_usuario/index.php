<?php 
    session_start();
    if ($_SESSION['twitter_id']==""){
        header("Location: ../home/");
    }
    $db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
    $consulta = sprintf("update Twittero set ultimo_acceso = '%s' where id_twitter = '%s'",date('Y-m-d H:i:s'),$_SESSION['twitter_id']);
    $resultado = $db->query($consulta);
    $consulta = sprintf("SELECT * FROM Twittero where id_twitter = '%s'",$_SESSION['twitter_id']);
    $resultado = $db->query($consulta);
    $row = $resultado->fetch_array();
    if ($row['estado'] == '9'){
        header('Location: expulsion/?id=9');
    }
 ?>
<!-- 
    PubliTweet Web Page
    Created by José Pertierra das Neves & Daniel Ávila Fernández
    Copyright 2014 Publitweet
-->
<html>
<head>
    <title>Panel de usuario - PubliTweet</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" type="image/x-icon" href="/icon/favicon.ico">
    <script src="../script/jquery.js"></script>
    <script src="../script/bootstrap.js"></script>
    <meta charset="utf-8">
    <style type="text/css">
        body{
            font-family: Verdana;
            margin-bottom: 300px;
            background-image: url("../resources/bg/bg_01.png");
            background-size: 100% 100%;
        }
    	.contenedor{
    		height: 100%;
    	}
    	.seccion{
            margin-top: 50px;
    		width: 100%;
            height: auto;
            margin-bottom: 0px;
            text-align: center;
    	}
    	.s_1{
    		/*background-image: url(<?php echo "'".$_SESSION['twitter_bg_imagen']."'";?>);*/
            background-size: 100% 100%;
            height: auto;
    	}
    	.s_2{
            min-height: auto;
    	}
    	.activo{
		    -webkit-transition-property: margin-left 1s linear 2s;
		    transition-property: margin-left 1s linear 2s;
    	}
        .tabla_partida{
            width:100%;
        }
        .back_twitter{
            width: 100%;
            background-color: rgba(203,225,238,0.5);
            min-height: 400px;
            border-radius: 10px;
            border-color: #ABC7D7;
            border-width: 5px;
            border-style: solid;
            box-shadow: 0px 0px 10px #AFAFAF;
        }
        .panel{
            margin: 10px;
         }
        .datos_twitter{
            height: 100%;
        }
        .twitter-tweet{
            max-height: 800px;
        }
        .imagen_twitter{           
            margin-top: 10px;
            width: 100px;
            height: 100px;
        }
        .particion{
            text-align: center;
            margin:10px;
            min-height: 400px;
        }
        .particion table{
            margin-top: 20px;
        }
        .anuncio{
            display: block;
            margin-bottom: 0px;
            width: 50%;
        }
        .jumbotron{
            margin: 10px;
        }
         p{
            max-width: 50%;
            text-align: justify;
        }
        .icon-rs{
            width: 50px;
            height: 50px;
            margin: 20px;
            -webkit-transition: width 0.5s,height 0.5s;
            -moz-transition: width 0.5s,height 0.5s;
            transition: width 0.5s,height 0.5s;
        }
        .icon-rs:hover{
            width: 75px;
            height: 75px;
        }
        footer{
            width:auto;
            height: 100%;
            position: fixed;
            height: auto;
            bottom: 0px;
            left: 0px;
            right: 0px;
        }
    </style>
    <script type="text/javascript">
    function pulsado(elemento){
        $(".pulsado").removeClass("active pulsado");
        $(elemento).addClass("active pulsado");
    }
    setTimeout(function(){
        $(".cuerpo").fadeIn();
    },2000);
    </script>
</head>
<body class="cuerpo" hidden>
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
	        <li onclick="pulsado(this)" class="active pulsado" data-target="#myCarousel" data-slide-to="0"><a href="#">Mis datos</a></li>
	        <li onclick="pulsado(this)" data-target="#myCarousel" data-slide-to="1"><a href="#">Anuncios</a></li>
	        <li onclick="pulsado(this)" data-target="#myCarousel" data-slide-to="2"><a href="#">¿Cómo funciona?</a></li>
	      </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a <?php if (number_format(floatval($row['saldo']),3)>2){
                echo "href = 'peticion_saldo/'";
                } ?>
            >Saldo: <?php echo number_format(floatval($row['saldo']),3); ?> €</a></li>
            <li><a href="cerrar_sesion">Cerrar sesión</a></li>
          </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

<div class="contenedor">
	<div id="myCarousel" class="carousel slide">
      <!-- Carousel items -->
      <div class="carousel-inner">
        <div class="active item">
        	<div class="seccion s_1" id="s_1">
                <table class="tabla_partida">
                    <tr>
                        <td>
                            <div class="particion">
                                <div class="back_twitter datos_twitter">
                                        <center>
                                        <img class="imagen_twitter" src=<?php echo '"'.$_SESSION['twitter_imagen'].'"'; ?>>
                                        <br>
                                        <div class="panel panel-default">
                                        <?php 
                                            echo $_SESSION['twitter_name'];
                                            echo "<br>";
                                            echo "@".$_SESSION['twitter_screen_name'];
                                            echo "<br><br>";
                                            echo "Siguiendo: ".$_SESSION['twitter_following'];
                                            echo "<br>";
                                            echo "Seguidores: ".$_SESSION['twitter_followers'];
                                            echo "<br><br>";
                                            echo $row['ciudad'];
                                            echo "<br>";
                                            echo $row['pais'];
                                        ?>
                                        </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="particion">
                                <div class="back_twitter">
                                    <center>
                                    <blockquote class="twitter-tweet"><p>
                                    </p>
                                    <a href=<?php echo "'https://twitter.com/".$_SESSION['twitter_screen_name']."/status/".$_SESSION['twitter_last_tweet']."'"; ?> 
                                    data-datetime="2011-11-07T20:21:07+00:00"></a></blockquote>
                                    <script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                                    <div class="panel panel-default">
                                            <div style="text-align: left;margin-left: 30%;">
                                                <b>Nombre: </b> <?php echo " ".$row['nombre'];?><br>
                                                <b>Correo: </b> <?php echo " ".$row['mail']; ?><br>
                                                <b>Anuncios tweeteados: </b> <?php echo " ".$row['publicaciones']; ?>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
			</div>
        </div>
        <div class="item">
        	<div class="seccion s_2" id="s_2">
                <div>
                    <center>
                    <?php
                        $consulta = sprintf("select * from envio_anuncio,Anuncio where envio_anuncio.destino = %s and envio_anuncio.anuncio = Anuncio.id order by Anuncio.id desc"
                            ,$_SESSION['id']);
                        $resultado = $db->query($consulta);
                        if ($resultado->num_rows == 0){
                            echo "<div class='alert alert-warning'>No tienes ningún anuncio para publicar</div>";
                        }
                        while ($row = $resultado->fetch_array()){
                            echo "<br><span class='alert alert-";
                            switch ($row['estado']) {
                                case '0':
                                echo "info";
                                    break;
                                case '1':
                                echo "success";
                                    break;
                                case '2':
                                echo "danger";
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                            echo " anuncio' id='".$row['id']."'><label class='jumbotron'><span style='max-width: 40%;'>".$row['texto']."</span><br><br><span class='label label-info'>"
                            .$row['coste_ind']."€</span></label>";
                            switch ($row['estado']) {
                                case '0':
                                    echo "<a href='publicar/?id=".$row['id']."'><button class='btn btn-success'>✓ Twittear</button></a>
                                   <a href='eliminar/?id=".$row['id']."'><button class='btn btn-danger'>✖ Eliminar</button></a></span>";
                                    break;
                                case '1':
                                     echo "<a href='publicar/?id=".$row['id']."'><button class='btn btn-success'>✓ Twittear</button></a>";
                                    break;
                                case '2':
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                            echo "</span>";
                        }
                    ?>
                </div>
			</div>
        </div>
        <div class="item">
            <div class="seccion s_3" id="s_3">
                <iframe width="640" height="360" src="//www.youtube.com/embed/bEGXn3ddwW4" frameborder="0" allowfullscreen></iframe>
                <h2>¿Alguna duda?</h2>
                <hr>
                <center>
                <p>
                    Si tienes alguna consulta o problema puedes contactar con nosotros a través del correo
                    contacto@publitweet.esy.es , o también por Twitter: <a>@PubliTweetWeb</a>
                </p>
                <h2>PubliTweet en las Redes Sociales</h2>
                <hr>
                    <a href="//twitter.com/PubliTweetWeb"><img src="../resources/iconos/t.png" class="icon-rs"></a>
                    <a href="https://www.facebook.com/profile.php?id=100007629225991&fref=ts"><img src="../resources/iconos/f.png" class="icon-rs"></a>
                    <a href="https://plus.google.com/u/1/109624963523466529519/posts"><img src="../resources/iconos/g.png" class="icon-rs"></a>
                    <a href="https://www.youtube.com/channel/UC6rL_sFi8qH0GAufv3WggGQ"><img src="../resources/iconos/y.png" class="icon-rs"></a>
            </div>
        </div>
      </div>
</div>
</div>
<footer id="banner_inferior">
    <button class="btn btn-default" onclick="$('#banner_inferior').fadeOut('slow',function(){
        $('#banner_inferior').hide();   
    })">X</button>
    <br>
    <iframe src="../resources/banner_inferior/"></iframe>
</footer>
</body>
</html>