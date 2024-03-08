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

                                        header("Location: viewinvo.php");
    ?>
   