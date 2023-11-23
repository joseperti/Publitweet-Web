//Vaciamos los clientes
var array_clientes = [];
var coste_total = 0;
var link = "";
var opcion_tipo ="";
//Reiniciamos los bloques de tipos de anuncios
function ocultar_modelos(){
	$("#textual").hide();
	$("#visual").hide();
	$("#envio_visual").hide();
	$("#envio_textual").hide();
}

function actualizar_preview(){
	var preview = $("#texto").val() +" " +link +" #publi";
	$("#tweet_preview").html(preview+"<br> Caracteres: "+preview.length);
	$('#resumen_mensaje').html(preview);
}

$(document).ready(function(){
	ocultar_modelos();
});

function visual_block(){
	var array_clientes = [];
	var coste_total = 0;
	var link = "";
	ocultar_modelos();
	opcion_tipo = "visual";
	$("#texto").show();
	$("#visual").show();
	$("#envio_visual").show();
	$("#pago_visual").show();
	$("#pago_textual").hide();
	$('#resumen_imagen').html("Sí");
	$("#resumen_tipo").html("Visual");
	$("#texto").prop('maxlength','60');
}

function textual_block(){
	var array_clientes = [];
	var coste_total = 0;
	var link = "";
	ocultar_modelos();
	opcion_tipo = "textual";
	$("#texto").show();
	$("#envio_textual").show();
	$("#pago_visual").hide();
	$("#pago_textual").show();
	$('#resumen_imagen').html("No");
	$("#resumen_tipo").html("Textual");
	$("#texto").prop('maxlength','90');
}

function vaciar_clientes(){
	array_clientes = [];
	coste_total = 0;
	$("#coste_anuncio").html("");
}

function elegir_twittero(){
	$("resumen_twitteros").html("Manual");
	vaciar_clientes();
	$("#clientes").show();
	$("#paypal_visual").hide();
	$("#paypal_textual").hide();
	//Cuando elija esta opcion se rebuscarán cuando se vaya cambiando de categorias
	$("#anunciocategoria").change(function(){
		datos_categoria();
		vaciar_clientes();
		elegir_twittero();
	});
	var provincia = $("#provincia").prop('value');
	var categoria =$("#anunciocategoria").prop('value');
	$("#clientes").html("Cargando usuarios de Unituit");
	//Obtenemos todos los usuarios de la categoria elegida
	$.post('../php/obtener_usuarios.php',{categoria:categoria,provincia:provincia},function(data){
		$("#clientes").html(data);
	});

}

function sumar_cliente(cliente){
	var pos = array_clientes.indexOf($(cliente).prop('name'))
	if (pos != -1){
		$(cliente).css({"background-color":"white"});
		var coste = parseInt($(cliente).prop('value'));
		coste_total -= coste;
		array_clientes.splice(pos,1);
	}else{
		$(cliente).css({"background-color":"red"});
		var coste = parseInt($(cliente).prop('value'));
		coste_total += coste;
		array_clientes.push($(cliente).prop('name'));
	}
	aproximacion_pago(coste_total);
}

function enviar_textual(){
	console.log($("#texto").val());
	if ($("#texto").val().length>0){
		$.post("../php/enviar_textual.php",{clientes:array_clientes,categoria:$("#anunciocategoria").prop('value'),mensaje:$("#texto").val(),link:link,coste:coste_total,
		texto_producto:$("#texto_producto").val()},
			function(data){
				alert(data);
				//location.reload(true);
			});
	}else{
		alert("Rellene el campo del mensaje a enviar");
	}
	
}

function enviar_visual(){
	var archivo = $("#imagenanuncio")[0].files[0];
	var datos = new FormData();
	datos.append('file',archivo);
	$("#resultado_visual").html("Cargando archivo. Espere a que termine");
	$.post("../php/enviar_visual.php",{clientes:array_clientes,categoria:$("#anunciocategoria").prop('value'),mensaje:$("#texto").val(),link:link,coste:coste_total,texto_producto:$("#texto_producto").val()},function(data){
		console.log(data);
		$.ajax({
	    url:'../php/subir_imagen.php', //Url a donde la enviaremos
	    type:'POST', //Metodo que usaremos
	    contentType:false, //Debe estar en false para que pase el objeto sin procesar
	    data:datos, //Le pasamos el objeto que creamos con los archivos
	    processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
	    cache:false //Para que el formulario no guarde cache
	  	}).done(function(data){
				if (data=="00"){
					alert("La imagen debe ser .jpg,.jpeg o .png y menor de 500KB");
				}else{
					//location.reload(true);
				}
	  	});
	});
	
}

