function cerrar_sesion(){
	var salir = confirm("¿Desea cerrar sesión?");
	if (salir){
		$.get('../php/cerrar_sesion.php',function(){
			$(location).attr('href','../../index');
		});
	}
}