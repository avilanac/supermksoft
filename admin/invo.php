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
    <title>Facturas</title>
</head>
<body>
<?php
include("../connection/connection.php");

$regis = 5;
if(isset($_GET["pagina"])){
    if($_GET["pagina"]==1){
        header("Location:invo.php");
    }else{
        $pagina=$_GET["pagina"];
    }
}else{
    $pagina=1;//muestra página en la que estamos cuando se carga por primera vez
}
$empieza=($pagina-1)*$regis;

$sql= 'SELECT * FROM invoice';
$senten=$connect->prepare($sql);
$senten->execute();
$registros=$senten->fetchALL();

$totalregis=$senten->rowCount();

$paginas = $totalregis/$regis;
$paginas = ceil($paginas);

$regis=$connect->query("SELECT * from invoice LIMIT $empieza, $regis")->fetchALL(PDO::FETCH_OBJ);

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
            <br>
                <div class="col-sm-9" id="title">
                    <h3 class="mb-0 ">Facturas Generadas</h3>
                </div><br>
            
                <!-- table -->             
                <div class="table-responsive-xxl table-sm">
                    <table class="table table-bordered border-danger table-striped ">
                        <thead >
                            <tr class="table-success text-center">
                                <th>N. Fact.</th>
                                <th>Fecha</th>
                                <th>Vendedor</th>
                                <th>Cliente</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>                                
                                <th>Valor Total</th>
                                <th>Estado</th>  
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            //por cada objeto que hay dentro del array repite el código
                            foreach ($regis as $invoice) :?> 
                            <?php 
                            $id=$invoice->id_usu;
							$sql="SELECT * FROM users WHERE id_usu=:id";
							$resultado=$connect->prepare($sql);
							$resultado->execute(array(":id"=>$id));
							$regis=$resultado->fetch(PDO::FETCH_ASSOC);

                            $idc=$invoice->id_cus;
							$sql="SELECT * FROM customers WHERE id_cus=:id";
							$resultado=$connect->prepare($sql);
							$resultado->execute(array(":id"=>$idc));
							$regisc=$resultado->fetch(PDO::FETCH_ASSOC);

                            $est=$invoice->id_esta;
							$sql="SELECT * FROM estados WHERE id_esta=:id";
							$resultado=$connect->prepare($sql);
							$resultado->execute(array(":id"=>$est));
							$reg=$resultado->fetch(PDO::FETCH_ASSOC);
                            ?>
                            
                            <tr class="table-light" >
                                <td><?php echo $invoice->numb?></td>
                                <td><?php echo $invoice->fech?></td>
                                <td><?php echo $regis['nameu']?></td>
                                <td><?php echo $invoice->id_cus?></td>
                                <td><?php echo $regisc['namec']?></td>
                                <td><?php echo $regisc['lastna']?></td>
                                <td><?php echo $regisc['tel']?></td>
                                <td><?php echo $regisc['adrc']?></td>                               
                                <td><?php echo $invoice->value?></td>
                                <td><?php echo $reg['estado']?></td> 
                                
							    <td>                                
                                    
                                    <a target="blank" href="verpdf.php?id=<?php echo $invoice->numb?> & fech=<?php echo $invoice->fech?>& nomc=<?php echo $invoice->id_cus?> & nomu=<?php echo $regis['nameu']?> & tot=<?php echo $invoice->value?>"><button type="button" class="btn btn-danger" >PDF</button> </a>
                                </td>
                            <?php
                                endforeach;
                            ?>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo $pagina<=1? 'disabled' : '' ?>">
                                    <a class="page-link" href="invo.php?pagina=<?php echo $pagina-1 ?>">Anterior</a>
                            </li>
                            <?php
                                for($i=0; $i<$paginas; $i++):?>
                                    <li class="page-item <?php echo $pagina==$i+1? 'active': ''?>">
                                        <a class="page-link" 
                                        href="invo.php?pagina=<?php echo $i+1?>">
                                    <?php echo $i+1?></a>
                                    </li>
                                    <?php endfor?>
                            <li class="page-item <?php  echo $pagina>=$paginas? 'disabled' : '' ?> "><a class="page-link" href="invo.php?pagina=<?php echo $pagina+1 ?>">Siguiente</a></li>
                        </ul>
                    </nav>
                </div>
            
        </div>
    </section>
</body>
</html>