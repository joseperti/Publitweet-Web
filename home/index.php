<!-- 
    Publitweet Web Page
    Created by José Pertierra Das Neves & Daniel Ávila Fernández
-->

<html>
    <head>
        <title>Publitweet</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="css/home.css" media="all" type="text/css">
        <link rel="stylesheet" href="../bootstrap/bootstrap.css" media="all" type="text/css">
        <link rel="shortcut icon" type="image/x-icon" href="/icon/favicon.ico">
        <script src="../jquery/jquery.js"></script>
        <script src="../bootstrap/bootstrap.js"></script>
        <meta charset="utf-8">
        <style type="text/css">
        .twitter-hashtag{
          margin: 40px;
        }
        .s_1{
          background-image: url("../resources/imagenes/imagen1.jpg");
        }
        .s_2{
          background-image: url("../resources/imagenes/imagen2.jpg");
        }
        .s_3{
          background-image: url("../resources/imagenes/imagen3.jpg");
        }
        .s_4{
          background-image: url("../resources/imagenes/imagen4.jpg");
        }
        .botones_acceso{
          width: 100%;
          background-color: rgba(255,255,255,0.5);
        }
        .btn{
          width: 100px;
          margin: 20px;
        }
        </style>
    </head>

    <body>
        <header>
            <div id="navegacion">
                <div id="menu">
                    <div id="logo">
                        <img class="logo" src="../resources/logo/publitweet300_50.png">
                    </div>
                    
                    <div id="menu_items">
                        <button class="boton" onclick="location.href = '../contacto/'">Contacto</button>
                        <button class="boton" onclick="location.href = '../panel_usuario/login/'">Twitteros</button>
                        <button class="boton" onclick="location.href = '../panel_anunciante/login/'">Anunciantes</button>
                    </div>
                </div>
            </div>
        </header>
            <div id="myCarousel" class="carousel slide">
              <div class="carousel-inner">
                  <!-- Carousel indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>   
                <div class="item active s_1">
                  
                  <div class="container">
                    <div class="carousel-caption">
                      <h1>Bienvenido a PubliTweet, tu portal de publicidad directa en Twitter</h1>
                      <p>
                      <h2>Ahora mismo:<br>
                      Twitteros: <?php 
                          $db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
                          $consulta = sprintf("SELECT * FROM Twittero");
                          $resultado = $db->query($consulta);
                          echo $resultado->num_rows;
                          $consulta = sprintf("SELECT id,SUM(followers) as total_followers FROM Twittero");
                          $resultado = $db->query($consulta);
                          $row = $resultado->fetch_array();
                       ?>
                        Seguidores: <?php echo $row['total_followers']; ?>
                       </h2>
                      <br>
                      <h2 class="inicio" onclick="location.href = '../sobre_publitweet/'" style="cursor:hand;cursor:pointer;">¿Cómo funciona?</h2>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="item s_2">
                  <div class="container">
                    <div class="carousel-caption">
                      <h1>El cliente que imaginas puedes encontrarlo con nosotros</h1>
                      <p class="lead">Todo lo que necesitas es un buen soporte para trasnmitir tu mensaje, con nosotros conseguirás llegar donde quieras
                      <br>
                      <div class="botones_acceso">
                      <h2>¿Quieres participar?</h2><br>
                      <button class="btn btn-primary" onclick="location.href = '../panel_anunciante/registro/'">Regístrate</button><button class="btn btn-primary" onclick="location.href = '../panel_anunciante/login/'">Accede</button>
                      </div></p>
                    </div>
                  </div>
                </div>
                <div class="item s_3">
                  <div class="container">
                    <div class="carousel-caption">
                    <h1>Tenemos la mejor oferta para los twitteros</h1>
                      <p class="lead">Las campañas de nuestros anunciantes van directamente a tu bolsillo, sin intermediarios ni comisiones, lo que es tuyo, es tuyo y punto<br>
                      <div class="botones_acceso">
                      <h2>¿Quieres participar?</h2><br>
                      <button class="btn btn-primary" onclick="location.href = '../panel_usuario/login/'">Regístrate</button><button class="btn btn-primary" onclick="location.href = '../panel_usuario/login/'">Accede</button>
                      </div>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="item s_4">
                  <div class="container">
                    <div class="carousel-caption">
                      <div class="twitter-publitweet">
                        <a class="twitter-timeline"  href="https://twitter.com/PubliTweetWeb"  data-widget-id="482665356893237248">Tweets por @PubliTweetWeb</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                      </div>
                      <h1>Síguenos en las Redes Sociales</h1>
                      <a href="//twitter.com/PubliTweetWeb"><img src="../resources/iconos/t.png" class="icon-rs"></a>
                      <a href="https://www.facebook.com/profile.php?id=100007629225991&fref=ts"><img src="../resources/iconos/f.png" class="icon-rs"></a>
                      <a href="https://plus.google.com/u/1/109624963523466529519/posts"><img src="../resources/iconos/g.png" class="icon-rs"></a>
                      <a href="https://www.youtube.com/channel/UC6rL_sFi8qH0GAufv3WggGQ"><img src="../resources/iconos/y.png" class="icon-rs"></a>  
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </body>
    
    
    <script type="text/javascript">
  	$(document).ready(function(){
  	     $("#myCarousel").carousel({
  	         interval : 10000,
  	         pause: false
  	     });
  	});
	</script>
</html>