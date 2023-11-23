function comenzar(){
    $("#divanuncios").show();
    $("#divcategorias").hide();
    $("#divinformacion").hide();
    $("#informacion_anuncio").hide();
    
    $("#botcategorias").css("opacity", 0.5);
    $("#botinformacion").css("opacity", 0.5);
    $("#botcerrarsesion").css("opacity", 0.5);
    obtener_anuncios();
     
}

function anuncios(){
    obtener_anuncios();
    $("#divanuncios").show();
    $("#divcategorias").hide();
    $("#divinformacion").hide();
    $("#informacion_anuncio").hide();

    $("#botanuncios").css("opacity", 1);
    $("#botcategorias").css("opacity", 0.5);
    $("#botinformacion").css("opacity", 0.5);
    $("#botcerrarsesion").css("opacity", 0.5);
}

function categorias(){
    $("#divanuncios").hide(); 
    $("#divcategorias").show();
    $("#divinformacion").hide();
    $("#informacion_anuncio").hide();
    
    $("#botanuncios").css("opacity", 0.5);
    $("#botcategorias").css("opacity", 1);
    $("#botinformacion").css("opacity", 0.5);
    $("#botcerrarsesion").css("opacity", 0.5); 
}

function informacion(){
    $("#divanuncios").hide();
    $("#divcategorias").hide();
    $("#divinformacion").show(); 
    $("#informacion_anuncio").hide();
    
    $("#botanuncios").css("opacity", 0.5);
    $("#botcategorias").css("opacity", 0.5);
    $("#botinformacion").css("opacity", 1);
    $("#botcerrarsesion").css("opacity", 0.5); 
}

function informacion_anuncio(elemento){
    $("#divcategorias").hide();
    $("#divinformacion").hide();
    $("#divanuncios").hide();
    $("#informacion_anuncio").show();

    $.post('../php/informacion_anuncio.php',{id:$(elemento).prop('value')},
        function(data){
            $("#mostrar_anuncio").html(data);
    });
}
