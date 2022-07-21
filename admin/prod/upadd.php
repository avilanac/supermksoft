
					<?php
					require("../../connection/connection.php");

					$cod=$_POST['id'];
					$quant=$_POST['quant'];
					$entr=$_POST['entr'];
					$actual=$quant+$entr;


					$sql="UPDATE products SET entrada=:en, quant=:qu WHERE cod=:id";
					$resultado=$connect->prepare($sql);  
					$resultado->execute(array(":id"=>$cod, ":en"=>$entr, ":qu"=>$actual));
					
					header("Location: ../prod.php");
					?>
					
