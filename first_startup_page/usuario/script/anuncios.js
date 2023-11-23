function obtener_anuncios(){
	$.post('../php/obtener_anuncios.php',{usuario:nombre},function(data){
		console.log("Datos:"+data);
		$("#anuncios_posibles").html(data);
	})
}
function publicar(elemento){
	var valor = $(elemento).prop('value');
	$(elemento).append("Publicando...");
	$.post('../php/publicar_anuncio.php',{id:valor},function(data){
		anuncios();
		obtener_anuncios();
	});
}
function rechazar(elemento){
	$(elemento).append("-Rechazando...");
	var valor = $(elemento).prop('value');
	$.post('../php/rechazar_anuncio.php',{idanuncio:valor},function(data){
		anuncios();
		obtener_anuncios();
	})
}
