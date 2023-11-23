
function estadisticas(){
	$("#mis_anuncios").html("Cargando mis anuncios de Unituit");
	mis_anuncios();
}
	
function cerrar_sesion(){
	var salir = confirm("¿Desea cerrar sesión?");
	if (salir){
		$.get('../php/cerrar_sesion.php',function(){
			$(location).attr('href','http://unituit.com/');
		});
	}
}

function mis_anuncios(){
	$.get('../php/obtener_anuncios.php',function(data){
		$("#mis_anuncios").html(data);
	});
}

function estadisticasanuncio(elemento){
	$("#mis_anuncios").show();
	console.log("Valor: " + $(elemento).prop('value'));
	$.post('../php/obtener_estadisticas.php',{id:$(elemento).prop('value')},function(data){
		console.log("Obteniendo estadisticas");
		console.log(data);
		$("#mis_anuncios").html(data);
	})
}

function cambiar_imagen(){
	var archivo = $("#imagen_perfil_nueva")[0].files[0];
	var datos = new FormData();
	datos.append('file',archivo);
	console.log("Enviando");
	alert("Cargando archivo espere a que termine.Puede pulsar aceptar");
	$.ajax({
    url:'../php/cambiar_imagen.php', //Url a donde la enviaremos
    type:'POST', //Metodo que usaremos
    contentType:false, //Debe estar en false para que pase el objeto sin procesar
    data:datos, //Le pasamos el objeto que creamos con los archivos
    processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
    cache:false //Para que el formulario no guarde cache
  	}).done(function(data){
			alert(data);
			if (data=="00"){
				alert("La imagen debe ser .jpg,.jpeg o .png y menor de 500KB");
			}else{
				location.reload();
			}
  	});

}
