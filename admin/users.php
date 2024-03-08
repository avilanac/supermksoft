<?php
    session_start();
    include("../includes/validarsession.php");


    require_once("../connection/connection.php");

        $doc=$_SESSION['doc'];
        $rol=$_SESSION['rol'];
        $name=$_SESSION['nameu'];

        $sql2= "SELECT * FROM roles where id_rol = :ro"; 
        $resultado=$connect->prepare($sql2);
        $resultado->execute(array(":ro" => $rol));
        $regi=$resultado->fetch(PDO::FETCH_ASSOC);

        $nomrol=$regi["rol"];
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
    <title>Usuarios</title>
</head>
<body>
<?php
    include("../connection/connection.php");

    $regis = 5;
    if(isset($_GET["pagina"])){
        if($_GET["pagina"]==1){
            header("Location:users.php");
        }else{
            $pagina=$_GET["pagina"];
        }
    }else{
        $pagina=1;//muestra página en la que estamos cuando se carga por primera vez
    }
    $empieza=($pagina-1)*$regis;

    $sql= 'SELECT * FROM users';
    $senten=$connect->prepare($sql);
    $senten->execute();
    $registros=$senten->fetchALL();

    $totalregis=$senten->rowCount();

    $paginas = $totalregis/$regis;
    $paginas = ceil($paginas);

    $regis=$connect->query("SELECT * from users LIMIT $empieza, $regis")->fetchALL(PDO::FETCH_OBJ);
        
        if(isset($_POST['insert'])){
            $idu=$_POST['id'];
            $rol=$_POST['rol'];
            $nombre=$_POST['nom'];
            $email=$_POST['email'];
            $user=$_POST['user'];
            $password=$_POST['pass'];
            $pass_cifrado=password_hash($password,PASSWORD_DEFAULT,array("cost"=>12));
            ?>
            <input type="number" name="idd" value="<?php echo $idu?>">
            <?php

            $sql= "SELECT * FROM users where id_usu = :id"; 
            $resultado=$connect->prepare($sql);
            $resultado->execute(array(":id"=>$idu));
            $regi=$resultado->fetch(PDO::FETCH_ASSOC);

            if($regi){
                echo "<script>alert ('Ya existe el usuario')</script>";
                echo "<script>window.location='users.php'</script>";
            }else{
                $sql="INSERT INTO users (id_usu, id_rol, nameu, email, user, pass) values (:id, :idrol, :nom, :em, :us, :ps)";
                $resultado=$connect->prepare($sql);
                $resultado->execute(array(":id"=>$idu, ":idrol"=>$rol,":nom"=>$nombre, ":em"=>$email, ":us"=>$user, ":ps"=>$pass_cifrado));

                header("Location:users.php");
            }
        }
	?>

    <div class="container-fluid bcontent">
        <nav class="navbar navbar-expand-lg w-100 navbar-white bg-white" aria-label="">
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
                        <div class="profile-name">
                            <?php include ("../includes/date.php"); echo fecha();?>
                        </div>
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
                    <h3 class="mb-0 ">Usuarios Registrados</h3>
                </div>

                <!-- Modal Insertar -->
                
                <div class="container">
                    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">Agregar</button>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Añadir Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                </div>
                                <div class="modal-body">

                                    <form method="post">
                                        <div class="form-group">
                                            <label for="id">Documento</label>
                                            <input type="number" name="id" required  class="form-control" id="input1" aria-describedby="emailHelp" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="id">Nombre completo</label>
                                            <input type="text" name="nom" required class="form-control" id="Input2" aria-describedby="emailHelp" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="id">Email</label>
                                            <input type="email" name="email" required class="form-control" id="exampleInputEmail1" 
                                                        aria-describedby="emailHelp" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="id">Nombre Usuario</label>
                                            <input type="varchar" name="user" required class="form-control" id="input3" 
                                                        aria-describedby="emailHelp" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="id">Contaseña</label>
                                            <input type="password" name="pass" required class="form-control" id="inputPassword3" placeholder="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                    <label class="input-group-text" for="inputGroupSelect01">Rol</label>
                                            </div>

                                            <select class="custom-select" required name="rol" id="inputGroupSelect01">
                                                <?php
                                                $sql= "SELECT * FROM roles"; 
                                                $resultado=$connect->prepare($sql);
                                                $resultado->execute(array());
                                                while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
                                                ?>
                                                <option value="<?php echo $registro['id_rol'];?>"><?php echo $registro['rol']?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <input  type="submit" class="btn btn-danger w-auto me-1 mb-0" name="insert" value="Guardar" >
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
                                <th>Rol</th>
                                <th>Nombre completo</th>
                                <th>Email</th>
                                <th>User</th>
                                <th>Contraseña</th>					
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            //por cada objeto que hay dentro del array repite el código
                            foreach ($regis as $users) : 

                                $id=$users->id_rol;
                                $sql="SELECT * FROM roles WHERE id_rol=:id";
                                $resultado=$connect->prepare($sql);
                                $resultado->execute(array(":id"=>$id));
                                $reg=$resultado->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr class="table-light" >
                                    <td><?php echo $users->id_usu?></td>
                                    <td><?php echo $reg['rol']?></td>
                                    <td><?php echo $users->nameu?></td>
                                    <td><?php echo $users->email?></td>
                                    <td><?php echo $users->user?></td>		
                                    <td><?php echo /*$persona->clave*/'XXXX'?></td>
                                    
							        <td>
                                        <a href="user/edit.php?id=<?php echo $users->id_usu?> & nom=<?php echo $users->nameu?> & rol=<?php echo $reg['rol']?>"><button type="button" class="btn btn-sm btn-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                    </td>
							
                                    <td>
                                        <a href="user/delete.php?id=<?php echo $users->id_usu?> & nom=<?php echo $users->nameu?>"><button type="button" class="btn btn-sm btn-danger"> <i class="fa-solid fa-trash-can"></i></button></a>
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
                            <a class="page-link" href="users.php?pagina=<?php echo $pagina-1 ?>">Anterior</a>
                    </li>
                    <?php
                        for($i=0; $i<$paginas; $i++):?>
                            <li class="page-item <?php echo $pagina==$i+1? 'active': ''?>">
                                <a class="page-link" 
                                href="users.php?pagina=<?php echo $i+1?>">
                            <?php echo $i+1?></a>
                            </li>
                            <?php endfor?>
                    <li class="page-item <?php  echo $pagina>=$paginas? 'disabled' : '' ?> "><a class="page-link" href="users.php?pagina=<?php echo $pagina+1 ?>">Siguiente</a></li>
                </ul>
            </nav>
            
        </div>
    </section>
   
</body>
</html>