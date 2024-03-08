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
			<?php
			include("../../connection/connection.php");

			$id=$_GET["id"];

			$sql= "SELECT * FROM invoice where id_cus = :de"; 
			$resultado=$connect->prepare($sql);
			$resultado->execute(array(":de" => $id));
			$cust=$resultado->fetch(PDO::FETCH_ASSOC);

			if($cust){
				echo '<script>alert("No se puede eliminar este cliente. Cliente asociado a factura existente.");</script>';
				echo '<script>window.location= "../users.php"</script>';
			}
			else{
				?>

            <form method="post">
				<h6 align="center">Se va a eliminar un cliente. Si está seguro presione el Botón "Eliminar", de lo contrario presione "Volver".</h6><br>
				<div class="container-fluid h-100"> 
					<div class="row w-100 align-items-center">
						<div class="col text-center">
							<input type="submit" name="elimina" id="elimina" class="btn btn-danger" value="Eliminar">
							<a href="../cust.php"><input type="button" name="volver" class="btn btn-secondary" id="elimina" value="Volver"></a>
						</div>	
					</div>
    			</div>			
			</form>
			<br>
			<?php
			
				if(isset($_POST['elimina'])){
					$connect->query("DELETE FROM customers WHERE id_cus='$id'");
					echo '<script> alert ("Se eliminó");</script>';
					echo '<script>window.location="../cust.php"</script>';
				}
			}
			?>	
		</div>
    </div>
</body>
</html>