function aproximacion_pago(seguidores){
	var porc = 1.1;
	var mult = 0;
	var opcion_paypal = "";
	if (opcion_tipo=="textual"){
		mult = 12.5 /10000;
	}else if(opcion_tipo=="visual"){
        mult = 18.75 / 10000;
    }
	
    if (coste_total<=10000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>10000 Seguidores "+(10000*mult);
    }else if (coste_total>10000*porc && coste_total<=10000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>20000 Seguidores "+(20000*mult);
    }else if (coste_total>20000*porc && coste_total<=30000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>30000 Seguidores "+(30000*mult);
    }else if (coste_total>30000*porc && coste_total<=50000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>50000 Seguidores "+(50000*mult);
    }else if (coste_total>50000*porc && coste_total<=75000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>75000 Seguidores "+(75000*mult);
    }else if (coste_total>75000*porc && coste_total<=100000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>100000 Seguidores "+(100000*mult);
    }else if (coste_total>100000*porc && coste_total<=200000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>200000 Seguidores "+(200000*mult);
    }else if (coste_total>200000*porc && coste_total<=300000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>300000 Seguidores "+(300000*mult);
    }else if (coste_total>300000*porc && coste_total<=500000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>500000 Seguidores "+(500000*mult);
    }else if (coste_total>500000*porc && coste_total<=750000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>750000 Seguidores "+(750000*mult);
    }else if (coste_total>750000*porc && coste_total<=1000000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>1000000 Seguidores "+(1000000*mult);
    }else if (coste_total>1000000*porc && coste_total<=2000000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>2000000 Seguidores "+(2000000*mult);
    }else if (coste_total>2000000*porc && coste_total<=3000000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>3000000 Seguidores "+(3000000*mult);
    }else if (coste_total>3000000*porc && coste_total<=4000000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>4000000 Seguidores "+(4000000*mult);
    }else if (coste_total>4000000*porc && coste_total<=5000000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>5000000 Seguidores "+(5000000*mult);
    }else if (coste_total>5000000*porc && coste_total<=6000000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>6000000 Seguidores "+(6000000*mult);
    }else if (coste_total>6000000*porc && coste_total<=7000000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>7000000 Seguidores "+(7000000*mult);
    }else if(coste_total>7000000*porc){
    	opcion_paypal = "Elegir opción de pago:<br>7000000 Seguidores "+(7000000*mult);
    }
  	$("#coste_anuncio").html(opcion_paypal+"€");
}

function seleccion_aut(){
	vaciar_clientes();
	$("#clientes").hide();
	if ($("#resumen_tipo").text()=="Textual"){
		obtener_aut(10000);
		$("#paypal_visual").hide();
		$("#paypal_textual").show();
	}else if($("#resumen_tipo").text()=="Visual"){
		obtener_aut(10000);
		$("#paypal_visual").show();
		$("#paypal_textual").hide();
	}else{
		$("#clientes").html("Elige un tipo de anuncio");
	}
	
}

function obtener_aut(followers){
	var categoria = $("#anunciocategoria").prop('value');
	var provincia = $("#provincia").val();
	$.get('../php/obtener_aut.php',{followers:followers,Categoria:categoria,provincia:provincia},function(data){
		array_clientes = data.split("-");
	});
	$("#coste_anuncio").html("<b>Importante</b>.Al pagar el anuncio selecciona la misma opción <br>que has elegido ahora");
}

function acortar_url(longUrl){
	jQuery.urlShortener({
    longUrl: longUrl,
    success: function (shortUrl) {
        //shortUrl ->  Shortened URL
        link = shortUrl;
        actualizar_preview();
    },
    error: function(err)
    {
        alert("Error al procesar URL: "+err);
    }
});
}

function datos_categoria(){
    var categoria = $("#anunciocategoria").prop('value');
    var provincia = $("#provincia").prop('value');
    $("#resumen_provincia").html(provincia);
    $("#resumen_categoria").html(categoria);
    $.get('../php/datos_categoria_provincia.php',{categoria:categoria,provincia:provincia},function(data){
    	console.log(data);
        $('#datos_categoria_provincia').html(data);
    });
    $("#resumen_categoria").html(categoria);
}

//Sirve para la actualización de búsqueda automática de seguidores y pago autmático
function pago_automatico(elemento){
	var text = $(elemento).val()+ " Seguidores";
	obtener_aut($(elemento).val());
	$("#unico").val(text);
	$("#unico").html(text);
}
