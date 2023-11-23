<?php
	@session_start();
    if ($_SESSION['id']==""){
        @header("Location : http://unituit.com/prueba2");
    }
    //Obtenemos los comerciales para insertarlos en el select
	
?>
<!-- Unituit web page
    Created by José Pertierra das Neves
    Daniel Ávila Fernández
    Alex Áviles
-->

<!-- Principio de la pagina -->
<html>
    <!-- Cabecera de la pagina -->
    <head>
        <link rel="StyleSheet" href="../css/empreregis.css" media="all" type="text/css">
        <link rel="StyleSheet" href="../../css/tipografia.css" media="all" type="text/css">
        <script type="text/javascript" src="../../script/userpanel.js"></script>
        <script src="../../script/jquery.js"></script>
        <script src="../../script/userregis.js"></script>
        <script src="../script/formulario_nuevo.js"></script>
        <meta charset="UTF-8"></meta>
        <title>Nuevo usuario</title>
        <script>
            $.get('../php/obtener_comerciales.php',function(data){
                $("#comercial").html(data);
            });
        </script>
       
    </head>
    <!-- Fin de la cabecera -->
     
    <!-- Cuerpo de la pagina -->
    <body onload="empezar()">
        <div id="barrasuperior">
            <div id="bscontenido">
                <img src="../../recursos/logos/logo300_100.png" style="width:200; padding:4">
                <div style="float:right; width:800; height:100%">

                </div>
            </div>
        </div>
        <div id="geo"></div>
        <div id="contenido">
            <center>
                <div style="width:1200; height:800">                 
                    <div id="campinf">
                        <!-- <div id="bar" style="width:100%; height:70">
                            <div style="height:20"></div>
                            <img id="regi" src="../recursos/imagenes/registro_bar.png" style="float:left;width:200" >
                            <img id="info" src="../recursos/imagenes/info_bar.png" style="float:left;width:200; opacity:0.5">
                            <img id="cate" src="../recursos/imagenes/categorias2_bar.png" style="float:left;width:200; opacity:0.5">
                            <img id="term" src="../recursos/imagenes/terminos_bar.png" style="float:left;width:200; opacity:0.5">
                        </div> -->
                        
                        <div id="registro" style="float:left; width:100%; height:600">
                            <div style="width:90%; height:500; border-color: #BBBBBB">
                                <div style="height:150 "></div>
                                <label class="label" style="color:#999999; font-size:100; color: #004682">BIENVENIDO A UNITUIT</label>
                                <center>
                                    <br><br><button class="boton" onclick="comenzar()">Comencemos</button><br>
                                </center>
                            </div>
                            
                        </div>
                        <div id="informacion" style="float:left;width:100%; height:600;background: #FFFFFF;">
                            <div style="width:90%; height:470">
                                <div style="height:50 "></div>
                                    <div style="float:left; width:350; height:400; margin-left:150">
                                        <label class="label" style="color:#999999; float:left;font-size:40; color: #BBBBBB; margin-right:100">Nombre </label>
                                        <div style="height:80"></div>
                                        <label class="label" style="color:#999999; float:left;font-size:40; color: #BBBBBB; margin-right:170">Mail </label>
                                        <div style="height:80"></div>
                                        <label class="label" style="color:#999999; float:left;font-size:40; color: #BBBBBB; margin-right:80">Confirm. mail </label>
                                        <div style="height:80"></div>
                                        <label class="label" style="color:#999999; float:left;font-size:40; color: #BBBBBB; margin-right:80">Provincia </label>
                                        <div style="height:80"></div>
                                        <label class="label" style="color:#999999; float:left;font-size:40; color: #BBBBBB; margin-right:80">Persona de ref.</label>
                                    </div>
                                    <div style="float:left; width:200; height:400; margin-left:100">
                                        <input type="text" class="campos" style="float:left; margin-right:100; width:300" id="nombre">
                                        <div style="height:80"></div>
                                        <input type="text" class="campos" style="float:left; margin-right:100; width:300" id="correo">
                                        <div style="height:80"></div>
                                        <input type="text" class="campos" style="float:left; margin-right:100; width:300" id="confirm_correo">
                                        <div style="height:80"></div>
                                        <select name="provincia" id="provincia">
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
                                        </select>
                                        <div style="height:80"></div>
                                        <div id="comercial"></div>
                                    </div>

                                </div>
                            <div style="float:left; width:100%; height:50">
                                        <button class="boton" onclick="anterior(1)" style="float:left">Anterior</button>  
                                        <button class="boton" onclick="siguiente(1)" style="float:right">Siguiente</button> 
                                    </div>
                        </div>
                        <div id="categorias" style="float:left; width:100%; height:600; background: #FFFFFF"> 
                             <div style="font-family:lanenar; font-size:17; width:700; margin-top:30">Seleccione de 1 a 3 categorías</div>
                            <div style="width:90%; height:440">
                                <table style="font-family:lanenar; font-size:17; width:700; margin-top:30" class="tabla_categorias">
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
                                        <div class="element"  style="height:50"><input type="checkbox" id="noticias" class="check">Noticias, Medios de Comunicación y Publicaciones</input></div>
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
                            </div>

                            <div style="float:left; width:100%; height:50">
                                <button class="boton" onclick="anterior(2)" style="float:left">Anterior</button>  
                                <button class="boton" onclick="siguiente(2)" style="float:right">Siguiente</button> 
                            </div>
                        </div>
                        <div id="politica" style="float:left;width:100%; height:600;background: #FFFFFF">
                            <div style="width:90%; height:470; border-radius: 7; border: 1 solid; border-color: #BBBBBB">
                                <div style="height:10"></div>
                                <label class="label" style="color:#BBBBBB; font-size:50">Condiciones de uso</label>
                                <br>
                                <div style="height:400px;overflow:scroll;text-align:justify">
                                    <h1>TÉRMINOS LEGALES</h1>
                                    <br>
                                    <b>Información sobre aspectos contractuales</b>
                                    <br>
                                    <br>
                                    Nuestro portal también garantiza la solvencia de todo problema en el mínimo plazo posible, siendo responsable de posibles problemas que la actividad informática pueda dar, asumiendo esa responsabilidad de forma que quede solucionada por parte de Unituit.com, pero no se hará responsable del posible “lucro cesante” que puedan tener los usuarios “followers”. Si asumimos la responsabilidad civil que pueda conllevar el incumplimiento de un contrato con los clientes, según establezca el contrato.
                                    <br>
                                    Unituit.com da la posibilidad de ejercer el derecho de acceso, rectificación, cancelación y oposición, en los términos establecidos en la ley vigente. Dirigiéndose a Unituit.com por medio de las distintas vías que disponemos: correo ordinario o por correo electrónico.
                                    <br>
                                    La titularidad de los ficheros de datos personales corresponden a Unituit.com, con sede social a efecto de notificaciones:
                                    <br>
                                    Calle Prudencio Álvaro nº54 Bajo F, 28027 – Madrid
                                    <br>
                                    e-mail de contacto: info@unituit.com
                                    <br>
                                    <br>
                                    Para que el contrato realizado entre Unituit.com y los usuarios tenga vigencia, debe cumplirse el requisito indispensable de la mayoría de edad por parte del usuario, al aceptar estos términos legales comprendemos que lo es, por tanto, no es de nuestra responsabilidad el declarar nulo un contrato con un usuario si descubriésemos que no se está cumpliendo nuestras condiciones de uso.
                                    <br>
                                    Unituit.com se reserva el derecho de poder bloquear la cuenta de un usuario de nuestro portal, si se considerase que el perfil de Twitter de dicho usuario contengan mensajes que atenten contra la libertades y derechos de otras personas (entendiendo como tal mensajes racistas, xenófobos, homófobos…) todo lo que pueda ofender a cualquier persona. Por otro lado, también nos reservamos el derecho a bloquear una cuenta si vemos que el uso que le da no es el oportuno o su perfil de Twitter no es adecuado para la actividad que Unituit.com desarrolla. El precio máximo abonado por tweet para aquellos usuarios  será de 20 euros. La empresa podrá aparte del precio pagado por tweet abonar bonificaciones por criterios de fidelidad o eficacia a los usuarios, el monto de estas bonificaciones será de libre asignación por parte de UNITUIT.COM.
                                    <br>
                                    Unituit.com no se hace responsable de la posibilidad de la veracidad y licitud que tengan los mensajes publicitarios lanzados desde nuestro portal, ya que nosotros solo somos una herramienta publicitaria que no tiene acceso a la veracidad de tal mensaje, dando por hecho que el cliente actúa de buena fe. Al igual que no nos hacemos responsables del contenido negativo que pueda tener un mensaje, ya que nosotros somos una herramienta al servicio del cliente, por tanto, el cliente es el responsable de los contenido del mensaje, ateniéndose a la vigente legislación.
                                    <br>
                                    Finalmente se informa que Unituit.com hace uso de los artículos 55 y 57 de la Ley de Enjuiciamiento Civil, para pactar mediante la aceptación de estos términos que si algún conflicto jurídico civil ocurriese entre usuario/cliente y Unituit.com, el lugar donde debe ser llevado a cabo el juicio sea en los Tribunales de Madrid.
                                    <br>
                                    Los representantes jurídicos que representan a Unituit.com velarán por el cumplimiento de todo lo expuesto en las líneas anteriores. Localizando alguna actividad ilícita, se informa desde aquí que se procederá a llevar a cabo todas las acciones civiles y penales que correspondan.
                                    <br>
                                    <br>

                                    <b>PROPIEDAD INTELECTUAL</b>
                                    <br>
                                    <br>
                                    Todos los elementos que aparezcan en Unituit.com son de la propiedad de Alejandro Avilés Pérez, entendiendo por elementos: el código fuente, los diseños gráficos, las imágenes, las fotografías, los sonidos, las animaciones, el software, los textos, así como la información y los contenidos. Por ello, al ser de propiedad de un sujeto particular no está permitida la reproducción total o parcial de esta web, ni su distribución, ni su tratamiento informático o su difusión sin el permiso previo y por escrito de su titular, Alejandro Avilés Pérez.
                                    <br>
                                    El usuario única y exclusivamente puede utilizar el material que aparezca en este portal para su uso personal y privado, quedando prohibido su uso con fines comerciales o para incurrir en actividades ilícitas. Todos los derechos derivados de la propiedad intelectual están expresamente reservados por Alejandro Avilés Pérez.
                                    <br>
                                    <br>
                                    <b>Términos del contrato:</b>
                                    <br>
                                    <br>
                                    Clausula primera POLÍTICA DE PRIVACIDAD: se entiende que al llevar a cabo la perfección del contrato, ambas partes se comprometen a cumplir las políticas de privacidad expuestas anteriormente demostrando buena fe entre las partes.
                                    <br>
                                    <br>
                                    Clausula segunda RESOLUCIÓN DEL CONTRATO: el incumplimiento de las políticas de privacidad/términos legales dará lugar al incumplimiento del contrato y resolución del mismo. Teniendo capacidad unituit.com de llevar a cabo las acciones legales pertinentes.
                                    <br>
                                    <br>
                                    Clausula tercera CLAUSULA PENAL: todo aquella persona jurídica/física que contrate nuestros servicios no podrá ponerse en contacto con fines publicitarios con los usuarios registrados en nuestra web. Si se concurriera en este supuesto se producirá un incumplimiento de contrato con la resolución del mismo. Además la persona física o jurídica que incumple en contrato deberá abonar a unituit el precio del contrato estipulado.
                                </div><br>
                                <input type="checkbox" id="aceptar">Acepto los Términos y Condiciones</input>
                            </div>
                            <div style="float:left; width:100%; height:50">
                                        <button class="boton" onclick="anterior(3)" style="float:left">Anterior</button>  
                                        <button class="boton" style="float:right" onclick="comprobar()">Siguiente</button> 
                            </div>
                        </div>
                            
                        </div>
                        
                    </div>
            </center>
        </div>
        
        <div id="barrainferior">
            
        </div>
    </body>
    <!-- Fin del cuerpo -->
</html>
<!-- Final de la pagina -->