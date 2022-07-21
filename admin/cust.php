<?php 
    session_start();
    include("../includes/validarsession.php");


    require_once("../connection/connection.php");

        $doc=$_SESSION['doc'];
        $rol=$_SESSION['rol'];
        $name=$_SESSION['nameu'];

        $sql= "SELECT * FROM roles where id_rol = :ro"; 
        $resultado=$connect->prepare($sql);
        $resultado->execute(array(":ro" => $rol));
        $reg=$resultado->fetch(PDO::FETCH_ASSOC);

        $nomrol=$reg["rol"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/487a939f8b.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../img/head4.png">
    <title>Clientes</title>
</head>
<body>
<?php
include("../connection/connection.php");

$regis = 7;
if(isset($_GET["pagina"])){
    if($_GET["pagina"]==1){
        header("Location:cust.php");
    }else{
        $pagina=$_GET["pagina"];
    }
}else{
    $pagina=1;//muestra página en la que estamos cuando se carga por primera vez
}
$empieza=($pagina-1)*$regis;

$sql= 'SELECT * FROM customers';
$senten=$connect->prepare($sql);
$senten->execute();
$registros=$senten->fetchALL();

$totalregis=$senten->rowCount();

$paginas = $totalregis/$regis;
$paginas = ceil($paginas);

$regis=$connect->query("SELECT * from customers LIMIT $empieza, $regis")->fetchALL(PDO::FETCH_OBJ);
	
	if(isset($_POST['insert'])){
		$doc=$_POST['id'];
		$nombre=$_POST['nom'];
        $ape=$_POST['ape'];
        $tel=$_POST['tel'];
		$adre=$_POST['adre'];
		
		?>
		<input type="number" name="idd" value="<?php echo $doc?>">
		<?php 
		$sql="INSERT INTO customers (id_cus, namec, lastna, tel, adrc) values (:doc, :nom, :ap, :tel, :ad)";
		$resultado=$connect->prepare($sql);
		$resultado->execute(array(":doc"=>$doc, ":nom"=>$nombre, ":ap"=>$ape, ":tel"=>$tel,  ":ad"=>$adre));

		header("Location:cust.php");
	}
	?>

    <div class="container-fluid bcontent">
        <nav class="navbar navbar-expand-lg w-100 navbar-white bg-white">
            <a class="navbar-brand" href="#">
                <img src="../img/head3.png" width="150" height="100" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               
                <form class="form-inline my-2 ml-auto" action="../includes/close.php">
                    <a href=""><button class="btn btn-success my-2 my-sm-0" type="submit">Cerra Sesión</button></a>
                </form>
            </div>
        </nav>
    </div>
    <section class="container-full">

        <div class="row" id="full-page">

            <!-- Sidebar -->
            <div class="col-md-2 col-sm-2">
                <div class="profile-sidebar">

                    <!-- User picture -->
                    <div class="profile-userpic">
                        <h4 class="m-0"><?php echo $name;?></h4>
                    </div>

                    <!-- Sidebar title -->
                    <div class="profile-user">
                        <div class="profile-name"><?php echo $nomrol;?></div>
                        <div class="profile-name"><?php include ("../includes/date.php"); echo fecha();?></div>
                    </div>

                    <!-- Sidebar menu -->
                    <nav class="profile-menu">
                        <ul class="nav navbar vertical">
                            <li class="nav-item">
                                <ion-icon name="people-sharp"></ion-icon><a href="roles.php">Roles</a>
                            </li>
                            <li class="nav-item">
                                <ion-icon name="people-sharp"></ion-icon><a href="users.php">Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <ion-icon name="business-sharp"></ion-icon><a href="provi.php">Proveedores</a>
                            </li>
                            <li class="nav-item">
                                <ion-icon name="star-sharp"></ion-icon><a href="prod.php">Inventario</a>
                            </li>
                            <li class="nav-item">
                                <ion-icon name="person-add-sharp"></ion-icon><a href="cust.php">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <ion-icon name="cart-sharp"></ion-icon><a href="invo.php">Facturas</a>
                            </li>
                        </ul>
                    </nav>
            </div>
        </div>

        <!-- Content -->
        <div class="col-md-10 col-sm-2 ">
            <div class="row py-3 ">
                <div class="col-sm-9" id="title">
                    <h3 class="mb-0 ">Clientes Registrados</h3>
                </div>

                <!-- Modal Insertar -->
                
                <div class="container">
                    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">Registrar</button>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Registrar Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                </div>
                                <div class="modal-body">

                                    <form method="post">
                                        <div class="form-group">
                                            <label for="id">Documento</label>
                                            <input type="number" name="id" class="form-control" id="input1" aria-describedby="emailHelp" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="id">Nombres</label>
                                            <input type="text" name="nom" class="form-control" id="Input2" aria-describedby="emailHelp" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="id">Apellidos</label>
                                            <input type="text" name="ape" class="form-control" id="Input2" aria-describedby="emailHelp" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="id">Teléfono</label>
                                            <input type="number" name="tel" class="form-control" id="exampleInputEmail1" 
                                                        aria-describedby="emailHelp" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="id">Dirección</label>
                                            <input type="varchar" name="adre" class="form-control" id="input3" 
                                                        aria-describedby="emailHelp" placeholder="">
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <input  type="submit" class="btn btn-danger w-auto me-1 mb-0" name="insert" value="Insertar" >
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <!-- table -->
            <form method="post" autocomplete="off">
                
                <div class="table-responsive-xxl table-sm">
                    <table class="table table-bordered border-danger table-striped ">
                        <thead >
                            <tr class="table-success text-center">
                                <th>Documento</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>					
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            //por cada objeto que hay dentro del array repite el código
                            foreach ($registros as $customers) :?> 
                            <tr class="table-light">
                                <td><?php echo $customers->id_cus?></td> 				
                                <td><?php echo $customers->namec?></td>
                                <td><?php echo $customers->lastna?></td>
                                <td><?php echo $customers->tel?></td>
                                <td><?php echo $customers->adrc?></td>	

							    <td>
                                    <a href="cust/edit.php?id=<?php echo $customers->id_cus?> & nom=<?php echo $customers->namec?> "><button type="button" class="btn btn-sm btn-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                </td>
							
                                <td>
                                    <a href="cust/delete.php?id=<?php echo $customers->id_cus?> & nom=<?php echo $customers->namec?>"><button type="button" class="btn btn-sm btn-danger"> <i class="fa-solid fa-trash-can"></i></button></a>
                                </td>
                                   
                            <?php
                                endforeach;
                            ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $pagina<=1? 'disabled' : '' ?>">
                            <a class="page-link" href="cust.php?pagina=<?php echo $pagina-1 ?>">Anterior</a>
                    </li>
                    <?php
                        for($i=0; $i<$paginas; $i++):?>
                            <li class="page-item <?php echo $pagina==$i+1? 'active': ''?>">
                                <a class="page-link" 
                                href="cust.php?pagina=<?php echo $i+1?>">
                            <?php echo $i+1?></a>
                            </li>
                            <?php endfor?>
                    <li class="page-item <?php  echo $pagina>=$paginas? 'disabled' : '' ?> "><a class="page-link" href="users.php?pagina=<?php echo $pagina+1 ?>">Next</a></li>
                </ul>
            </nav>
            
        </div>
    </section>
   
</body>
</html>