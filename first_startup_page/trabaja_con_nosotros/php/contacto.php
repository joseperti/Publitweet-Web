<?php
	$codigos = ["28ivw","k4ez","FH2DE","gwprp","e5hb","q98p","XDHYN"];
	$valorc = $_POST['captchaval'];
	$idc = $_POST['captchaid'];
	$codigo = $codigos[((int) $idc)-1];
	if ($valorc != $codigo){
		die("00");//Error en el captcha , recargaremos uno nuevo
	}
	$mensaje = $_POST['mensaje'];
	$destino = $_POST['destino'];
	$email = $_POST['email'];
	$titulo = "Mensaje de Trabaja con Nosotros de Unituit: ".$email;
	$cuerpo = $email."\n".$mensaje."\nFecha: ".date("Y-d-m H:i:s");
	mail("rrhh@unituit.com",$titulo,$cuerpo) or die("No se ha podido enviar el mensaje");
	echo "Mensaje enviado";
?>