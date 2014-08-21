<?php
	session_start();
	$db = new mysqli("mysql.hostinger.es","u450654470_01","12345678","u450654470_01");
	$cuenta = $_POST['cuenta'];
	$consulta = sprintf("insert into Pagos(usuario,fecha,cuenta) values(%s,'%s','%s')",$_SESSION['id'],date('Y-m-d H:i:s'),$cuenta);
	$db->query($consulta);
	header('Location: ../');
?>