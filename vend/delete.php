
			<?php
			session_start();
			include("../connection/connection.php");

			$click=$_GET["id"];

			if(isset($_GET['doc'])){

				$docu=$_GET['doc'];
				$nomc=$_GET['nomc'];
				$apec=$_GET['apec'];
			}				

			$delete= "DELETE FROM temp WHERE id_deta =:id";
			$resultado=$connect->prepare($delete);
			$resultado->execute(array(":id"=>$click));
				                    				
			header("Location: temp.php?id=$docu & nom=$nomc & ape=$apec");

			
			
			
		