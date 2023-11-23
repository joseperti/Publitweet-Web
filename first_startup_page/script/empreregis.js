function empezar(){ 
    $('#registro').show();
    $('#informacion').hide();
    $('#politica').hide();
}

function comenzar(){
    
    $('#registro').hide();
    $('#informacion').show();
    $('#politica').hide();
}

function anterior(x){
    if(x == 1){
        $('#registro').show();
        $('#informacion').hide();
        $('#politica').hide();
    }else if (x == 2){
        $('#registro').hide();
        $('#informacion').show();
        $('#politica').hide();
    }
}

function siguiente(x){
    if (x == 1){
        $('#registro').hide();
        $('#informacion').hide();
        $('#politica').show();
        //document.getElementById("categorias").style.display = "none";
    }else if (x == 2){
        location.href="usuario.php";
    }
}