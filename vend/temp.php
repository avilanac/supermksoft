<?php 
    session_start();
    include("../includes/validarsession.php");


    require_once("../connection/connection.php");

        $doc=$_SESSION['doc'];
        $rol=$_SESSION['rol'];
        $name=$_SESSION['nameu'];  
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
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" autocomplete="off">
        <?php
		require("../connection/connection.php");
		
		if(!isset($_GET["buscarm"]) and !isset($_GET['agr'])){

			$idcust=$_GET['id'];
            $_SESSION['idc']=$idcust;
            $idc=$_SESSION['idc'];

            $nom=$_GET['nom'];
            $_SESSION['nam']=$nom;
            $nam=$_SESSION['nam'];

            $ape=$_GET['ape'];
            $_SESSION['last']=$ape;
            $last=$_SESSION['last'];
            			
		}else{

			$idcust=$_GET['id'];
            $_SESSION['idc']=$idcust;
            $idc=$_SESSION['idc'];

            $nom=$_GET['nom'];
            $_SESSION['nam']=$nom;
            $nam=$_SESSION['nam'];

            $ape=$_GET['ape'];
            $_SESSION['last']=$ape;
            $last=$_SESSION['last'];			
		}	
		?>
       
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
                                <li class="nav-item">
                                    <ion-icon name="person-add-sharp"></ion-icon><a href="cust.php">Clientes</a>
                                </li>
                                <li class="nav-item">
                                    <ion-icon name="star-sharp"></ion-icon><a href="prod.php">Inventario</a>
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
                                    <div class="col-auto">
                                        <div class="input-group col-md-6">
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
                                                    
                                         <div class="col-sm-9" id="title">
                                            <h5 class="mb-0 ">Agregar Productos</h5>
                                         </div>
                                         <br>
                                         <div class="col-sm-9" id="title">
                                            <h6 class="mb-0 ">Buscar</h6>
                                         </div>
                                    </div>
                                     <br>
                                     <div class="col-auto">
                                        <div class="input-group col-md-6">
                                            <div class="input-group-prepend">
                                                    <label class="input-group-text" for="inputGroupSelect01">Código Producto</label>
                                            </div>
                                            <div class="input-group-prepend">
                                                    <input type="varchar" name="codi" id="codi" >
                                            </div>
                                            <!-- Agregamos el botón al lado del input -->
                                            <div class="input-group-append">
                                            <a href="prod.php" target="_blank">
                                                <button class="btn btn-danger" type="button" id="buscar">Ver códigos
                                                </button>
                                            </a>
                                            </div>
                                        </div>
                                     </div>
                                    <br>
                                    <div class="col-auto">
                                        <div class="input-group col-md-6 align-items-right">
                                            <input type="submit" name="buscarm" class="btn btn-success" id="buscar" value="Ingresar">
                                        </div>
                                    </div>
                                    <br>
                                <?php
                                    if(isset($_GET['buscarm'])){
                                        $busca=$_GET['codi'];
                                        $sql="SELECT  * from products  where cod=:co";
                                        $resultado=$connect->prepare($sql);
                                        $resultado->execute(array(":co"=>$busca));
                                        if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){

                                    ?>
                                    <div class="col-auto">
                                        <table class="table table-bordered border-danger">
                                            <thead class="table-success text-center">
                                                <th>Código</th>
                                                <th>Producto</th>
                                                <th>Precio Unt.</th>
                                                <th>Cantidad</th>
                                                <th>Acción</th>
                                            </thead>
                                            <tbody>
                                                <td><input type="varchar" name="cod" readonly value="<?php echo $registro['cod'];?>"></td>
                                                <td><input type="text" name="prod" readonly value="<?php echo $registro['prod'];?>"></td>
                                                <td><input type="number" name="pre" readonly value="<?php echo $registro['price_sale'];?>"></td>
                                                <td><input type="number" required name="cant" placeholder="Ingrese"></td>
                                                <td>
                                                    <div class="col-auto">
                                                        <div class="input-group col-md-6 align-items-right">
                                                            <input type="submit" name="agr" class="btn btn-danger" value="Agregar">
                                                        </div>
                                                    </div>
                                                </td> 
                                            </tbody>  
                                        </table>
                                    </div>                                    
                                    <input type="hidden" name="codm" value="<?php echo $registro['cod'];?>"> 
                                    <?php 
                                        }
                                    }
                                   
                                    if(isset($_GET['agr'])){ 

                                        $cod=$_GET['codm'];
                                        $prod=$_GET['prod'];
                                        $pre=$_GET['pre'];
                                        $cant=$_GET['cant'];
                                        $pricep=$pre*$cant;
                                        
                                        $sql="SELECT * FROM products WHERE cod=:id";
                                        $resultado=$connect->prepare($sql);
                                        $resultado->execute(array(":id"=>$cod));
                                        $regis=$resultado->fetch(PDO::FETCH_ASSOC);

                                        $exist = $regis['quant'];
                                        
                                        if($exist<$cant){
                                            ?>
                                            <div class="container">
                                                <div class="alert alert-danger">
                                                    La cantidad excede las existencias del producto. <strong>Hay disponible: <?php echo $exist;?> und(s). </strong>
                                                </div>
                                            </div>
                    
                                        <?php
                                        }else{

                                            $pricep=$pre*$cant;                                       
                                            $sql1="INSERT INTO temp (cod, pricep, cantp, id_user) values (:co, :pr, :ca, :us)";
                                            $result=$connect->prepare($sql1);
                                            $result->execute(array(":co"=>$cod, ":pr"=>$pricep, ":ca"=>$cant, ":us"=>$doc));
                                        }
                                    }
                                    $registros=$connect->query("SELECT * from temp")->fetchALL(PDO::FETCH_OBJ);
                                    ?>
                                    <div class="col-auto">
                                        <table class="table table-bordered border-success">
                                            <thead class="table-success text-center">
                                                <th>Código</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unt.</th>
                                                <th>Valor total</th>
                                                <th>Acción</th>
                                                
                                            </thead>
                                            <?php
                                            $contador=0;
                                            $total=0;
                                            foreach ($registros as $temp) : 

                                                if($doc == $temp->id_user and $temp->pricep){
                                            ?>                                      
                                            <tbody class="text-center">                                      
                                                    
                                                <?php 
                                                $codp=$temp->cod;
                                                $sql="SELECT prod, price_sale, quant from products WHERE cod = :co";
                                                $resultado=$connect->prepare($sql);
                                                $resultado->execute(array(":co"=>$codp));
                                                $registro=$resultado->fetch(PDO::FETCH_ASSOC);
                                                
                                                $det=$temp->id_deta;
                                                $sql1="SELECT cod, pricep, cantp from temp WHERE id_deta = :te";
                                                $resultado=$connect->prepare($sql1);
                                                $resultado->execute(array(":te"=>$det));
                                                $reg=$resultado->fetch(PDO::FETCH_ASSOC);
                                                $total = $total + $reg['pricep'];
                                                $codpro=$reg['cod'];
                                                ?>

                                                <td><?php echo $temp->cod?></td>                                               
                                                <td><?php echo $registro['prod'];?></td>
                                                <td><?php echo $reg['cantp'];?></td>
                                                <td><?php echo $registro['price_sale'];?></td>
                                                <td><?php echo $reg['pricep'];?></td>  

                                                <?php $idtemp=$temp->id_deta; ?>                                               
                                                
                                                <td>
                                                    <a href="delete.php?id=<?php echo $idtemp?> &doc=<?php echo $idc?> &nomc=<?php echo $nam?> &apec=<?php echo $last?>">
                                                        <button type="button" class="btn btn-sm btn-danger text-center">X</button>
                                                    </a>
                                                </td>
                                                <?php $contador=$contador+1;?> 
                                            </tbody>
                                            <?php
                                                }
                                            endforeach;
                                            ?>
                                        </table>     
                                        <br>
                                        <h6>Productos agregados: <?php echo $contador;?></h6>    
                                        <br>
                                        <h5>Total a pagar: $ <?php echo $total;?></h5>
                                        
                                       
                                        <form  name="form1" method="post" action=" ">
                                            <div class="container-fluid h-100"> 
                                                <div class="row w-100 align-items-center">
                                                    <div class="col text-center">
                                                    <?php 				
                                                        echo "Se va a generar una FACTURA a nombre del(la) CLIENTE '<b>'$nom $ape '</b>', de '<b>' $contador '</b>' productos'.
                                                        '</br>' Si está seguro presione 'Facturar' de lo contrario 'Volver'" ; ?>
                                                        <br><br>
                                                        <a href="fact.php?id=<?php echo $idcust?> & nom=<?php echo $nom?> & ape=<?php echo $ape?> & total=<?php echo $total?> & cod=<?php echo $codpro?> & contador=<?php echo $contador?> & iduser=<?php echo $doc?> & usuario=<?php echo $name?>"><input type="button" class="btn btn-sm btn-danger" name="fact" value="Facturar"></input></a>
                                                        <a href="del1.php"><input type="button" name="volver" class="btn btn-secondary" id="elimina" value="Volver"></a>
                                                    </div>	
                                                </div>
                                            </div>
                                        </form>                             
                                    </div>
                                  
                        </div>
                    </div>                
                </div>
            </div>
        </section>
    </form>
</body>
</html>