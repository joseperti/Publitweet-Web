//Efectos de panel de usuario

function empezar(){
    
    document.getElementById("anuncios").style.display = "inherit";    
    document.getElementById("categorias").style.display = "none";
    document.getElementById("ganancias").style.display = "none";
    
}

function categoria(){
    
    document.getElementById("anun").style.opacity = 0.5;
    document.getElementById("gana").style.opacity = 0.5;
    document.getElementById("cate").style.opacity = 1;
    
    document.getElementById("anuncios").style.display = "none";
    document.getElementById("categorias").style.display = "inherit";
    document.getElementById("ganancias").style.display = "none";
}

function anuncios(){
    document.getElementById("anun").style.opacity = 1;
    document.getElementById("gana").style.opacity = 0.5;
    document.getElementById("cate").style.opacity = 0.5;
    document.getElementById("anuncios").style.display = "inherit";
    document.getElementById("categorias").style.display = "none";
    document.getElementById("ganancias").style.display = "none";
}


function ganancias(){
    document.getElementById("anun").style.opacity = 0.5;
    document.getElementById("gana").style.opacity = 1;
    document.getElementById("cate").style.opacity = 0.5;
    
    document.getElementById("anuncios").style.display = "none";
    document.getElementById("categorias").style.display = "none";
    document.getElementById("ganancias").style.display = "inherit";
}


function expandir(x){

            document.getElementById(x).style.height = 200;  
        
    
}