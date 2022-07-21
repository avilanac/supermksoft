<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title>Close</title>
</head>
<body>
	<?php 
	// Para cerrar las sesiones
 
	session_start();
	session_destroy();
	header("Location: ../index.html");
	exit();
		//echo '<script> alert ("Ha cerrado la sesión, ingrese su usuario y contraseña de nuevo");</script>';
		//echo '<script>window.location="../login.php"</script>';
	?>
		

</body>
</html>