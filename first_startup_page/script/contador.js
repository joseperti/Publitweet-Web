function timer(){
    
var d = new Date();

var currentsec=59 -d.getSeconds();	
var currentmin=59 -d.getMinutes();	
var currenthor=24 -d.getHours();
var currentdia= 28 -d.getDate();
    
   if (currentsec==0){		
    currentsec=59;		
    currentmin+=-1;		
   }
    if (currentmin==0){		
    currentmin=59;		
    currenthor+=-1;		
   }
    if (currenthor==0){		
    currenthor=24;		
    currentdia+=-1;		
   }
    
    Strsec=""+currentsec;		
    Strmin=""+currentmin;		
    Strhor= ""+currenthor;
    Strdia= ""+currentdia;
    	
   if (Strsec.length!=2){	
    Strsec="0"+currentsec;	
   }				
   if (Strmin.length!=2){	
    Strmin="0"+currentmin;
   }
    if (Strhor.length!=2){	
    Strhor="0"+currenthor;
   }

    document.getElementById("dia").innerHTML = Strdia;
     document.getElementById("hor").innerHTML = Strhor;
    document.getElementById("min").innerHTML = Strmin;
    document.getElementById("sec").innerHTML = Strsec;
    

    
  setTimeout("timer()", 16);	
}

function hola(){
    alert("hola");   
}

