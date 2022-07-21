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
	<div class="container-fluid h-100"> 
			<div class="row w-100 align-items-center">
				<div class="col text-center">
					<?php
					require("../../connection/connection.php");

					$id=$_GET["id"];
					$nombre=$_GET["nom"];
					$ape=$_GET["ape"];
					$tel=$_GET["tel"];
					$adre=$_GET["adre"];


					$sql="UPDATE customers SET namec=:nom, lastna=:la, tel=:te, adrc=:ad WHERE id_cus=:id";
					$resultado=$connect->prepare($sql);  
					$resultado->execute(array(":id"=>$id, ":nom"=>$nombre, ":la"=>$ape, ":te"=>$tel, ":ad"=>$adre));
					echo "Se actualizó datos del cliente con cédula $id ";
					?>
					<br><br>					
					<a href="../cust.php"><input type="button" name="volver" class="btn btn-danger" id="cancela" value="Volver"></a>
				</div>	
			</div>
    </div>
</body>
</html>