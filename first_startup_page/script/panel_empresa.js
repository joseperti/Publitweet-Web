function comenzar(){
    $("#divanuncios").show(); 
    $("#divanunciate").hide(); 
    $("#divinformacion").hide(); 

    
    $("#botcategorias").css("opacity", 0.5);
    $("#botinformacion").css("opacity", 0.5);
    $("#botcerrarsesion").css("opacity", 0.5);  
    estadisticas();  
     
}

function anuncios(){

    location.reload(true);
}

function anunciate(){
    $("#divanuncios").hide(); 
    $("#divanunciate").show(); 
    $("#divinformacion").hide();
    
    $("#botanuncios").css("opacity", 0.5);
    $("#botcategorias").css("opacity", 1);
    $("#botinformacion").css("opacity", 0.5);
    $("#botcerrarsesion").css("opacity", 0.5); 
    
    $("#nuevoanuncio").show();
    $("#categorias").hide();
    $("#tipoanuncio").hide();
    $("#twitteros").hide();
    $("#resumen").hide();
    $("#pagar").hide();
    $("#infoproducto").hide();

}

function informacion(){
    $("#divanuncios").hide(); 
    $("#divanunciate").hide(); 
    $("#divinformacion").show(); 
    
    $("#botanuncios").css("opacity", 0.5);
    $("#botcategorias").css("opacity", 0.5);
    $("#botinformacion").css("opacity", 1);
    $("#botcerrarsesion").css("opacity", 0.5); 
}

function nuevo(){
    $("#infoproducto").hide();
    $("#nuevoanuncio").hide();
    $("#categorias").show();  
    $("#tipoanuncio").hide();
    $("#resumen").hide();
    
}

function tipo(){

    $("#infoproducto").hide();
    $("#categorias").hide();
    $("#twitteros").hide();
    $("#tipoanuncio").show();
    $("#resumen").hide();
}

function info_producto(){

    $("#infoproducto").show();
    $("#nuevoanuncio").hide();
    $("#categorias").hide();  
    $("#tipoanuncio").hide();
    $("#resumen").hide();

}

function twitteros(){
    $("#infoproducto").hide();
    $("#tipoanuncio").hide();
    $("#resumen").hide();
    $("#twitteros").show();
}

function resumen(){
    $("#infoproducto").hide();
    $("#twitteros").hide();
    $("#pagar").hide();
    $("#resumen").show();
}

function pagar(opcion){
    if (opcion=="textual"){
        enviar_textual();
    }else if(opcion=="visual"){
        enviar_visual();
    }
	$("#resumen").hide();
	$("#pagar").show();
}
