<?php

session_start();
if (empty($_SESSION["Usuario"])) {

    header("Location: /sysmoto/logout.php");

    exit();
}

	require_once '../funciones/conexion.php';
	$MiConexion=ConexionBD();

	$id=$_GET['id'];

	
$sqlSearch = "SELECT v.VENTA_ID as Factura, u.NOMBRE as Vendedor, dv.DETVENTA_ITEM as Articulo, a.ART_INFOADICIONAL as Descripcion,
a.ART_PRECIOCOMPRA*0.5+a.ART_PRECIOCOMPRA as Precio_unitario, (a.ART_PRECIOCOMPRA*0.5+a.ART_PRECIOCOMPRA)*COUNT(dv.DETVENTA_ITEM) as Precio_final,
v.VENTA_FECHAVENTA as Fecha_Venta, ev.ESTADOVENTA_NOMBRE as Estado_venta, c.CLIENTE_NOMBE as Cliente,
COUNT(dv.DETVENTA_ITEM) AS cantidad	
from detalleventa as dv
LEFT JOIN venta as v        ON dv.VENTA_ID = v.VENTA_ID 
LEFT JOIN usuarios as u     ON dv.ID = u.ID 
LEFT JOIN articulo as a     ON dv.ART_ID = a.ART_ID 
LEFT JOIN cliente as c      ON v.CLIENTE_ID = c.CLIENTE_ID 
LEFT JOIN estadoventa as ev ON v.ESTADOVENTA_ID = ev.ESTADOVENTA_ID 
where v.VENTA_ID = $id
GROUP BY dv.DETVENTA_ITEM";


$resBusqueda = mysqli_query($MiConexion,$sqlSearch);

$datos=array();
$i=0;
if($resBusqueda){
  
  if(mysqli_num_rows($resBusqueda)>0){

    while($row=mysqli_fetch_assoc($resBusqueda)){
      
      $datos[$i]['Factura'] = $row['Factura'];
      $datos[$i]['Vendedor'] = $row['Vendedor'];
      $datos[$i]['Articulo'] = $row['Articulo'];
      $datos[$i]['Descripcion'] = $row['Descripcion'];
      $datos[$i]['Precio_unitario'] = $row['Precio_unitario'];
      $datos[$i]['Precio_final'] = $row['Precio_final'];
      $datos[$i]['Fecha_Venta'] = $row['Fecha_Venta'];
      $datos[$i]['Estado_venta'] = $row['Estado_venta'];
      $datos[$i]['Cliente'] = $row['Cliente'];
	  $datos[$i]['Cantidad'] = $row['cantidad'];
      $i++;

    }
  }else {
    echo '<h3>No se encontraron registros</h3>';
}
} 

