
			<?php
			include("../connection/connection.php");

				$sql="DELETE from temp";
				$resultado=$connect->prepare($sql); 
				$resultado->execute(array());

				header("Location:invo.php");
				
			?>		
	
		