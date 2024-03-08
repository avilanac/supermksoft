
					<?php
					require("../../connection/connection.php");

					$cod=$_POST['id'];
					$quant=$_POST['quant'];
					$entr=$_POST['entr'];
					$actual=$quant+$entr;

					if($entr < 0){
						echo "<script>alert ('No digite números negativos.')</script>";
            			echo "<script>window.location='../prod.php'</script>";
					}
					else{
						$sql="UPDATE products SET quant=:qu WHERE cod=:id";
						$resultado=$connect->prepare($sql);  
						$resultado->execute(array(":id"=>$cod, ":qu"=>$actual));
					
						header("Location: ../prod.php");
					}
					?>
					
