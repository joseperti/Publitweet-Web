<?php 
@session_start();
require_once '../php/actualizar_monedero.php';
actualizar_monedero();
$datos = $_SESSION['datos'];
$user = $datos->user;
$nombre = $user->screen_name;
$nombre_id = $_SESSION['nombre'];
$correo = $_SESSION['correo'];
$coste = $_SESSION['coste'];
$acumulado = $_SESSION['acumulado'];
$mes = $_SESSION['mes'];
$estado = $_SESSION['estado'];
$fechaCreacion = $_SESSION['fechaCreacion'];
$strikes = $_SESSION['strikes'];
$rechazos = $_SESSION['rechazos'];
$localizacion = $user->location;
$time_zone = $user->time_zone;
$imagen = $user->profile_image_url;
$imagen = str_replace("_normal", "",$imagen);
$back = $user->profile_background_image_url;
$text = $datos->text;
$favs = $user->favourites_count;
$geo = $user->geo_enabled;
$seguidores = $user->followers_count;
$siguiendo = $user->friends_count;
$prop = round($seguidores*100/$siguiendo);
$user = json_encode($user);
$datos = json_encode($datos);
?>

<!-- Pagina Web de Unituit 
    Creadores José Pertierra Das Neves y Daniel Ávila Fernández
-->

<!DOCTYPE html> <!-- Documento html5 -->

