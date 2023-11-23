 <!-- Pagina Web de unituit 
    Creadores José Pertierra Das Neves y Daniel Ávila Fernández
-->

<?php
	@session_start();
    $cif = $_SESSION['cif'];
    $nombre = $_SESSION['nombre'];
    if ($nombre ==""){
        @header("Location : http://unituit.com/prueba2");
    }
    $provincia = $_SESSION['provincia'];
    $email = $_SESSION['email'];
    $telefono = $_SESSION['telefono'];
    $apellidos = $_SESSION['apellidos'];
    $usuario = $_SESSION['user'];
    $imagen = '<img style="margin-top:20" src="'.$_SESSION['imagen'].'" width=200 height=200 ></img>';
?>


<!DOCTYPE html> <!-- Documento html5 -->

<html> <!-- Principio de la pagina -->
    <head> <!-- Cabecera-->
        <title>Panel de usuario</title>
        <link rel="stylesheet" href="../../css/panel_empresa.css"> <!-- css de panel de usuario -->
        <link rel="stylesheet" href="../../css/tipografia.css"> <!-- css de panel de usuario -->
        <script src="../scripts/jquery.js"></script>
		<script src="../scripts/jquery.flot.js"></script>
		<script src="../scripts/jquery.urlshortener.js" type="text/javascript"></script>
		<script src="../scripts/efectos.js"></script>
		<script src="../scripts/perfil.js"></script>
		<script src="../scripts/anunciate.js"></script>
        <script src="../../script/panel_empresa.js"></script> <!-- js de panel de usuario -->
        <meta charset="utf-8">
       
    </head> <!-- Fin de la cabecera-->
        
    <body onload="comenzar()"> <!-- Cuerpo -->
        <div id="cabecera">
            <div id="cabeceramovil">
                <div id="datoscabecera">
                    <div id="divlogo">
                        <img class="logo" src="../../recursos/logos/logoazul.png" onclick="main()"></img>
                        <!--<div class="info"> 
                        <a href="../../contacto/"> Contacto </a> - <a href="../../faqs/" > FAQs </a> - <a href="../../trabaja_con_nosotros/"> Trabaja con nosotros </a>
                         - <a href="../../politicas/"> Políticas de privacidad </a>
                        </div>
                        <div id="divsocial">
                            <img class="social" src="../../recursos/social/facebookicon.png" onclick="irafacebook()">
                            <img class="social" src="../../recursos/social/twittericon.png" onclick="iratwitter()">
                            <img class="social" src="../../recursos/social/mailicon.png" onclick="iramail()">
                        </div> -->
                    </div>    
                </div>
            </div>
        </div>
        
        <div id="contenido">
            <div id="informacion">
                <div id="imagen">
                    <?php echo $imagen; ?>
                </div>
                <div id="divinfo">
                    <label class="label"> <?php echo $nombre; ?> </label><br>
                    <label class="label"> <?php echo $provincia; ?> </label><br>
                </div>
            </div>
            
            <div id="panel">
                <div id="panelmenu">
                    <button id="botcategorias" class="botonpanel" onclick="anunciate()">Anunciate</button>
                    <button id="botanuncios" class="botonpanel" onclick="anuncios()">Estadísticas</button>
                    <button id="botinformacion" class="botonpanel" onclick="informacion()">Información</button>
                    <button id="botcerrarsesion" class="botonpanel" onclick="cerrar_sesion()">Cerrar Sesión</button>
                </div>
                
                <div id="paneldivs">
                    <div id="divanuncios">
                       <div id="titulo">
                            Anuncios
                        </div>
                        
                        <div id="mis_anuncios" style="height:100%; overflow:scroll" >
                                   
                        </div>                        
                        
                    </div>
                    
                    <div id="divanunciate">
                        <div id="nuevoanuncio">
                            <br><br><br><br><br><br><br><br><br><br><br><br>
                            <button class="nuevo" onclick="nuevo()">NUEVO ANUNCIO</button>
                        </div>
                        
                        <div id="categorias">
                            Selecciona la categoría de tu anuncio<br><br>
                            <select id="anunciocategoria" onchange="datos_categoria()">
                                <option value="1" selected>Aficiones y tiempo libre</option>
                                <option value="2">Arte y entretenimiento</option>
                                <option value="3">Belleza y cuidados personales</option>
                                <option value="4">Casa y jardín</option>
                                <option value="5">Deportes y fitness</option>
                                <option value="6">Empleo y educación</option>
                                <option value="7">Empresas e industrias</option>
                                <option value="8">Familia y comunidad</option>
                                <option value="9">Finanzas</option>
                                <option value="10">Moda</option>
                                <option value="11">Internet y telecomunicaciones</option>
                                <option value="12">Ley y Gobierno</option>
                                <option value="13">Mercado inmobiliario</option>
                                <option value="14">Noticias,medios de comunicación y publicidad</option>
                                <option value="15">Ordenadores y electrodomésticos</option>
                                <option value="16">Restaurantes y vida nocturna</option>
                                <option value="17">Salud</option>
                                <option value="18">Motor</option>
                                <option value="19">Viajes y Turismo</option>
                                <option value="20">Videojuegos</option>
                                <option value="21">Otros</option>
                            </select><br>
                            <br><br>
                            Seleccione una provincia: <br><br>
                            <select name="provincia" id="provincia" onchange="datos_categoria()">
                                <option value='0'>(Seleccionar)</option>
                                <option value='Álava'>Álava</option>
                                <option value='Albacete'>Albacete</option>
                                <option value='Alicante/Alacant'>Alicante/Alacant</option>
                                <option value='Almería'>Almería</option>
                                <option value='Asturias'>Asturias</option>
                                <option value='Ávila'>Ávila</option>
                                <option value='Badajoz'>Badajoz</option>
                                <option value='Barcelona'>Barcelona</option>
                                <option value='Burgos'>Burgos</option>
                                <option value='Cáceres'>Cáceres</option>
                                <option value='Cádiz'>Cádiz</option>
                                <option value='Cantabria'>Cantabria</option>
                                <option value='Castellón/Castelló'>Castellón/Castelló</option>
                                <option value='Ceuta'>Ceuta</option>
                                <option value='Ciudad Real'>Ciudad Real</option>
                                <option value='Córdoba'>Córdoba</option>
                                <option value='Cuenca'>Cuenca</option>
                                <option value='Girona'>Girona</option>
                                <option value='Las Palmas'>Las Palmas</option>
                                <option value='Granada'>Granada</option>
                                <option value='Guadalajara'>Guadalajara</option>
                                <option value='Guipúzcoa'>Guipúzcoa</option>
                                <option value='Huelva'>Huelva</option>
                                <option value='Huesca'>Huesca</option>
                                <option value='Illes Balears'>Illes Balears</option>
                                <option value='Jaén'>Jaén</option>
                                <option value='A Coruña'>A Coruña</option>
                                <option value='La Rioja'>La Rioja</option>
                                <option value='León'>León</option>
                                <option value='Lleida'>Lleida</option>
                                <option value='Lugo'>Lugo</option>
                                <option value='Madrid'>Madrid</option>
                                <option value='Málaga'>Málaga</option>
                                <option value='Melilla'>Melilla</option>
                                <option value='Murcia'>Murcia</option>
                                <option value='Navarra'>Navarra</option>
                                <option value='Ourense'>Ourense</option>
                                <option value='Palencia'>Palencia</option>
                                <option value='Pontevedra'>Pontevedra</option>
                                <option value='Salamanca'>Salamanca</option>
                                <option value='Santa Cruz de Tenerife'>Santa Cruz de Tenerife</option>
                                <option value='Segovia'>Segovia</option>
                                <option value='Sevilla'>Sevilla</option>
                                <option value='Soria'>Soria</option>
                                <option value='Tarragona'>Tarragona</option>
                                <option value='Teruel'>Teruel</option>
                                <option value='Teruel'>Teruel</option>
                                <option value='Toledo'>Toledo</option>
                                <option value='Valencia/Valéncia'>Valencia/Valéncia</option>
                                <option value='Valladolid'>Valladolid</option>
                                <option value='Vizcaya'>Vizcaya</option>
                                <option value='Zamora'>Zamora</option>
                                <option value='Zaragoza'>Zaragoza</option>
                            </select><br><br>
                            <div id="datos_categoria_provincia"></div><br><br>
                            <button class="nuevo" onclick="info_producto()">Continuar</button>
                        </div>

                        <div id="infoproducto">
                            <CENTER>
                            <span class="label">Describe tu producto</span><br><br>
                            <textarea id="texto_producto" class="mensaje" maxlength="300" placeholder="Escribe aquí tu mensaje"></textarea><br><br>
                            <button class="nuevo" onclick="nuevo()" >Atrás</button>
                            <button class="nuevo" onclick="tipo()" >Continuar</button>
                        </div>

                        <div id="tipoanuncio">
                            ¿Qué tipo de anuncio quieres publicar?<br><br>
                            <button class="nuevo" onclick="textual_block()">Textual</button>
                            <button class="nuevo" onclick="visual_block()" >Visual</button>
                            <br>
                            <br>Escribe la url a tu producto: <input type="text" id="url"></input><button onclick="acortar_url($('#url').val())">Procesar</button><br>
                            <b>Preview del Tweet:</b><br>
                            <CENTER>
                            <div id="tweet_preview" style="width:500px">
                            </div>
                            </CENTER>
                            <br><br>
                            <textarea id="texto" class="mensaje" maxlength="120" placeholder="Escribe aquí tu mensaje" onkeyup="actualizar_preview()" hidden></textarea><br><br>
                            <div id="visual">
                                    Sube tu imagen. Consejo: mayor que 500x500 px y jpg o png.
                                    <br>
                                    <input type="file" name="archivo_anuncio" id="imagenanuncio"></input>
                                    <br>
                                    <br>
                                    <!-- Enviar visual -->
                                <!-- Fin Anuncio de tipo visual -->
                            </div>
                            <!-- URL del producto -->
                            <!-- Fin URL del producto -->
                            <button class="nuevo" onclick="info_producto()" >Atrás</button>
                            <button class="nuevo" onclick="twitteros()" >Continuar</button>
                        </div>

                        <div id="twitteros">
                            ¿Quienes lo publicarán?<br><br>
                            <button class="nuevo" onclick="elegir_twittero()">Seleccionar a los twitteros</button>
                            <button class="nuevo" onclick="seleccion_aut()">Selección automática</button>
                            <br>
                            <br>
                            <div id="paypal_visual" style="display: none;">
                             Anuncios de tipo Visual: <br><br>
                                <select onchange="pago_automatico(this)">
                                    <option  value="10000" >10.000 Seguidores €18,75 EUR</option>
                                    <option  value="20000" >20.000 Seguidores €37,5 EUR</option>
                                    <option  value="30000" >30.000 Seguidores €56,25 EUR</option>
                                    <option  value="50000" >50.000 Seguidores €93,75 EUR</option>
                                    <option  value="75000" >75.000 Seguidores €140,63 EUR</option>
                                    <option  value="100000">100.000 Seguidores €187,5 EUR</option>
                                    <option  value="200000">200.000 Seguidores €375,00 EUR</option>
                                    <option  value="300000">300.000 Seguidores €562,5 EUR</option>
                                    <option  value="500000">500.000 Seguidores €937,5 EUR</option>
                                    <option  value="750000">750.000 Seguidores €1.406,25 EUR</option>
                                    <option value="1000000">1.000.000 Seguidores €1.875 EUR</option>
                                    <option value="2000000">2.000.000 Seguidores €3.750 EUR</option>
                                    <option value="3000000">3.000.000 Seguidores €5.625 EUR</option>
                                    <option value="4000000">4.000.000 Seguidores €7.500 EUR</option>
                                </select>
                            </div>
                            <div id="paypal_textual" style="display: none;">
                                Anuncios de tipo Textual: <br><br>
                                <select onchange="pago_automatico(this)">
                                    <option value="10000" >10.000 Seguidores €12,50 EUR</option>
                                    <option value="20000" >20.000 Seguidores €25,00 EUR</option>
                                    <option value="30000" >30.000 Seguidores €37,50 EUR</option>
                                    <option value="50000" >50.000 Seguidores €62,50 EUR</option>
                                    <option value="75000" >75.000 Seguidores €93,75 EUR</option>
                                    <option value="100000" >100.000 Seguidores €125,00 EUR</option>
                                    <option value="200000" >200.000 Seguidores €250,00 EUR</option>
                                    <option value="300000" >300.000 Seguidores €375,00 EUR</option>
                                    <option value="500000" >500.000 Seguidores €625,00 EUR</option>
                                    <option value="750000" >750.000 Seguidores €937,50 EUR</option>
                                    <option value="1000000">1.000.000 Seguidores €1.250 EUR</option>
                                    <option value="2000000">2.000.000 Seguidores €2.500 EUR</option>
                                    <option value="3000000">3.000.000 Seguidores €3.750 EUR</option>
                                    <option value="4000000">4.000.000 Seguidores €5.000 EUR</option>
                                    <option value="5000000">5.000.000 Seguidores €6.250 EUR</option>
                                    <option value="6000000">6.000.000 Seguidores €7.500 EUR</option>
                                </select></td></tr>
                            </div>
                            <br>
                            <CENTER>
                            <div id="clientes" style="height:300px;overflow:scroll;display:none">

                            </div>
                            <br>
                            <div id="coste_anuncio"></div>
                            <br><button class="nuevo" onclick="tipo()" >Atrás</button>
                            <button class="nuevo" onclick="resumen()" >Continuar</button>
                        </div>

                        <div id="resumen">
                            <br><br>
                            <label class="label">RESUMEN</label><br><br>
                            <label class="nombre">CATEGORÍA DEL ANUNCIO: </label><button class="editar" onclick="nuevo()">Editar</button><label class="respuesta" id="resumen_categoria">CATEGORIA </label><br><br>
                            <label class="nombre">PROVINCIA DEL ANUNCIO: </label><button class="editar" onclick="nuevo()">Editar</button><label class="respuesta" id="resumen_provincia">Provincia </label><br><br>
                            <label class="nombre">TIPO DE ANUNCIO: </label><button class="editar" onclick="tipo()">Editar</button><label class="respuesta" id="resumen_tipo">TIPO </label><br><br>
                            <label class="nombre">MENSAJE: </label><br><button class="editar" onclick="tipo()">Editar</button><label class="respuesta" id="resumen_mensaje">MENSAJE </label><br><br>
                            <label class="nombre">IMAGEN: </label><button class="editar" onclick="tipo()">Editar</button><label class="respuesta"  id="resumen_imagen">NO </label><br><br>
                            <label class="nombre">SELECCIÓN DE TWITTEROS: </label><button class="editar" onclick="twitteros()">Editar</button><label class="respuesta" id="resumen_twitteros"> </label><br><br><br>
                            <br><button class="nuevo" onclick="twitteros()" >Atrás</button>
                            <button id="envio_textual" class="nuevo" onclick="pagar('textual')" hidden>Guardar y pagar anuncio textual</button>
                            <button id="envio_visual" class="nuevo" onclick="pagar('visual')" hidden>Guardar y pagar anuncio visual</button>
                        </div>
                        <div id="pagar">
                            <CENTER>
                            <div id="pago_visual" class="label">
                                Anuncios de tipo Visual:
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="N3AWBKHRZVUW6">
                                    <table>
                                    <tr><td><input type="hidden" name="on0" value="Hasta 750.000 Seguidores">Hasta 750.000 Seguidores</td></tr><tr><td><select name="os0">
                                    <option value="10.000 Seguidores">10.000 Seguidores €18,75 EUR</option>
                                    <option value="20.000 Seguidores">20.000 Seguidores €37,50 EUR</option>
                                    <option value="30.000 Seguidores">30.000 Seguidores €56,25 EUR</option>
                                    <option value="50.000 Seguidores">50.000 Seguidores €93,75 EUR</option>
                                    <option value="75.000 Seguidores">75.000 Seguidores €140,63 EUR</option>
                                    <option value="100.000 Seguidores">100.000 Seguidores €187,50 EUR</option>
                                    <option value="200.000 Seguidores">200.000 Seguidores €375,00 EUR</option>
                                    <option value="300.000 Seguidores">300.000 Seguidores €562,50 EUR</option>
                                    <option value="500.000 Seguidores">500.000 Seguidores €937,50 EUR</option>
                                    <option value="750.000 Seguidores">750.000 Seguidores €1.406,25 EUR</option>
                                    </select> </td></tr>
                                    </table>
                                    <input type="hidden" name="currency_code" value="EUR">
                                    <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
                                    </form> 
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="Z57DAQ4J76M54">
                                    <table>
                                    <tr><td><input type="hidden" name="on0" value="A partir de 1.000.000 Seguidores">A partir de 1.000.000 Seguidores</td></tr><tr><td><select name="os0">
                                    <option value="1.000.000 Seguidores">1.000.000 Seguidores €1.875,00 EUR</option>
                                    <option value="2.000.000 Seguidores">2.000.000 Seguidores €3.750,00 EUR</option>
                                    <option value="3.000.000 Seguidores">3.000.000 Seguidores €5.625,00 EUR</option>
                                    <option value="4.000.000 Seguidores">4.000.000 Seguidores €7.500,00 EUR</option>
                                    </select> </td></tr>
                                    </table>
                                    <input type="hidden" name="currency_code" value="EUR">
                                    <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
                                </form>

                            </div>
                            <div id="pago_textual" class="label">
                                Anuncios de tipo Textual:
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="R9FZAHXFQVNA4">
                                    <table>
                                    <tr><td><input type="hidden" name="on0" value="Precio de un anuncio(Hasta 750.000 Seguidores)">Precio de un anuncio (Hasta 750.000 Seguidores)</td></tr><tr><td><select name="os0">
                                    <option value="10.000 Seguidores">10.000 Seguidores €12,50 EUR</option>
                                    <option value="20.000 Seguidores">20.000 Seguidores €25,00 EUR</option>
                                            <option value="30.000 Seguidores">30.000 Seguidores €37,50 EUR</option>
                                    <option value="50.000 Seguidores">50.000 Seguidores €62,50 EUR</option>
                                    <option value="75.000 Seguidores">75.000 Seguidores €93,75 EUR</option>
                                            <option value="100.000 Seguidores">100.000 Seguidores €125,00 EUR</option>
                                    <option value="200.000 Seguidores">200.000 Seguidores €250,00 EUR</option>
                                    <option value="300.000 Seguidores">300.000 Seguidores €375,00 EUR</option>
                                    <option value="500.000 Seguidores">500.000 Seguidores €625,00 EUR</option>
                                    <option value="750.000 Seguidores">750.000 Seguidores €937,50 EUR</option>
                                    </select> </td></tr>
                                    </table>
                                    <input type="hidden" name="currency_code" value="EUR">
                                    <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
                                </form>
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="CJPC9WUR7WHTC">
                                    <table>
                                    <tr><td><input type="hidden" name="on0" value="A partir de 1.000.000 Seguidores">A partir de 1.000.000 Seguidores</td></tr><tr><td><select name="os0">
                                    <option value="1.000.000 Seguidores">1.000.000 Seguidores €1.250,00 EUR</option>
                                    <option value="2.000.000 Seguidores">2.000.000 Seguidores €2.500,00 EUR</option>
                                    <option value="3.000.000 Seguidores">3.000.000 Seguidores €3.750,00 EUR</option>
                                    <option value="4.000.000 Seguidores">4.000.000 Seguidores €5.000,00 EUR</option>
                                    <option value="5.000.000 Seguidores">5.000.000 Seguidores €6.250,00 EUR</option>
                                    <option value="6.000.000 Seguidores">6.000.000 Seguidores €7.500,00 EUR</option>
                                    <option value="7.000.000 Seguidores">7.000.000 Seguidores €8.000,00 EUR</option>
                                    </select> </td></tr>
                                    </table>
                                    <input type="hidden" name="currency_code" value="EUR">
                                    <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
                                </form>
                            </div>
                            <!-- Botones de pago -->

                        </div>
                    </div>
                    
                    <div id="divinformacion">
                        <div id="empresadatos">
                            <label class="label">Nombre: </label><br><br>
                            <label class="label">Apellidos: </label><br><br>
                            <label class="label">Mail: </label><br><br>
                            <label class="label">CIF/NIF/PASAPORTE: </label><br><br>
                            <label class="label">Teléfono: </label><br><br>
                            <label class="label">ID Usuario: </label><br><br>
                            <label class="label">Provincia: </label><br><br>
                            <label class="label"> Cambiar imagen de Empresa: </label><br><br>      
                        </div>
                        
                        <div id="empresasol">
                            <label class="label1"><?php echo $nombre; ?></label>
                            <div id="divisor"></div>
                            <label class="label1"><?php echo $apellidos; ?></label>
                            <div id="divisor"></div>
                            <label class="label1"><?php echo $email; ?> </label>
                            <div id="divisor"></div>
                            <label class="label1"><?php echo $cif; ?></label>
                            <div id="divisor"></div>
                            <label class="label1"><?php echo $telefono; ?></label>
                            <div id="divisor"></div>
                            <label class="label1"><?php echo $usuario; ?></label>
                            <div id="divisor"></div>
                            <label class="label1"><?php echo $provincia ; ?></label>
                            <div id="divisor"></div>
                            <label class="label"><input type="file" id="imagen_perfil_nueva"></input></label><button onclick="cambiar_imagen()">Procesar</button>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </body> <!-- Fin del cuerpo -->
</html> <!-- Fin de la pagina -->