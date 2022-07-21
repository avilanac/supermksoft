  <?php
  
  	require '../fpdf/fpdf.php';
  	
	require("../connection/connection.php");      
	include("../connection/connection.php");
	$id=$_GET["id"];       
	       
    		$sql="SELECT  * from invoice where numb=:nf";
        	$resultado=$connect->prepare($sql);
        	$resultado->execute(array(":nf"=>$id));
	   		$registro=$resultado->fetch(PDO::FETCH_ASSOC);

	   		$fact=$registro['numb'];
	   		$idcus=$registro['id_cus'];
	   		$date=$registro['fech'];
	   		$total=$registro['value'];
	   		$idusu=$registro['id_usu'];

	   		//consultar datos del cliente que corresponde a la última factura generada
	   		$sql="SELECT * from customers where id_cus=:id";
	   		$resultado=$connect->prepare($sql);
	   		$resultado->execute(array(":id"=>$idcus));
	   		$registro=$resultado->fetch(PDO::FETCH_ASSOC);

	   		
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->SetXY(70,15);//alinea la próxima celda a 50 p sobre el eje X y a 50 p sobre el eje y
$pdf->Image('../img/head3.png',15,10,30);
$pdf->Cell(55, 10, 'SUPERMERCADO XYZ',0, 1, 'R');//celda de ancho 30, alto 10 relleno 1 con un salto de línea texto alineado a la derecha
$pdf->SetFont('Arial','',10);
$pdf->SetXY(72,20);
$pdf->Cell(50, 10,'IBAGUE',0, 1,'C');
$pdf->SetXY(120,30);
$pdf->Cell(50, 10, 'FACTURA No',0, 0, 'R');
$pdf->SetXY(120,30);
$pdf->Cell(55, 10, $fact,0, 1, 'R');
$pdf->SetXY(110,40);
$pdf->Cell(50,10, 'FECHA',0, 0, 'R');
$pdf->Cell(35, 10, $date,0, 1, 'R');
$pdf->SetFont('Arial','B',14);
$pdf->SetXY(72,50);
$pdf->Cell(50, 10,'DATOS DEL CLIENTE',0, 1,'C');
$pdf->SetFont('Arial','',12);
$pdf->SetXY(20,60);
$pdf->Cell(60, 10,utf8_decode('Identificación:'),0, 0,'C');
$pdf->Cell(1, 10,$registro['id_cus'],0, 1,'R');
$pdf->SetXY(14,65);
$pdf->Cell(62, 10,'Nombre:',0, 0,'C');
$pdf->Cell(1, 10,utf8_decode($registro['namec']),0, 0,'R');
$pdf->Cell(70, 10,'Apellido:',0, 0,'C');
$pdf->Cell(1, 10,$registro['lastna'],0, 1,'R');
$pdf->SetXY(14,70);
$pdf->Cell(65, 10,utf8_decode('Dirección:'),0, 0,'C');
$pdf->Cell(1, 10,$registro['adrc'],0, 0,'R');
$pdf->Cell(65, 10,utf8_decode('Teléfono:'),0, 0,'C');
$pdf->Cell(2, 10,$registro['tel'],0, 1,'R');

$sql="SELECT  * from users where id_usu=:iu";
$resultado=$connect->prepare($sql);
$resultado->execute(array(":iu"=>$idusu));
$regiusu=$resultado->fetch(PDO::FETCH_ASSOC);

$pdf->Cell(47, 10,('Vendedor'),0, 0,'R');
$pdf->Cell(20, 10, $regiusu['nameu'],0, 1,'R');
$pdf->SetFont('Arial','B',14);
$pdf->setXY(72,80);

$pdf->Cell(50,30,'DETALLE DE PRODUCTOS',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->setXY(10,85);
$pdf->Cell(55, 45,utf8_decode('Código'),0, 0,'C');
$pdf->Cell(1, 45,('Nombre'),0, 0,'C');
$pdf->Cell(55, 45,('Cantidad'),0, 0,'C');
$pdf->Cell(10, 45,('V/Unitario'),0, 0,'C');
$pdf->Cell(40, 45,('V/Total'),0, 1,'C');
$pdf->setXY(10,112);

$regisdet=$connect->query("SELECT * from detail where numb=$fact ")->fetchALL(PDO::FETCH_OBJ);		
foreach ($regisdet as $products) :
$codigo=$products->cod;
$cantidad=$products->cantp;
$precio_venta=$products->pricep;
			
$pdf->SetFont('Arial','',12);
//$pdf->Cell(50, 8, $producto->codproducto,0, 0,'C');

$sql="SELECT prod, price_sale  from products where cod=:co";
$resultado=$connect->prepare($sql);
$resultado->execute(array(":co"=>$codigo));
$regisp=$resultado->fetch(PDO::FETCH_ASSOC);
$nombre=$regisp['prod'];
$precio=$regisp['price_sale'];

//$pdf->Cell(12, 8, $registrop['nombre'],0, 1,'C');
//$pdf->Cell(89,1, $producto->cantidad,0,0,'R');
//$pdf->Cell(30,1, $registrop['precio'],0,1,'R');
//$pdf->Cell(150,1,$producto->precio_venta,0,1,'R');
$pdf->Cell(50, 8, $codigo,0, 0,'C');
$pdf->Cell(12, 8, $nombre,0, 0,'C');
$pdf->Cell(42, 8, $cantidad,0, 0,'C');
$pdf->Cell(25, 8, $precio,0, 0,'C');
$pdf->Cell(25, 8, $precio_venta,0, 1,'C');


endforeach; 

$pdf->SetFont('Arial','B',12);
$pdf->Cell(133,10,'Valor Total',0,0,'R');
$pdf->Cell(15,10, '$'. $total,  0,1,'C');
$pdf->Output();
?>
	
		