<html> <!-- Principio de la pagina -->
    <head> <!-- Cabecera-->
        <title>Panel de usuario</title>
        <link rel="stylesheet" href="../../css/panel_usuario.css"> <!-- css de panel de usuario -->
        <link rel="stylesheet" href="../../css/tipografia.css"> <!-- css de panel de usuario -->
        <script src="../../script/jquery.js"></script>
        <script src="../script/perfil.js"></script>
        <script src="../script/anuncios.js"></script>
        <script src="../script/categorias.js"></script>
        <script src="../../script/panel_usuario.js"></script> <!-- js de panel de usuario -->
        <meta charset="utf-8">
        
        <script>
            var back = "<?php echo $back; ?>";//imagen de fondo del usuario de twitter
            var imagen = "<?php echo $imagen; ?>";//Imagen del usuario de twitter
            var nombre = "<?php echo $nombre; ?>";//nombre del usuario
            if (nombre ==""){
                $(location).attr('href',"http://unituit.com/prueba/error/error.html");
            }
            var localizacion = "<?php echo $localizacion; ?>";
            var time_zone = "<?php echo $time_zone; ?>";
        </script>
        <!--<script type="text/javascript">
        document.oncontextmenu=function() {return false;}
        </script>-->
        <!--Hasta aqui boton derecho deshabilitado y a partir de aqui no deja seleccionar texto-->
        <script language="Javascript" type="text/javascript">
        function disableselect(e){
        return false
        }
        function reEnable(){
        return true
        }
        document.onselectstart=new Function ("return false")
        if (window.sidebar){
        document.onmousedown=disableselect
        document.onclick=reEnable
        }
        </script>
    </head> <!-- Fin de la cabecera-->
        
    <body onload="comenzar()" style=" background:url(<?php echo $back; ?>)no-repeat, center, center fixed; background-size:cover"> <!-- Cuerpo -->
        <div id="cabecera">
            <div id="datoscabecera">
                <div id="logocabecera">
                    <img  class="logo" src="../../recursos/logos/logoazul.png" >
                </div>
            </div>
        </div>
        
        <div id="contenido">
            <div id="informacion">
                <div id="imagen">
                     <img class="userimg" src="<?php echo $imagen; ?>">
                </div>
                <div id="divinfo">
                    <label class="label">@<?php echo $nombre; ?></label><br><br>
                    <label class="label">Siguiendo: </label><label class="label1"><?php echo $siguiendo; ?></label><br><br>
                    <label class="label">Seguidores: </label><label class="label1"><?php echo $seguidores; ?></label><br><br>
                    <label class="label">Ratio: </label><label class="label1"><?php echo $prop/100; ?></label><br><br>
                    <label class="label">Estado: </label><label class="label1">Validado</label>
                    
                </div>
            </div>
            
            <div id="panel">
                <div id="panelmenu">
                    <button id="botanuncios" class="botonpanel" onclick="anuncios()">Anuncios</button>
                    <button id="botcategorias" class="botonpanel" onclick="categorias()">Categorías</button>
                    <button id="botinformacion" class="botonpanel" onclick="informacion()">Información</button>
                    <button id="botcerrarsesion" class="botonpanel" onclick="cerrar_sesion()">Cerrar Sesión</button>
                </div>
                
                <div id="paneldivs">
                
                    <div id="divanuncios">
                       <div id="titulo">
                            Anuncios
                        </div>
                        
                        <div id="anuncios_posibles" style="height:100%; overflow:scroll" >
                            
                        </div>
                    </div>
                    <div id="informacion_anuncio">
                            <div id="titulo">
                                Información de anuncio
                            </div>
                            <div id="mostrar_anuncio" style="height:100%; overflow:scroll" >

                            </div>
                    </div>
                    
                    <div id="divcategorias">
                        <table class="tabla_categorias">
                                <tr>
                                    <td>
                                        <div class="element"><input type="checkbox" id="aficiones" class="check" >Aficiones y Tiempo Libre</input></div>
                                    </td>
                                    <td>
                                        <div class="element"><input type="checkbox" id="arte" class="check">Arte y Entretenimiento</input></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="element"><input type="checkbox" id="belleza" class="check">Belleza y Cuidados Personales</input></div>
                                    </td>
                                    <td>
                                        <div class="element"><input type="checkbox" id="casa" class="check">Casa y Jardín</input></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="element"><input type="checkbox" id="deportes" class="check">Deportes y Fitness</input></div>
                                    </td>
                                    <td>
                                        <div class="element"><input type="checkbox" id="empleo" class="check">Empleo y Educación</input></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="element"><input type="checkbox" id="empresas" class="check">Empresas e Industrias</input></div>
                                    </td>
                                    <td>
                                        <div class="element"><input type="checkbox" id="familia" class="check">Familia y Comunidad</input></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="element"><input type="checkbox" id="finanzas" class="check">Finanzas</input></div>
                                    </td>
                                    <td>
                                        <div class="element"><input type="checkbox" id="moda" class="check">Moda</input></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="element"><input type="checkbox" id="internet" class="check">Internet y Telecomunicaciones</input></div>
                                    </td>
                                    <td>
                                        <div class="element"><input type="checkbox" id="ley" class="check">Ley y Gobierno</input></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="element"><input type="checkbox" id="mercado" class="check">Mercado Inmobiliario</input></div>
                                    </td>
                                    <td>
                                        <div class="element"  style="height:50"><input type="checkbox" id="noticias" class="check">Noticias, Medios de Comunicación...</input></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="element"><input type="checkbox" id="ordenadores" class="check">Ordenadores y Electródomesticos</input></div>
                                    </td>
                                    <td>
                                        <div class="element"><input type="checkbox" id="restaurantes" class="check">Restaurantes y Vida Nocturna</input></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="element"><input type="checkbox" id="salud" class="check">Salud</input></div>
                                    </td>
                                    <td>
                                        <div class="element"><input type="checkbox" id="motor" class="check">Motor</input></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="element"><input type="checkbox" id="viajes" class="check">Viajes y Turismo</input></div>
                                    </td>
                                    <td>
                                        <div class="element"><input type="checkbox" id="videojuegos" class="check">Videojuegos</input></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="element"><input type="checkbox" id="otros" class="check">Otros</input></div>
                                    </td>
                                </tr>
                            </table>
                            <br>
                        <button class="actualizar" onclick="guardar_categorias()"> ACTUALIZAR</button>
                    </div>
                    
                    <div id="divinformacion">
                        <label class="label">Ganancias acumuladas: </label><br><label class="label1"><?php echo $acumulado; ?>€ <button onclick="window.open('../../pago/','_blank')">Exportar dinero</button></label><br><br>
                        <label class="label">Último tweet: </label><br><label class="label1"><?php echo $text; ?></label><br><br>
                        <label class="label">Fecha de registro: </label><br><label class="label1"><?php echo $fechaCreacion; ?></label><br><br>
                        <label class="label">Strikes: </label><br><label class="label1"><?php echo $strikes; ?></label><br><br>
                        <label class="label">Rechazos: </label><br><label class="label1"><?php echo $rechazos; ?></label><br><br>
                    </div>
                
                </div>
            </div>
        </div>
    </body> <!-- Fin del cuerpo -->
</html> <!-- Fin de la pagina -->