################################################################

	# Incluyendo librerias necesarias #
	require "./code128.php";

	$pdf = new PDF_Code128('P','mm','Letter');
	$pdf->SetMargins(17,17,17);
	$pdf->AddPage();

	# Logo de la empresa formato png #
	$pdf->Image('./img/logo.png',165,12,35,35,'PNG');

	# Encabezado y datos de la empresa #
	$pdf->SetFont('Arial','B',16);
	$pdf->SetTextColor(32,100,210);
	$pdf->Cell(150,10,utf8_decode(strtoupper("The Doctor Garage")),0,0,'L');

	$pdf->Ln(9);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(150,9,utf8_decode("Cuit: 20-12234567-9"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,utf8_decode("Santa Teresa 23- Colonia 25 de Mayo"),0,0,'L');
	$pdf->Ln(5);
	$pdf->Cell(150,9,utf8_decode("Direccion Santa Teresa 23- Colonia 25 de Mayo"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,utf8_decode("Teléfono: 0299-12312312"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,utf8_decode("Email: ventas@thedoctorgarage.com.ar"),0,0,'L');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,7,utf8_decode("Fecha de emisión:"),0,0);
	$pdf->SetTextColor(97,97,97);
	#$pdf->Cell(116,7,utf8_decode(date("d/m/Y", strtotime("13-09-2022"))." ".date("h:s A")),0,0,'L');
	$pdf->Cell(116,7,date("Y/m/d"),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(35,7,utf8_decode(strtoupper("Factura Nro. 001 -"),),0,0,'C');
	$pdf->Cell(8,7,$datos[0]['Factura'],0,0,'C',0);

	$pdf->Ln(7);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(12,7,utf8_decode("Cajero: "),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	#$pdf->Cell(134,7,utf8_decode("Carlos Alfaro"),0,0,'L');
	$pdf->Cell(8,7,$datos[0]['Vendedor'],0,0,'C',0);
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,7,utf8_decode(strtoupper("1")),0,0,'C');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(13,7,utf8_decode("Cliente:"),0,0);
	$pdf->SetTextColor(97,97,97);
	#$pdf->Cell(60,7,utf8_decode("Carlos Alfaro"),0,0,'L');
	$pdf->Cell(13,7,$datos[0]['Cliente'],0,0,'L');
	$pdf->Ln(5);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(8,7,utf8_decode("Doc: "),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,utf8_decode("DNI: 00000000"),0,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(7,7,utf8_decode("Tel:"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,7,utf8_decode("00000000"),0,0);
	$pdf->SetTextColor(39,39,51);

	$pdf->Ln(7);

	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(6,7,utf8_decode("Dir:"),0,0);
	$pdf->SetTextColor(97,97,97);
	#$pdf->Cell(109,7,utf8_decode("San Salvador, El Salvador, Centro America"),0,0);

	$pdf->Ln(9);

	# Tabla de productos #
	$pdf->SetFont('Arial','',8);
	$pdf->SetFillColor(23,83,201);
	$pdf->SetDrawColor(23,83,201);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(15,8,utf8_decode("Articulo"),1,0,'C',true);
	$pdf->Cell(98,8,utf8_decode("Descripcion"),1,0,'C',true);
	$pdf->Cell(25,8,utf8_decode("Cantidad"),1,0,'C',true);
	$pdf->Cell(19,8,utf8_decode("Precio Unitario"),1,0,'C',true);
	$pdf->Cell(32,8,utf8_decode("Subtotal"),1,0,'C',true);

	$pdf->Ln(8);

	
	$pdf->SetTextColor(39,39,51);



	for($j=0; $j<$i; $j++){
		$pdf->Cell(15,7,$datos[$j]['Articulo'],'L',0,'C');
		$pdf->Cell(98,7,$datos[$j]['Descripcion'],'L',0,'C');
		$pdf->Cell(25,7,$datos[$j]['Cantidad'],'L',0,'C');
		$pdf->Cell(19,7,$datos[$j]['Precio_unitario'],'L',0,'C');
		$pdf->Cell(32,7,$datos[$j]['Precio_final'],'LR',0,'C');
		$pdf->Ln(7);

		}

	/*----------  Detalles de la tabla  ----------
	$pdf->Cell(90,7,utf8_decode("Nombre de producto a vender"),'L',0,'C');
	$pdf->Cell(15,7,utf8_decode("7"),'L',0,'C');
	$pdf->Cell(25,7,utf8_decode("$10 USD"),'L',0,'C');
	$pdf->Cell(19,7,utf8_decode("$0.00 USD"),'L',0,'C');
	$pdf->Cell(32,7,utf8_decode("$70.00 USD"),'LR',0,'C');
	$pdf->Ln(7);
	----------  Fin Detalles de la tabla  ----------*/


	
	$pdf->SetFont('Arial','B',9);
	
	# Impuestos & totales #
	$pdf->Cell(100,7,utf8_decode(''),'T',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'T',0,'C');
	$pdf->Cell(32,7,utf8_decode("SUBTOTAL"),'T',0,'C');

	$k=0;
	$suma=0;
	for($k=0; $k<$i; $k++){
		$suma+=$datos[$k]['Precio_final'];
	}
	$pdf->Cell(34,7,$suma,'T',0,'C');

	#$pdf->Cell(34,7,utf8_decode("+ $70.00 USD"),'T',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(32,7,utf8_decode("IVA (21%)"),'',0,'C');

	$iva = (($suma*21)/100);
	$pdf->Cell(34,7,$iva,'',0,'C');
	#$pdf->Cell(34,7,utf8_decode("+ $0.00 USD"),'',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'',0,'C');


	$pdf->Cell(32,7,utf8_decode("TOTAL A PAGAR"),'T',0,'C');
	$pdf->Cell(34,7,$suma+$iva,'T',0,'C');

	$pdf->Ln(7);

	/*
	$pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(32,7,utf8_decode("TOTAL PAGADO"),'',0,'C');
	$pdf->Cell(34,7,utf8_decode("$100.00 USD"),'',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(32,7,utf8_decode("CAMBIO"),'',0,'C');
	$pdf->Cell(34,7,utf8_decode("$30.00 USD"),'',0,'C');

	$pdf->Ln(7);

	$pdf->Cell(100,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(15,7,utf8_decode(''),'',0,'C');
	$pdf->Cell(32,7,utf8_decode("USTED AHORRA"),'',0,'C');
	$pdf->Cell(34,7,utf8_decode("$0.00 USD"),'',0,'C');

	*/
	$pdf->Ln(12);

	$pdf->SetFont('Arial','',9);

	$pdf->SetTextColor(39,39,51);
	$pdf->MultiCell(0,9,utf8_decode("*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar esta factura ***"),0,'C',false);

	$pdf->Ln(9);

	# Codigo de barras #
	$pdf->SetFillColor(39,39,51);
	$pdf->SetDrawColor(23,83,201);
	$pdf->Code128(72,$pdf->GetY(),"COD000001V0001",70,20);
	$pdf->SetXY(12,$pdf->GetY()+21);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,5,utf8_decode("COD000001V0001"),0,'C',false);

	# Nombre del archivo PDF #
	$pdf->Output("I","Factura_Nro_1.pdf",true);