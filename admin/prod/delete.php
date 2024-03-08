<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title>Eliminar</title>
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
			
			$sql= "SELECT * FROM detail where cod = :de"; 
			$resultado=$connect->prepare($sql);
			$resultado->execute(array(":de" => $id));
			$cod=$resultado->fetch(PDO::FETCH_ASSOC);

			if($cod){
				echo '<script>alert("No se puede eliminar este producto. Producto asociado a factura existente.");</script>';
				echo '<script>window.location= "../prod.php"</script>';
			}
			else{
			?>	
            <form method="post">
				<h6 align="center">Se va a eliminar un producto. Si está seguro presione el Botón "Eliminar", de lo contrario presione "Volver".</h6><br>
				<div class="container-fluid h-100"> 
					<div class="row w-100 align-items-center">
						<div class="col text-center">
							<input type="submit" name="elimina" id="elimina" class="btn btn-danger" value="Eliminar">
							<a href="../prod.php"><input type="button" name="volver" class="btn btn-secondary" id="elimina" value="Volver"></a>
						</div>	
					</div>
    			</div>			
			</form>
			<br>
			<?php
				if(isset($_POST['elimina'])){
					$sql= "DELETE FROM products WHERE cod=:id";
					$resultado=$connect->prepare($sql);  //$base guarda la conexión a la base de datos
    				$resultado->execute(array(":id"=>$id));
					echo '<script> alert ("Se borró el producto");</script>';
					echo '<script>window.location="../prod.php"</script>';
				}
			}
			?>	
	
		</div>
    </div>
</body>
</html>