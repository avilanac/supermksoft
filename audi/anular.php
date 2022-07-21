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
		<h6 align="center"><?php include ("../includes/date.php"); echo fecha();?></h6>	
		<div class="media d-flex align-items-center"><img src="../img/head3.png" width="150" height="100" alt="">
	</div>
	<br>
            <form method="post">
				<h6 align="center">Se va a anular la factura. Si está seguro presione el Botón "Anular", de lo contrario presione "Volver".</h6><br>
				<div class="container-fluid h-100"> 
					<div class="row w-100 align-items-center">
						<div class="col text-center">
							<input type="submit" name="anular" id="elimina" class="btn btn-danger" value="Anular">
							<a href="invo.php"><input type="button" name="volver" class="btn btn-secondary" id="elimina" value="Volver"></a>
						</div>	
					</div>
    			</div>			
			</form>
			<br>
			<?php
			include("../connection/connection.php");

			$id=$_GET["id"];
			$esta1= 2;
			
			if(isset($_POST['anular'])){

                $sql="UPDATE invoice SET id_esta = $esta1 where numb=$id";
                $resultado=$connect->prepare($sql); 
				$resultado->execute(array());
                echo '<script> alert ("Se anulo la factura");</script>';
                echo '<script>window.location="invo.php"</script>';

                $pro=$connect->query("SELECT * from detail where numb=$id ")->fetchALL(PDO::FETCH_OBJ);
                        
                foreach ($pro as $detail) :
                    $codp= $detail->cod;
                    $cantp= $detail->cantp;

                    $sql="SELECT * from products where cod=:cod";
                    $existencia=$connect->prepare($sql);
                    $existencia->execute(array(":cod"=>$codp));
                    $exist=$existencia->fetch(PDO::FETCH_ASSOC);
                    
                    $antes=$exist['quant'];
                          
                    $actual= $antes + $cantp;
                                    
                    $sql="UPDATE products set quant=:qu WHERE cod =:co";
                    $resultado=$connect->prepare($sql); 
                    $resultado->execute(array(":co"=>$codp, ":qu"=>$actual));                                
                endforeach;
			}
			?>		
	
		</div>
    </div>
</body>
</html>