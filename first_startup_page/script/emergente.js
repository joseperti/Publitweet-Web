function ventanaemergente(){
    document.getElementById("emergente").style.zIndex = 1;  
    document.getElementById("ventanadatos").style.zIndex = 1;
    
    document.getElementById("ventanauser").style.display= "none";
    document.getElementById("cargando").style.display= "inherit";
    
    
    var name = $('#campocalcular').val();
                
    $.get('../php/consult.php',{
            'nombre' : name,
            error: function(data){
            //console.log(data);
        }}
        ,function(data){
        //console.log($.parseJSON(data).user.screen_name + $.parseJSON(data).user.followers_count);
        var followers = $.parseJSON(data).user.followers_count;
        var calculo = followers*0.00035;
        if (followers<1000){
            calculo = calculo;
        }else if(followers>=1000 && followers<3000){
            calculo -= 0.1*calculo;
        }else if(followers>=3000 && followers<5000){
            calculo -= 0.12*calculo;
        }else if(followers>=5000 && followers<10000){
            calculo -= 0.13*calculo;
        }else if(followers>=10000 && followers<20000){
            calculo -= 0.14*calculo;
        }else if(followers>=20000 && followers<30000){
            calculo -= 0.15*calculo;
        }else if(followers>=30000 && followers<40000){
            calculo -= 0.16*calculo;
        }else if(followers>=40000){
            calculo = 20;
        }
        calculo = (parseInt(calculo*100*30))/100;
        calculo = (calculo.toString()).replace('.',',');
        $("#nombretwitter").text("@"+$.parseJSON(data).user.screen_name);
        $("#gananciastwitter").text(calculo+"€");
            
            $("#cargando").hide();
            $("#ventanauser").show();
        
    });

        
    
}


function atras(){
    document.getElementById("emergente").style.zIndex = -1;  
    document.getElementById("ventanadatos").style.zIndex = -1;    
}