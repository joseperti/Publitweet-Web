function obtener_captcha(){
	$("#captcha").html("Cargando...");
	$.get('captcha/aleatorio.php',function(data){
		var datos = $.parseJSON(data);
		$("#captcha").html("<img id='imgc' src='captcha/"+datos.imagen+"' value='"+datos.id+"'></img>");
	});
}

function contacto(){
	var mensaje = $("#mensaje").val();
	var email = $("#email").val();
	var destino = $("#destino").val();
	var captchaval = $("#valorcaptcha").val();
	if ((mensaje!="") && (email!="") && (captchaval!="")){
		console.log($("#imgc").attr('value'));
	    $.post('php/contacto.php',{destino:destino,mensaje:mensaje,email:email,
	    captchaval:captchaval,captchaid:$("#imgc").attr('value')},function(data){
	    	if (data=="00"){
	    		obtener_captcha();
	    		alert("Error en el captcha");
	    	}else{
	        	alert(data);
	        	location.href="../";
	    	}
	    });
	}else{
		$("#enviado").text("Rellene todos los campos");
	}
}