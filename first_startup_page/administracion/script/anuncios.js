function activar_anuncio(elemento){
	var id = $(elemento).prop('value');
	var confirmar = confirm("Activar anuncio: "+id);
	if (confirmar){
		console.log("Activando");
		$.post('datos/activar_anuncio.php',{id:id},function(data){
			alert(data);
			obtener_anuncios_pendientes();
		});
	}
}

function eliminar_anuncio(elemento){
	var id=$(elemento).prop('value');
	var confirmar = confirm("Eliminar anuncio: "+id);
	if (confirmar){
		console.log("Eliminando");
		$.post('datos/eliminar_anuncio.php',{id:id},function(data){
			alert(data);
			obtener_anuncios_pendientes();
		});
	}
}

function obtener_anuncios_pendientes(){
	$.get('datos/obtener_anuncios.php',function(data){
		$("#anuncios_block").html(data);
	});
}

function usuarios_de_anuncio(elemento){
	var id_anuncio = $(elemento).val();
	$.post('datos/usuarios_anuncio.php',{id_anuncio:id_anuncio},function(data){
		$("#anuncios_block").html(data);
	});
}


