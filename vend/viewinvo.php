<?php 
    session_start();
    include("../includes/validarsession.php");


    require_once("../connection/connection.php");

        $doc=$_SESSION['doc'];
        $rol=$_SESSION['rol'];
        $name=$_SESSION['nameu'];        
    ?>
    <?php
                                    require("../connection/connection.php");
                                    
                                    //consuta el último número de matricula generado
                                    $sql = "SELECT MAX(numb) as last_id FROM invoice";
                                    $resultado=$connect->prepare($sql);
                                    $resultado->execute(array());
                                    $registro=$resultado->fetch(PDO::FETCH_ASSOC);
                                    $fact=$registro['last_id'];//ultimo id creado
                                    
                                    //consulta los datos  de la última matricula generada
                                    $sql="SELECT  * from invoice where numb=:nm";
                                    $resultado=$connect->prepare($sql);
                                    $resultado->execute(array(":nm"=>$fact));
                                    $registro=$resultado->fetch(PDO::FETCH_ASSOC);
                                    $idcus=$registro['id_cus'];
                                    $date=$registro['fech'];
                                    $total=$registro['value'];
                                    
                                    
                                    //consultar datos del estudiante que corresponde a la última matricula generada
                                    $sql="SELECT * from customers where id_cus=:id";
                                    $resultado=$connect->prepare($sql);
                                    $resultado->execute(array(":id"=>$idcus));
                                    $registro=$resultado->fetch(PDO::FETCH_ASSOC);
                                    
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
                <div id="formLogin4">
                    <img src="../img/head3.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm"><br><br><h6 align="center">Supermercado XYZ</h6>
                    <h6 align="center"><b>Factura N° <?php echo $fact?></b></h6>
                    <h6 align="center"><b>Fecha: <?php echo $date ?></b></h6>
                    <h6 align="center">Vendedor: <?php echo $name ?></h6>
                    <br>
                    <h5 >Cliente</h5>
                    <table class="table">
                        <tr>
                             <td colspan="2">Identificación: <?php echo $registro['id_cus']?></td>
                         </tr>
                        <tr>
                             <td>Nombre: <?php echo $registro['namec']?> <?php echo $registro['lastna']?></td>
                         </tr>
                         <tr>
                             <td>Telefono: <?php echo $registro['tel']?> Dirección: <?php echo $registro['adrc']?></td>
                         </tr>
                         <tr>
                             <td>Funcionario: <?php echo $name ?></td>
                         </tr>
                     </table>
                      
                    
                    
                    <form method="get">
                        
                                    <h6 align="center">DETALLE DE PRODUCTOS</h6>
                                    <br>
                                    <div class="table-responsive-xxl">

                                    </div>
                                    <table class="table">
                                        <thead class="table-danger">
                                            <th>Código</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unt.</th>
                                            <th>Valor total</th>	
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <?php
                                            //consulta a la tabla detallefactura
                                                $regisdet=$connect->query("SELECT * from detail where numb=$fact ")->fetchALL(PDO::FETCH_OBJ);
                                                $cuenta=0;
                                                foreach ($regisdet as $detail) :?> 
                                               
                                                <?php
                                               
                                                $codigom=$detail->cod;                                           
                                            
                                                //consulto el nombre de la materia en la tabla materia
                                                $sql="SELECT prod, price_sale  from products where cod=:co";
                                                $resultado=$connect->prepare($sql);
                                                $resultado->execute(array(":co"=>$codigom));
                                                $regist=$resultado->fetch(PDO::FETCH_ASSOC);
                                            
                                            ?>
                                                <td><?php echo $detail->cod?></td>                                               
                                                <td><?php echo $regist['prod'];?></td>
                                                <td><?php echo $detail->cantp;?></td>
                                                <td><?php echo $regist['price_sale'];?></td>
                                                <td><?php echo $detail->pricep;?></td>
                                            <?php
                                            $cuenta=$cuenta+1
                                            ?>
                                            </div></td></tr>
                                            
                                            <?php
                                             
                                            endforeach;
                                       
                                                ?>
                                        </tbody>
                                        
                                    <td colspan="5">
                                        <div style='text-align:left'><b>Productos: <?php echo " ", $cuenta;?></b></div>
                                        <div style='text-align:right'><b>Total a pagar: $ <?php echo " ", $total;?></b></div>                       
                                    </td>                                    
                                </table>
                                    <tr><td align="center">
                                        
                                        <a target="black" href="verpdf.php?id=<?php echo $fact?>"><input class="btn btn-danger" type="button" name="pdf"  value="PDF"></a>
                                        <a href="invo.php?iduser=<?php echo $doc?> & nombaux=<?php echo $name?>"><input type="button" class="btn btn-success" name="vuelve" value="Nueva Factura"></a></td></tr>
                            
                                        </td>
                                    </tr>
                        </table>	
                    </form>
                </div>  
            </div>
        </section>
</body>
</html>