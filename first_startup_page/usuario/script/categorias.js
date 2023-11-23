function obtener_categorias(){

	$.post('../php/obtener_categorias.php',function(data){
		console.log(data);
		var todas = [$("#aficiones"),$("#arte"),$("#belleza"),$("#casa"),$("#deportes"),$("#empleo"),$("#empresas"),$("#familia"),$("#finanzas"),
			$("#moda"),$("#internet"),$("#ley"),$("#mercado"),$("#noticias"),$("#ordenadores"),$("#restaurantes"),
			$("#salud"),$("#motor"),$("#viajes"),$("#videojuegos"),$("#otros")];
		var categorias = $.parseJSON(data);
		for (var cat in categorias){
			//todas[categorias[cat]-1].html("Seleccionado");
			var elemento = todas[categorias[cat]-1];
			elemento.prop('checked', true);
			console.log(todas[categorias[cat]-1]);
		}
	});

}
function guardar_categorias(){
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
		error = "<br> Seleccione como mínimo 1 categoría y máximo 3. Seleccionadas: "+total;
		$("#respuesta_categorias").html(error);
	}else{
		$.post('../php/guardar_categorias.php',{categorias:categorias},function(data){
			alert("Categorías guardadas");
			obtener_categorias();
		});
	}
}

$(document).ready(function(){
	obtener_categorias();
});