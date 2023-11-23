function actualizar_categorias(){
	console.log("Ejecutando consulta");
	var categorias = "";
	if ($("#tecnologia").prop("checked")){
		categorias = categorias + "-tecnologia-";
	}
	if ($("#alimentacion").prop("checked")){
		categorias = categorias + "-alimentacion-";
	}
	if ($("#ocio").prop("checked")){
		categorias = categorias + "-ocio-";
	}
	if ($("#juegos").prop("checked")){
		categorias = categorias + "-juegos-";
	}
	if ($("#television").prop("checked")){
		categorias = categorias + "-television-";
	}
	if ($("#cine").prop("checked")){
		categorias = categorias + "-cine-";
	}
	if ($("#deportes").prop("checked")){
		categorias = categorias + "-deportes-";
	}
	if ($("#musica").prop("checked")){
		categorias = categorias + "-musica-";
	}
	if (categorias==""){
		$("#respuesta_categorias").text("No se ha seleccionado ninguna");
	}else{
		$("#respuesta_categorias").text("Se seleccionaron: "+categorias);
	}
	console.log(nombre);
	$.get('php/obtener_categorias.php',{name:nombre,error:function(data){
		console.log(data);
	}},function(data){
		console.log("ejecutado");
		categorias = categorias + data;
	});

	console.log(categorias);

}