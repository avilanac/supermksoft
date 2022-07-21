<?php 
    session_start();
    include("../includes/validarsession.php");


    require_once("../connection/connection.php");

        $doc=$_SESSION['doc'];
        $rol=$_SESSION['rol'];
        $name=$_SESSION['nameu'];
        $contador=$_GET['contador'];
        $total=$_GET['total'];
        $idcust=$_GET['id'];
        $nom=$_GET['nom'];
        $ape=$_GET['ape'];
        $codpro=$_GET['cod'];
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
                            <div class="profile-name">Vendedor</div>
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
                        
                        <div class="container">
                            
                                <div class="col-auto">
                                    <div class="col-sm-9" id="title">
                                        <h3 class="mb-0 ">Facturar</h3>
                                    </div>
                                    <br>
                                </div>
                                <br>
                                <div class="col">
                                        <td>
                                            <form method="post" >
                                                <div style='text-align:left'><b>Productos: <?php echo " ", $contador;?></b></div>
                                                <div style='text-align:left'><b>Total a pagar: $ <?php echo " ", $total;?></b></div>
                                                <br>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Pago en Efectivo</div>
                                                    <input type="int" name="money" class="form-control col-md-2" id="money" 
                                                            aria-describedby="money" placeholder="">
                                                    <br>
                                                    <a href="#"><input type="submit" name="camb" class="btn btn-danger" value="Cambio"></a>
                                                    <a href="del1.php"><input type="button" name="volver" class="btn btn-secondary" id="elimina" value="Volver"></a>
                                                </div>                                                
                                            </form>                                                              
                                        </td>
                                    </div> 
                                <?php
                                if(isset($_POST['camb'])){
                                    
                                    $money= 0;
                                    $money= $_POST['money'];
                                    $change= $money - $total;                                    

                                    echo '<script> alert ("CAMBIO A DEVOLVER $ '.$change.' ");</script>';
				                    echo '<script>window.location="viewinvo.php"</script>';
                                    
                                    $es=1;                                                                
                                    $sql="insert into invoice (id_cus, id_usu, value, id_esta) values (:ic, :iu, :va, :es)";
                                    $resultado=$connect->prepare($sql);
                                    $resultado->execute(array(":ic"=>$idcust, ":iu"=>$doc, ":va"=>$total, ":es"=>$es));

                                    //consultar el número de factura generada
                                    $sql = "SELECT MAX(numb) as last_id FROM invoice";
                                    $resultado=$connect->prepare($sql);
                                    $resultado->execute(array());
                                    $registro=$resultado->fetch(PDO::FETCH_ASSOC);
                                    $invo=$registro['last_id'];

                                    //ingresar el número de factura en la tabla temp
                                    $sql="UPDATE temp SET numb='$invo'";
                                    $resultado=$connect->prepare($sql); 
                                    $resultado->execute(array());

                                    // copia todos los registros de temp en detail
                                    $sql="INSERT into detail (numb, cod, pricep, cantp, id_user) select numb, cod, pricep, cantp, id_user from temp where id_user=$doc";
                                    $resultado=$connect->prepare($sql);
                                    $resultado->execute(array());

                                    //consulta a la tabla temp                            
                                    $pro=$connect->query("SELECT * from temp where numb=$invo ")->fetchALL(PDO::FETCH_OBJ);
                                
                                    foreach ($pro as $temp):
                                        $codp= $temp->cod;
                                        $cantp= $temp->cantp;

                                        $sql="SELECT * from products where cod=:cod";
                                        $existencia=$connect->prepare($sql);
                                        $existencia->execute(array(":cod"=>$codp));
                                        $exist=$existencia->fetch(PDO::FETCH_ASSOC);
                                        $antes=$exist['quant'];
                                
                                        $actual= $antes - $cantp;
                                            
                                        $sql="UPDATE products set quant=:qu WHERE cod =:co";
                                        $resultado=$connect->prepare($sql); 
                                        $resultado->execute(array(":co"=>$codp,":qu"=>$actual));                                
                                    endforeach;
                                                            
                                    //borra todos los regisros de la tabla temp
                                    $sql="DELETE from temp WHERE id_user=:er";
                                    $resultado=$connect->prepare($sql); 
                                    $resultado->execute(array(":er"=>$doc));
                                }
                            ?>     
				</div>                                
            </div>
        </section>
</body>
</html>