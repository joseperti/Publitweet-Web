<?php 
    session_start();
    if ($_SESSION['id']==""){
        header("Location: ../home/");
    }
    $db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
    $consulta = sprintf("SELECT * FROM Anunciante where id = '%s'",$_SESSION['id']);
    $resultado = $db->query($consulta);
    $row = $resultado->fetch_array();
 ?>
<!-- 
    PubliTweet Web Page
    Created by José Pertierra das Neves & Daniel Ávila Fernández
    Copyright 2014 Publitweet
-->
<html>
<head>
    <title>Panel de anunciante - PubliTweet</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="../script/bootstrap.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/icon/favicon.ico">
    <meta charset="utf-8">
    <style type="text/css">
        body{
            font-family: Verdana;
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
            text-align: center;
    	}
    	.s_1{
    		
    	}
    	.s_2{
    		
    	}
        .s_2 .izquierda{
            border: 0px;
            border-right: 1px;
            border-style: solid;
            border-color: #83b5dd;
            border-radius: 1px;
        }
    	.activo{
		    -webkit-transition-property: margin-left 1s linear 2s;
		    transition-property: margin-left 1s linear 2s;
    	}
        .tabla_partida{
            width:100%;
        }
        .back{
            width: 100%;
            background-color: #CBE1EE;
            height: 400px;
            border-radius: 10px;
            border-color: #ABC7D7;
            border-width: 5px;
            border-style: solid;
            box-shadow: 0px 0px 10px #AFAFAF;
        }
        .back table{
            width: 50%;
            margin: 20px;
        }
        .datos-usuario{
            text-align: center;
            width: 70%;
            margin: 20px;
        }
        .imagen{         
            text-align: center;   
            margin-top: 10px;
            width: 200px;
            height: auto;
        }
        .particion{
            text-align: center;
            margin:10px;
        }
        .izquierda{
            float: left;
            width: 50%;
            text-align: center;
        }
        .derecha{
            float: right;
            width: 50%;
            text-align: center;
        }
        .cuadro_twitteros{
            margin-top: 20px;
            margin-bottom: 20px;
            max-height: 200px;
        }
        .twittero{
            width: 100px;
            min-height: 120px;
            margin: 10px;
            display: inline-block;
            -webkit-transition: transform 0.5s; /* For Safari 3.1 to 6.0 */
            transition: transform 0.5s;
            cursor:pointer;
            cursor: hand;
        }
        .datos-twittero{
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }
        .twittero:hover{
            transform:translateY(-15px);
            -ms-transform:translateY(-15px); /* IE 9 */
            -webkit-transform:translateY(-15px); /* Opera, Chrome, and Safari */
        }
        .despegado{
            transform:translateY(-15px);
            -ms-transform:translateY(-15px); /* IE 9 */
            -webkit-transform:translateY(-15px); /* Opera, Chrome, and Safari */
        }
        .anuncio_viejo{
            display: block;
            text-align: left;
        }
        .cuadro-viejas-noticias{
            max-height: 400px;
            width: 100%;
            overflow-y:scroll;
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
    var array_twitteros = [];
    var total_seguidores = 0;
    function pulsado(elemento){
        $(".pulsado").removeClass("active pulsado");
        $(elemento).addClass("active pulsado");
    }
    function buscar_twitteros(){
        $.get("php/buscar_twitteros.php",function(data){
            console.log(data);
            $("#buscar_twitteros").html(data);
            $("#buscar_twitteros").css({"overflow-y":"scroll"});
        });  
    }
    function clase_info(div){
        $(div).removeClass("alert-success");
        $(div).addClass("alert-info");
    }
    function clase_success(div){
        $(div).removeClass("alert-info");
        $(div).addClass("alert-success");
    }
    function seleccionar_twittero(id,seguidores,elemento){
        console.log(array_twitteros);
        array_twitteros.push(id);
        $(elemento).addClass("despegado");
        $(elemento).removeAttr("onmouseover");
        $(elemento).removeAttr("onmouseout");
        $(elemento).removeAttr("onclick");
        $(elemento).attr("onclick","deseleccionar_twittero("+id+","+seguidores+",this)");
        if (seguidores>1000){
            total_seguidores += 1000;
        }else{
            total_seguidores += seguidores;
        }
        actualizar_info();
    }
    function deseleccionar_twittero(id,seguidores,elemento){
        console.log(array_twitteros);
        var index = array_twitteros.indexOf(id);
        if (index > -1) {
            array_twitteros.splice(index, 1);
        }
        $(elemento).removeClass("despegado");
        $(elemento).attr("onmouseover","clase_info(this)");
        $(elemento).attr("onmouseout","clase_success(this)");
        $(elemento).attr("onclick","seleccionar_twittero("+id+","+seguidores+",this)");
        if (seguidores>1000){
            total_seguidores -= 1000;
        }else{
            total_seguidores -= seguidores;
        }
        actualizar_info();
    }
    function actualizar_info(){
        $("#datos_seleccion").html("<table><tr><td>Twitteros: </td><td>"+array_twitteros.length+
            "</td></tr><tr><td>Seguidores: </td><td>"+total_seguidores+"</td></tr></table>");
        $("#total_seguidores").val(total_seguidores);
        $("#total_twitteros").val(array_twitteros.length);
        $("#seleccionados").val(array_twitteros.join());
        precio(0);
    }
    function precio(cantidad){
        if ((cantidad+parseFloat($('#pago').val())).toFixed(3) > 0){
            $('#pago').val((cantidad+parseFloat($('#pago').val())).toFixed(3));
            $('#precio_total').html((parseFloat($('#pago').val()) * parseFloat($('#total_seguidores').val())).toFixed(3) + "€");
        }
    }
    </script>
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
	        <li onclick="pulsado(this)" class="active pulsado" data-target="#myCarousel" data-slide-to="0"><a href="#">Mis datos</a></li>
	        <li onclick="pulsado(this)" data-target="#myCarousel" data-slide-to="1"><a href="#">Anuncios</a></li>
	        <li onclick="pulsado(this)" data-target="#myCarousel" data-slide-to="2"><a href="#">¿Cómo funciona?</a></li>
	      </ul>
          <ul class="nav navbar-nav navbar-right">
            <li title="Recargar saldo"><a href="../pagos">Saldo: <?php echo $row['saldo']; ?> €</a></li>
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
                                <div class="back">
                                    <center>
                                        <img class="imagen" src=<?php echo "'../img_empresa/".$row['id'].".png'"; ?>>
                                        <br><br>
                                        <div class="panel panel-default datos-usuario"><?php echo $row['descripcion']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="particion">
                                <div class="back">
                                    <center>
                                    <div class="panel panel-default datos-usuario">
                                    <center>
                                    <table>
                                        <tr>
                                            <td>
                                                <b>Nombre: </b>
                                            </td>
                                            <td>
                                                <?php echo " ".$row['nombre'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>Correo: </b>
                                            </td>
                                            <td>
                                                <?php echo " ".$row['correo_contacto']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>Contacto:  </b>
                                            </td>
                                            <td>
                                                <?php echo " ".$row['persona_contacto']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>
                                                Teléfono: 
                                            </b></td>
                                            <td>
                                                <?php echo " ".$row['telefono_contacto']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            
                                        </tr>
                                    </table>
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
                <div class="izquierda">
                    <form method="post" action="nuevo_anuncio/index.php" enctype="multipart/form-data">
                        <center>
                        <h2>Crear un anuncio</h2>
                        <hr>
                        <span id="datos_seleccion"></span>
                        <input type="text" name="seleccionados" id="seleccionados" hidden></input>
                        <input type="number" name="cantidad_seguidores" id="total_seguidores" hidden></input>
                        <input type="number" name="cantidad_twitteros" id="total_twitteros" hidden></input>
                        <div id="buscar_twitteros" class="cuadro_twitteros scroll-pane">
                            <span class="btn btn-default" onclick="buscar_twitteros()">
                                Buscar Twitteros
                            </span>
                        </div>
                        Pago x Seguidor del Twittero:
                        <div class="input-group" style="margin:10px;">
                        <center>
                            <input type="text" name="precio" id="pago" class="form-control" value="0.001" readonly>
                            <span class="input-group-addon">€</span>
                            <span class="input-group-addon" onclick="precio(-0.001)" style="cursor:pointer; cursor: hand">-</span>
                            <span class="input-group-addon" onclick="precio(0.001)" style="cursor:pointer; cursor: hand">+</span>
                        </div>
                        Precio Total:
                        <span id="precio_total"></span>
                        <br><br>
                        <input name="texto" type="text" class="form-control" placeholder="Texto del anuncio" maxlength="120">
                        <br>
                        <input type="submit" class="btn btn-primary" value="Crear anuncio">
                    </form>
                </div>
                <div class="derecha">
                <center>
                <h2>Mis anuncios</h2>
                <hr>
                    <?php
                        $consulta = sprintf("select * from Anuncio where anunciante = '%s' order by id desc",$_SESSION['id']);
                        $resultado = $db->query($consulta);
                        if ($resultado->num_rows != 0){
                            echo "<div class='cuadro-viejas-noticias'>";
                        }else{
                            echo "<div class='alert alert-warning'>Aún no has creado ningún anuncio";
                        }
                        while ($row = $resultado->fetch_array()){
                            echo "<span class='alert alert-info anuncio_viejo'>".$row['texto']."<br>".$row['coste']."€ ".$row['fecha_inicio']." - Twitteros: ".$row['twitteros']." .Seguidores: ".$row['seguidores'].
                            " .Twitteado: ".$row['publicaciones']."/".$row['twitteros']."</span>";
                        }
                    ?>
                </div>
                </div>
			</div>
        </div>
        <div class="item">
            <div class="seccion s_3" id="s_3">
                <iframe class="video" width="640" height="360" src="//www.youtube.com/embed/bEGXn3ddwW4" frameborder="0" allowfullscreen></iframe>
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