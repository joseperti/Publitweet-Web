var x = 0;

function barra(){   
    if (x == 0){
        document.getElementById('barralateral').style.marginLeft= 0;  
        document.getElementById('barra').style.width= "100%";  
        document.getElementById('divisor').style.width= "25%"; 

        
        x++;
    }else{
        document.getElementById('barralateral').style.marginLeft="-20%";  
        document.getElementById('divisor').style.width= "17%"; 
        x= 0;             
    }
}
function alargar(x){
    if(x==1){
        document.getElementById('facebot').style.background = "#3B5998";
        document.getElementById('facebot').style.opacity = 1;
    }else if(x ==2){
        document.getElementById('twitbot').style.background = "#4099FF";
        document.getElementById('twitbot').style.opacity = 1;
    }else if(x == 3){
        document.getElementById('goobot').style.background = "#d34836";
        document.getElementById('goobot').style.opacity = 1;
    }else if(x == 4 ){
        document.getElementById('youbot').style.background = "#e52d27";
        document.getElementById('youbot').style.opacity = 1;
    }else if(x == 5 ){
        document.getElementById('linkedbot').style.background = "#007bb6";
        document.getElementById('linkedbot').style.opacity = 1;
    }
    
}

function encoger(x){

        if(x==1){
            document.getElementById('facebot').style.width = 60;
            document.getElementById('facebot').style.background = "#555555";
        }else if(x ==2){
            document.getElementById('twitbot').style.width = 60;
            document.getElementById('twitbot').style.background = "#555555";
        }else if(x == 3){
            document.getElementById('goobot').style.width = 60;
            document.getElementById('goobot').style.background = "#555555";
        }else if(x ==4 ){
            document.getElementById('youbot').style.width = 60;
            document.getElementById('youbot').style.background = "#555555";
        }else if(x == 5 ){
            document.getElementById('linkedbot').style.width = 60;
            document.getElementById('linkedbot').style.background = "#555555";
        }
    }    