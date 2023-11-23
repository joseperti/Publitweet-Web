<!-- Unituit.com
    Creado por José Pertierra das Neves
    y Daniel Ávila Fernández-->

<?php

    $usuario = $_SESSION['id'];
    $nombre = $_SESSION['datos']->user->screen_name;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Unituit</title>
        <link rel="stylesheet" href="../css/contacto.css" media="all" type="text/css">
        <link rel="stylesheet" href="../css/tipografia.css" media="all" type="text/css">
        <script  type="text/javascript" src="../script/main.js"></script>
        <script src="../script/jquery.js"></script>
        <script>
        function enviar(){
            $.post('../php/pago.php',{email:$("#email").val()},function(data){
                alert(data);
            });
        }
        </script>
        <meta charset="utf8">
    </head>

    <body onload="obtener_captcha()">
        
        <div id="cabecera"> <!-- Barra de menu -->     
            <div id="cabeceramovil">
                <div id="datoscabecera">
                    <div id="divlogo">
                        <img class="logo" src="../recursos/logos/logoazul.png" onclick="main()">
                    </div>
                    <div id="divsocial">
                        <img class="social" src="../recursos/social/facebookicon.png" onclick="irafacebook()">
                        <img class="social" src="../recursos/social/twittericon.png" onclick="iratwitter()">
                        <img class="social" src="../recursos/social/mailicon.png" onclick="location.href = '../contacto/'">
                    </div>     
                    <div class="info"> 
                    <a href="../index/"> Pagina Principal </a> - <a href="../contacto/"> Contacto </a> - <a href="../faqs/" > FAQs </a> <!--- <a href="../trabaja_con_nosotros/"> Trabaja con nosotros </a>-->
                     - <a href="../politicas/"> Políticas de privacidad </a>
                    </div>
                </div> 
            </div>
        </div> <!-- Fin de la barra-->
        
        <div id="contenido">
            <div id="divisor"></div>
            <?php echo $nombre; ?> quiere retirar su dinero
            <div id="divisor"></div>
            <div id="contacto"><br>
                Tu cuenta de Paypal 
                <input class="texto" type="text" placeholder="Paypal" id="email"><br><br>
                ¿Cuánto dinero quieres retirar? (Mín. 10€) <input class="texto" type="numeric" id="dinero"><br><br>
                <br>
            </div>
        </div>
        <div id="footer">
        
        </div>
    </body>
</html>