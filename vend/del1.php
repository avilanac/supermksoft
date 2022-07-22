
			<?php
			session_start();
			include("../connection/connection.php");

			$doc=$_SESSION['doc'];

			$sql="DELETE from temp WHERE id_user=:er";
			$resultado=$connect->prepare($sql); 
			$resultado->execute(array(":er"=>$doc));

			header("Location:invo.php");
				
			?>		
	
		