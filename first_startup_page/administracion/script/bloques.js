/*
Divs principales:
	-Estadísticas: estadisticas_block
	-Usuarios: usuarios_block
	-Anuncios: anuncios_block

*/

var bloques = ["#estadisticas_block","#anuncios_block","#usuarios_block","#empresas_block"];
function cargarBotones(){

	$("#seleccion").html("<button onclick='mostrarBloque(0)'>Estadisticas</button>\
		<button onclick='mostrarBloque(1)'>Anuncios</button>\
		<button onclick='mostrarBloque(2)'>Usuarios</button>\
		<button onclick='mostrarBloque(3)'>Empresas</button>");

}
function ocultarTodo(){
	console.log("Ocultando los bloques:");
	$.each(bloques,function(i,valor){
		$(valor).hide();
	});

}

function mostrarBloque(block){
	ocultarTodo();
	$(bloques[block]).show();
	obtener_anuncios_pendientes();
	obtener_usuarios();
}

function inicio(){
	ocultarTodo();
	cargarBotones();
	mostrarBloque(0);
	obtener_anuncios_pendientes();
	obtener_usuarios();
	obtener_anunciantes();
}