<?php 
    session_start();
    include("../includes/validarsession.php");

    require_once("../connection/connection.php");

        $doc=$_SESSION['doc'];
        $rol=$_SESSION['rol'];
        $name=$_SESSION['nameu']; 
        
        $doc=$_GET['id'];

        $sql="SELECT  * from customers  where id_cus=:id";
        $resultado=$connect->prepare($sql);
        $resultado->execute(array(":id"=>$doc));
        $reg=$resultado->fetch(PDO::FETCH_ASSOC);

        $idcust=$reg['id_cus'];
        $nom=$reg['namec'];
        $ape=$reg['lastna'];

        $sql= "SELECT * FROM roles where id_rol = :ro"; 
        $resultado=$connect->prepare($sql);
        $resultado->execute(array(":ro" => $rol));
        $re=$resultado->fetch(PDO::FETCH_ASSOC);

        $nomrol=$re["rol"];
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
    <link rel="icon" href="../img/head3.png">
	<title>Factura</title>
    <title>Bienvenido</title>
</head>
<body>
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
                                    <ion-icon name="cart-sharp"></ion-icon><a href="invo.php">Facturar</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div> 
                
                <!-- Content -->
                <div class="col-md-10 col-sm-2 ">
                    <div class="row py-3 ">
                        <di class="container">
                        
                        <form action="temp.php" method="GET">
                            
                            <div class="input-group col-md-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Vendedor</div>
                                </div>
                                <input type="text" class="form-control" name="ape" readonly  value="<?php echo $name?>" >
                            
                                </div>
                            </div>
                            <br>
                            <div class="col-auto">
                                <div class="col-sm-9" id="title">
                                    <h5 class="mb-0 ">Datos Cliente</h5>
                                </div>
                            </div>
                            <br>
                            <div class="col-auto">
                                <div class="input-group col-md-6">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Documento</div>
                                    </div>
                                    <input type="number" class="form-control" name="id" readonly value="<?php echo $idcust?>">
                                </div>
                            </div>
                            <br>
                            <div class="col-auto">
                                <div class="input-group col-md-6">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Nombres</div>
                                    </div>
                                    <input type="text" class="form-control" name="nom" readonly  value="<?php echo $nom?>" >
                                </div>
                            </div>
                            <br>
                            <div class="col-auto">
                                <div class="input-group col-md-6">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Apellidos</div>
                                    </div>
                                    <input type="text" class="form-control" name="ape" readonly  value="<?php echo $ape?>" >
                                </div>
                            </div>
                            <br>
                            <div class="col-auto">
                                <div class="input-group col-md-6 align-items-right">
                                    <input type="submit" name="cargar" class="btn btn-danger" value="Agregar">
                                </div>
                            </div> 
                        </form>
                        </di>
                    </div>                
                </div>
            </div>
        </section>
</body>
</html>