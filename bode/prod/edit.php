<?php 
    session_start();
    include("../../includes/validarsession.php");


    require_once("../../connection/connection.php");

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
    <link rel="stylesheet" href="../../css/style2.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/487a939f8b.js" crossorigin="anonymous"></script>
    <title>Usuarios</title>
</head>
<body>

    <div class="container-fluid bcontent">
        <nav class="navbar navbar-expand-lg w-100 navbar-white bg-white">
            <a class="navbar-brand" href="#">
                <img src="../../img/head3.png" width="150" height="100" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               
                <form class="form-inline my-2 ml-auto" action="../../includes/close.php">
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
                        <div class="profile-name">Administrador</div>
                        <div class="profile-name"><?php include ("../../includes/date.php"); echo fecha();?></div>
                    </div>

                    <!-- Sidebar menu -->
                    <nav class="profile-menu">
                        <ul class="nav navbar vertical">
                            <li class="nav-item">
                                <ion-icon name="people-sharp"></ion-icon><a href="../users.php">Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <ion-icon name="business-sharp"></ion-icon><a href="../provi.php">Proveedores</a>
                            </li>
                            <li class="nav-item">
                                <ion-icon name="star-sharp"></ion-icon><a href="../prod.php">Inventario</a>
                            </li>
                            <li class="nav-item">
                                <ion-icon name="person-add-sharp"></ion-icon><a href="../cust.php">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <ion-icon name="cart-sharp"></ion-icon><a href="../invo.php">Facturas</a>
                            </li>
                        </ul>
                    </nav>
            </div>
        </div>

        <!-- Content -->

        <?php
	
	$busca=$_GET["id"];

try{
$connect=new PDO("mysql:host=localhost;dbname=supermk", "root", "");//pdo es la clase
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//muestra el tipo de error
$connect->exec("set character set utf8");
//echo "Conexión exitosa";
$sql="SELECT  * from products  where cod=:id";//consulta con marcador, el marcador es :codigo

$resultado=$connect->prepare($sql);//el objeto $base llama al metodo prepare que recibe por parametro la instrucción sql, el metodo prepare devuelve un objeto de tipo PDO que se almacena en la variable resultado
$resultado->execute(array(":id"=>$busca));
	if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){

?>
        <div class="col-md-10 col-sm-2 ">
            <div class="row py-3 ">
                <div class="container">                    
                    <form action="update.php" method="POST">
                        <div class="col-auto">
                            <div class="col-sm-9" id="title">
                                <h5 class="mb-0 ">Editar producto</h5>
                            </div>
                        </div>
                        <br>
                        <div class="col-auto">
                            <div class="input-group col-md-6">
                                <div class="input-group-prepend">
                                <div class="input-group-text">Código</div>
                                </div>
                                <input type="varchar" class="form-control" name="id" value="<?php echo $registro['cod']?>">
                            </div>
                        </div>
                        <br>
                        <div class="col-auto">
                            <div class="input-group col-md-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Nombre</div>
                                </div>
                                <input type="text" class="form-control" name="prod" value="<?php echo $registro['prod']?>">
                            </div>
                        </div>
                       
                        <br>
                        <div class="col-auto">
                            <div class="input-group col-md-6">
                                <div class="input-group-prepend">
                                <div class="input-group-text">Precio Comp.</div>
                                </div>
                                <input type="number" class="form-control" name="pre" value="<?php echo $registro['price_buy']?>">
                            </div>
                        </div>
                        <br>
                        <div class="col-auto">
                            <div class="input-group col-md-6">
                                <div class="input-group-prepend">
                                <div class="input-group-text">Precio venta</div>
                                </div>
                                <input type="number" class="form-control" name="prsale" value="<?php echo $registro['price_sale']?>">
                            </div>
                        </div>
                        <br>
                        <div class="col-auto">
                            <div class="input-group col-md-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Proveedor</div>
                                </div>

                            <select class="custom-select" name="nit" id="inputGroupSelect01">
                                <?php
                                $sql= "SELECT * FROM providers"; 
                                $resultado=$connect->prepare($sql);
                                $resultado->execute(array());
                                while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?php echo $registro['nit'];?>"><?php echo $registro['namep']?></option>
                                <?php
                                }			

                                ?>
                            </select>
                            </div>
                        </div>
                        <br>
                        <div class="col-auto">
                            <div class="input-group col-md-6 align-items-right">
                                <input type="submit" name="edita" class="btn btn-success" id="sdita" value="Guardar">
                                
                                <a href="../prod.php"><input type="button" name="volver" class="btn btn-secondary" id="elimina" value="Volver"></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>                
        </div>
    </section>
    <?php
}else{
    echo "No existe producto con código $busca";
}

$resultado->closeCursor();

}catch(Exception $e){
die("Error: ". $e->GetMessage());

}finally{
$connect=null;//vaciar memoria
}


?>

</body>
</html>