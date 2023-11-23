function empezar(){
    document.getElementById("registro").style.display = "inherit";
    document.getElementById("informacion").style.display = "none";
    document.getElementById("categorias").style.display = "none";
    document.getElementById("politica").style.display = "none";
}

function comenzar(){
    
    document.getElementById("registro").style.opacity = 0.5;
    document.getElementById("informacion").style.opacity = 1;
    document.getElementById("registro").style.display = "none";
    document.getElementById("informacion").style.display = "inherit";
}

function anterior(x){
    if(x == 1){
        document.getElementById("registro").style.display = "inherit";
        document.getElementById("informacion").style.display = "none"
        document.getElementById("registro").style.opacity = 1;
        document.getElementById("informacion").style.opacity = 0.5;
    }else if (x == 2){
        document.getElementById("informacion").style.display = "inherit";
        document.getElementById("categorias").style.display = "none";
        document.getElementById("informacion").style.opacity = 1;
        document.getElementById("categorias").style.opacity = 0.5;
    }else if (x == 3){
        document.getElementById("categorias").style.display = "inherit";
        document.getElementById("politica").style.display = "none";
        document.getElementById("politica").style.opacity = 0.5;
        document.getElementById("categorias").style.opacity = 1;
    }
}

function siguiente(x){
    if(x == 1){
        document.getElementById("informacion").style.display = "none";
        document.getElementById("categorias").style.display = "inherit";
        document.getElementById("categorias").style.opacity = 1;
        document.getElementById("informacion").style.opacity = 0.5;  
    }else if (x == 2){
        document.getElementById("politica").style.display = "inherit";
        document.getElementById("categorias").style.display = "none";
        document.getElementById("politica").style.opacity = 1;
        document.getElementById("categorias").style.opacity = 0.5;
    }else if (x == 3){
        location.href="usuario.php";
    }
}
