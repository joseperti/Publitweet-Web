function obtener_usuarios(){
	$.get('datos/obtener_usuarios.php',function(data){
		$("#usuarios_block").html(data);
	});
}

function estado_usuario(estado,elemento){
	var id = $(elemento).prop('value');
	$.post('datos/estado_usuario.php',{estado:estado,id:id},function(data){
		obtener_usuarios();
	});
}

function obtener_anunciantes(){
	$.get('datos/obtener_anunciantes.php',function(data){
		$("#empresas_block").html(data);
	});
}

function estado_anunciante(estado,elemento){
	var id = $(elemento).prop('value');
	$.post('datos/estado_anunciante.php',{estado:estado,id:id},function(data){
		obtener_anunciantes();
	});
}