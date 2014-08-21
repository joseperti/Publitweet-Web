<?php 
	session_start();
	$_SESSION['user'] = $_POST['user'];
	$_SESSION['pass'] = $_POST['pass'];
	header("Location: ../");
?>