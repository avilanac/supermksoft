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
                <form method="get">
                    <?php
						$busca=$_GET["id"];

						try{
						$connect=new PDO("mysql:host=localhost;dbname=supermk", "root", "");//pdo es la clase
						$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//muestra el tipo de error
						$connect->exec("set character set utf8");
						//echo "Conexión exitosa";
						$sql="SELECT  * from invoice where numb=:id";//consulta con marcador, el marcador es :codigo
						
						$resultado=$connect->prepare($sql);//el objeto $base llama al metodo prepare que recibe por parametro la instrucción sql, el metodo prepare devuelve un objeto de tipo PDO que se almacena en la variable resultado
						$resultado->execute(array(":id"=>$busca));
							if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
						
								$fact=$registro['numb'];
                                $idcus=$registro['id_cus'];
								$date=$registro['fech'];
								$usu=$registro['id_usu'];
                                $total=$registro['value'];

                                $sql="SELECT * from customers where id_cus=:id";
                                $resultado=$connect->prepare($sql);
                                $resultado->execute(array(":id"=>$idcus));
                                $regis=$resultado->fetch(PDO::FETCH_ASSOC);

                                $sql="SELECT * from users where id_usu=:id";
                                $resultado=$connect->prepare($sql);
                                $resultado->execute(array(":id"=>$usu));
                                $regisu=$resultado->fetch(PDO::FETCH_ASSOC);
						?>

                    <div class="col-md-10 col-sm-2 ">
                        <div id="formLogin4">
                            <img src="../img/head3.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm"><br><br><h6 align="center">Supermercado XYZ</h6>
                            <h6 align="center"><b>Factura N° <?php echo $fact?></b></h6>
                            <h6 align="center"><b>Fecha: <?php echo $date ?></b></h6>
                            <h6 align="center">Vendedor: <?php echo $regisu['nameu'] ?></h6>
                            <br>
                            <h5 >Cliente</h5>
                            <table class="table">
                                <tr>
                                    <td colspan="2">Identificación: <?php echo $registro['id_cus']?></td>
                                </tr>
                                <tr>
                                    <td>Nombre: <?php echo $regis['namec']?> <?php echo $regis['lastna']?></td>
                                </tr>
                                
                            </table>
                            
                            <h6 align="center">DETALLE DE PRODUCTOS</h6>
                            <br>
                            
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
                            <tr>
                                <td align="center">
                                    <input  class="btn btn-success" type='button' onclick='window.print();' value='Imprimir'>
                                    <a href="verpdf.php"><input class="btn btn-danger" type="button" name="pdf"  value="PDF"></a>
                                    <a href="invo.php"><input class="btn btn-secondary" type="button" name="pdf"  value="Volver"></a>
                                </td>
                            </tr>
                        </table>
                        <?php
	}else{
		echo "No existe la matrícula $busca";
	}

	$resultado->closeCursor();

}catch(Exception $e){
	die("Error: ". $e->GetMessage());

}finally{
	$connect=null;//vaciar memoria
}


?>	
                    </form>
                </div>    
            </div>
        </section>
</body>
</html>