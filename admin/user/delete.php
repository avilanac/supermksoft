<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title>Update</title>
</head>
<body>
	
	<div class="py-4 px-3 mb-4 bg-light">
		
		<h6 align="center"><?php include ("../../includes/date.php"); echo fecha();?></h6>	
		<div class="media d-flex align-items-center"><img src="../../img/head3.png" width="150" height="100" alt="">

	</div>
	<br>
            <form method="post">
				<h6 align="center">Se va a eliminar un usuario. Si está seguro presione el Botón "Eliminar", de lo contrario presione "Volver".</h6><br>
				<div class="container-fluid h-100"> 
					<div class="row w-100 align-items-center">
						<div class="col text-center">
							<input type="submit" name="elimina" id="elimina" class="btn btn-danger" value="Eliminar">
							<a href="../users.php"><input type="button" name="volver" class="btn btn-secondary" id="elimina" value="Volver"></a>
						</div>	
					</div>
    			</div>			
			</form>
			<br>
			<?php
			include("../../connection/connection.php");

			$id=$_GET["id"];
			
			if(isset($_POST['elimina'])){
				$connect->query("DELETE FROM users WHERE id_usu='$id'");
				echo '<script> alert ("Se borró el Usuario");</script>';
				echo '<script>window.location="../users.php"</script>';
	
			}
			?>		
	
		</div>
    </div>
</body>
</html>