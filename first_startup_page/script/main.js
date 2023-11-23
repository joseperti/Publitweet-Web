function main(){
 location.href="../index/";   
}

function login(){
 location.href="../empresa/login_empresa/"   
}

function logint(){
    $.get("../usuario/login_usuario/index.php", function( data ) {
        $(location).attr('href',data);
    }); 
}

function registro(){
    location.href="../usuario/empresa/nuevo_empresa/"   
}


function informacion(){
    location.href="../faqs/"   
}

function irafacebook(){
    window.open("https://www.facebook.com/pages/Unituitcom/430519907076447",'_blank');  
}

function iratwitter(){
    window.open("https://twitter.com/unituit",'_blank');  
}

function iramail(){
    window.open("../contacto/",'_blank');
}

