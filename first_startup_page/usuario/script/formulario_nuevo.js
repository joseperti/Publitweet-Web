var direccion = "";
var pais = "";
function comprobar(){
	var error="";
	if ($("#nombre").val().length==0){error = "Rellena todos los campos"}
	if ($("#correo").val().length==0){error = "Rellena todos los campos"}
	if ($("#provincia").prop('value')=="0"){error = error + "\nDebe seleccionar su provincia"}
	if ($("#correo").val()!=$("#confirm_correo").val()){error = error + "\nLos correos no coinciden"}

	var total=0;
	var count = 0;
	//Máximo de 3 categorías por usuario
	var categorias = [null,null,null];
	var todas = ["#aficiones","#arte","#belleza","#casa","#deportes","#empleo","#empresas","#familia","#finanzas",
	"#moda","#internet","#ley","#mercado","#noticias","#ordenadores","#restaurantes","#salud","#motor","#viajes","#videojuegos","#otros"];

	for (valor in todas){
		if ($(todas[valor]).prop("checked")){
			total++;
			categorias[total] = parseInt(valor) + 1;
		}
	}

	if (total>3 || total==0){
		error = error + "\n Seleccione como mínimo 1 categoría y máximo 3. Seleccionadas: "+total;
	}

	//if (direccion=="" || pais==""){
	//	error = error + "\n Debes activar la localización para el registro de Unituit";
	//}
	if (!$("#aceptar").prop('checked')){
		error = error + "\nDebes aceptar las condiciones";
	}
	alert(error);
	if (error==""){
		$.post('../php/nuevo.php',{nombre:$("#nombre").val(),correo:$("#correo").val(),categorias:categorias,direccion:direccion,
			provincia:$("#provincia").prop('value'),pais:pais,comercial:$("#comercial").val()},
			function(data){
				if (data == "11"){
					alert("Registrado con éxito");
					$(location).attr('href','../panel_usuario/');
					window.open('../../faqs/','_blank');
				}else if (data == "02"){
					alert("Debe tener al menos 100 followers para formar parte de Unituit");
				}else if (data == "01"){
					alert("Debe activar la localización para el registro de Unituit");
				}else{
					alert(data);
				}
		});
	}
}
function geo(){
	if (navigator.geolocation){
	    navigator.geolocation.getCurrentPosition(function(position){
			var coord = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' + position.coords.latitude+","+position.coords.longitude+"&sensor=true";
			$.getJSON(coord,function(data){
				$.each( data.results, function( key, value ) {
					pais_act = data.results[key].formatted_address;
					direccion = data.results[0].formatted_address;
			  		//$("#geo").html(direccion);
			  		if (pais_act == "España"){
			  			pais = pais_act;
					}
		  		});
		  		if (pais!="España"){
			  			alert("Debes ser de España para utilizar Unituit");
				  		$.post('php/cerrar_sesion.php',function(){
							$(location).prop('href','http://unituit.com/');
						});
				}		  		
		  	});
		},function(){
			alert("Debes activar tu localización para utilizar Unituit");
			//$.post('php/cerrar_sesion.php',function(){
			//	$(location).prop('href','http://unituit.com/final')
			//});
		});
	}
}
//alert("Unituit.com necesitará acceder a su localización para el registro.\nEl navegador le pedirá su autorización a continuación.");
//geo();