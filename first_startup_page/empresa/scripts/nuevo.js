function comprobarpass(){
	if ($("#password").val().length>7){
		$("#comprobado").text("");
		if ($("#password").val() == $("#confirm").val()){
			$("#comprobado").html("<img src='images/correcto.png' height=20 width=20></img>");
		}else{
			//$("#comprobado").text("No coinciden");
		}
	}else{
		//$("#comprobado").text("Demasiado corta");
	}
}

function comprobar_mail(){
	$("#comprobado_mail").text("");
	if ($("#mail").val() == $("#mail_confirm").val()){
		$("#comprobado_mail").html("<img src='images/correcto.png' height=20 width=20></img>");
	}
}

function comprobacionglobal(){
	var error="";
	if ($("#nombre").val().length==0){error += "Rellene el nombre\n"}
	if ($("#apellidos").val().length==0){error += "Rellene los apellidos\n"}
	if ($("#identificacion").val().length==0){error += "Relle el CIF/NIF\n"}
	if ($("#mail").val().length==0){error += "Introduzca un email\n"}
	if ($("#usuario").val().length==0){error += "Rellene el usuario\n"}
	if ($("#password").val().length==0){error += "Inserte una contraseña\n"}
	if ($("#confirm").val().length==0){error += "Confirme la contraseña\n"}
	if ($("#provincia").val().length==0){error += "Seleccione una provincia\n"}
	if ($("#direccion").val().length==0){error += "Introduzca su dirección\n"}
	if ($("#razonsocial").val().length==0){error += "Introduzca la razón social\n"}
	if ($("#telefono").val().length==0 && $("#telefono").val().length>=9){error += "Rellene el telefono o formato incorrecto\n"}
	if ($("#poblacion").val().length==0){error += "Rellene la población\n"}
	if ($("#cpostal").val().length==0){error += "Rellene el codigo postal\n"}
	if ($("#telefono").val().charAt(0)!="7" && $("#telefono").val().charAt(0)!="6" && $("#telefono").val().charAt(0)!="9"){
		error += "El teléfono debe comenzar por: 6,7 o 9\n";
	}
	if (($("#password").val().length>7)){
		if ($("#password").val() == $("#confirm").val()){
		}else{
			error += "La confirmación de contraseña no coincide\n";
		}
	}else{
		if($("#password").val().length != 0)
		error += "Contraseña demasiado corta, introduzca mínimo 7 carácteres\n";
		else 
		error += "Introduzca una contraseña";
	}
	if (error=="")
	{
		siguiente(1);
	}
	else {
		alert(error);
	}
	
}

function confirmRegis(){
	error = "";
	if (!$("#aceptar").prop('checked')){
		error = error + "\nDebes aceptar las condiciones";
	}
	
	if(error=="")
	{
		$.post('../php/nuevo.php',{usuario:$("#usuario").val(),password:$("#confirm").val(),nombre:$("#nombre").val(),apellidos:$("#apellidos").val(),
				cif:$("#identificacion").val(),email:$("#mail").val(),ciudad:$("#ciudad").val(),
				provincia:$("#provincia").val(),direccion:$("#direccion").val(),
				razonsocial:$("#razonsocial").val(),telefono:$("#telefono").val(),poblacion:$("#poblacion").val(),
				cpostal:$("#cpostal").val()},
				function(data){
					if (data=="11"){
						alert("Accede otra vez e irás a tu panel");
						window.open('../../faqs/','_blank');
						$(location).attr('href','../login_empresa/');
					}else if(data=="01"){
						alert("Ya existe el nombre de Usuario o CIF/NIF/Pasaporte");
					}else if(data=="20"){
						alert("Nombre de usuario demasiado largo");
					}else{
						alert(data);
					}
			});
	}
	else {
		alert(error);
	}
}