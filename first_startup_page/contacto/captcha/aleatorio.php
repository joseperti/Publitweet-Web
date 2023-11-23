<?php
	$img = ["1.png","2.png","3.png","4.png","5.png","6.png","7.png"];
	$numero = (int) rand(0,6);
	$datos = array("imagen"=>(string) $img[$numero],"id"=>(string) $numero+1);
	$datos = json_encode($datos);
	echo $datos;
?>