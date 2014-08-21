<?php
	session_start();
	session_destroy();
	header("Location: ../../home/");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cerrando Sesión</title>
</head>
<body>
<h1>¡Hasta pronto!</h1>
</body>
</html>