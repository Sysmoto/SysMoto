<?php
require('../libs/fpdf/fpdf.php');

require_once '../funciones/conexion.php';
$MiConexion=ConexionBD();

require_once '../funciones/articulos.php';
$articulos=Listar_art_corto($MiConexion);
$CantidadArticulos=count($articulos);

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);    
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);

$pdf->setY(10);
$pdf->setX(10);
//$pdf->Image('./img/logo.png',10,8,33);
$pdf->Cell(70,20,$pdf->Image('./img/logo.png',$pdf->GetX(), $pdf->GetY(), 0),'LTR',0,'C',0);
$pdf->setY(25);$pdf->setX(10);
$pdf->Cell(70,10,"The Doctor Garage",'LR',0,'C',0);
$pdf->SetFont('Arial','',8);    
$pdf->setY(35);$pdf->setX(10);
$pdf->Cell(70,$textypos,"Santa Teresa 23- Ca 25 de Mayo - La Pampa",'LR',0,'C',0);
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(70,$textypos,"Telefono: 0299-12312312",'LR',0,'C',0);
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(70,$textypos,"Email: ventas@thedoctorgarage.com.ar",'LR',0,'C',0);
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(70,$textypos,"RESPONSABLE MONOTRIBUTO",'LTRB',0,'C',0);

// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',40);    
$pdf->setY(10);$pdf->setX(80);
$pdf->Cell(45,$textypos,"",'LTR',0,'C',0);
$pdf->setY(15);$pdf->setX(80);
$pdf->Cell(45,$textypos,"",'LR',0,'C',0);
$pdf->setY(20);$pdf->setX(80);
$pdf->Cell(45,$textypos,"C",'LR',0,'C',0);
$pdf->setY(25);$pdf->setX(80);
$pdf->Cell(45,$textypos,"",'LR',0,'C',0);
$pdf->SetFont('Arial','',10);    
$pdf->setY(30);$pdf->setX(80);
$pdf->Cell(45,$textypos,"Cod 11",'LR',0,'C',0);
$pdf->setY(35);$pdf->setX(80);
$pdf->Cell(45,$textypos,"",'LR',0,'C',0);
$pdf->setY(40);$pdf->setX(80);
$pdf->Cell(45,$textypos,"",'LR',0,'C',0);
$pdf->setY(45);$pdf->setX(80);
$pdf->Cell(45,$textypos,"",'LR',0,'C',0);

$pdf->setY(50);$pdf->setX(80);
$pdf->Cell(45,$textypos,"",'LRB',0,'C',0);

$numero="00000012";
// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(10);$pdf->setX(125);
$pdf->Cell(70,$textypos,"",'LTR',0,'C',0);
$pdf->setY(15);$pdf->setX(125);
$pdf->Cell(70,$textypos,"FACTURA",'LR',0,'C',0);
$pdf->setY(20);$pdf->setX(125);
$pdf->Cell(70,$textypos,"Nro 0001 - " . $numero ,'LR',0,'C',0);
$pdf->setY(25);$pdf->setX(125);
$pdf->Cell(70,$textypos,"",'LR',0,'C',0);
$pdf->SetFont('Arial','',10);    
$pdf->setY(30);$pdf->setX(125);
$pdf->Cell(70,$textypos,"Fecha: 11/DIC/2019",'LR',0,'C',0);
$pdf->setY(35);$pdf->setX(125);
$pdf->Cell(70,$textypos,"",'LBR',0,'C',0);
$pdf->SetFont('Arial','B',8);    
$pdf->setY(40);$pdf->setX(125);
$pdf->Cell(70,$textypos,"CUIT: 20-12234567-9",'LTR',0,'C',0);
$pdf->SetFont('Arial','',8);    
$pdf->setY(45);$pdf->setX(125);
$pdf->Cell(70,$textypos,"Ingresos Brutos: 23222-35355",'LR',0,'C',0);
$pdf->setY(50);$pdf->setX(125);
$pdf->Cell(70,$textypos,"Inicio de actividades: 01/06/2017",'LBR',0,'C',0);
/// Apartir de aqui empezamos con la tabla de productos

$pdf->setY(58);$pdf->setX(10);
$pdf->Cell(185,$textypos,"",'LTR',0,'L',0);    
$pdf->setY(60);$pdf->setX(10);
$pdf->SetFont('Arial','B',8); 
$pdf->Cell(185,$textypos,"   Nombre Apellido / Razon Social: ",'LR',0,'L',0);
$pdf->setY(60);$pdf->setX(60);
$pdf->SetFont('Arial','',8); 
$pdf->Cell(120,$textypos,"Juan Perez",'LTRB',0,'L',0);
$pdf->setY(65);$pdf->setX(10);
$pdf->Cell(185,$textypos,"",'LR',0,'L',0);

$pdf->setY(67);$pdf->setX(10);
$pdf->SetFont('Arial','B',8); 
$pdf->Cell(185,$textypos,"   Domicilio: ",'LR',0,'L',0);
$pdf->setY(67);$pdf->setX(30);
$pdf->SetFont('Arial','',8); 
$pdf->Cell(70,$textypos,"Juan Perez",'LTRB',0,'L',0);
$pdf->setY(67);$pdf->setX(100);
$pdf->SetFont('Arial','B',8); 
$pdf->Cell(85,$textypos,"   Localidad: ",'',0,'L',0);
$pdf->setY(67);$pdf->setX(120);
$pdf->SetFont('Arial','',8); 
$pdf->Cell(60,$textypos,"Juan Perez",'LTRB',0,'L',0);
$pdf->setY(70);$pdf->setX(10);
$pdf->Cell(185,$textypos,"",'LR',0,'L',0);

$pdf->setY(73);$pdf->setX(11);
$pdf->Cell(100,$textypos,"",'LTR',0,'L',0);
$pdf->setY(77);$pdf->setX(11);
$pdf->Cell(100,$textypos,"",'LBR',0,'L',0);

$pdf->setY(73);$pdf->setX(120);
$pdf->Cell(70,$textypos,"",'LTR',0,'L',0);
$pdf->setY(77);$pdf->setX(120);
$pdf->Cell(70,$textypos,"",'LBR',0,'L',0);

$pdf->setY(75);$pdf->setX(10);


$pdf->SetFont('Arial','B',8); 
$pdf->Cell(185,$textypos," IVA: ",'LR',0,'L',0);
$pdf->setY(75);$pdf->setX(20);
$pdf->SetFont('Arial','',6); 
$pdf->Cell(70,$textypos,"Resp Inscr",'',0,'L',0);
$pdf->setY(75);$pdf->setX(32);
$pdf->Cell(5,$textypos," ",'LTRB',0,'L',0);
$pdf->setY(75);$pdf->setX(38);
$pdf->Cell(50,$textypos,"Cons Final",'',0,'L',0);
$pdf->setY(75);$pdf->setX(50);
$pdf->Cell(5,$textypos,"X",'LTRB',0,'L',0);
$pdf->setY(75);$pdf->setX(55);
$pdf->Cell(50,$textypos,"No Resp",'',0,'L',0);
$pdf->setY(75);$pdf->setX(65);
$pdf->Cell(5,$textypos," ",'LTRB',0,'L',0);
$pdf->setY(75);$pdf->setX(70);
$pdf->Cell(50,$textypos,"Exento",'',0,'L',0);
$pdf->setY(75);$pdf->setX(78);
$pdf->Cell(5,$textypos," ",'LTRB',0,'L',0);
$pdf->setY(75);$pdf->setX(83);
$pdf->Cell(50,$textypos,"Res Monotibuto",'',0,'L',0);
$pdf->setY(75);$pdf->setX(100);
$pdf->Cell(5,$textypos," ",'LTRB',0,'L',0);
$pdf->SetFont('Arial','B',8); 
$pdf->setY(75);$pdf->setX(120);
$pdf->Cell(45,$textypos,"Cond. Venta:",'',0,'L',0);
$pdf->SetFont('Arial','',8); 
$pdf->setY(75);$pdf->setX(145);
$pdf->Cell(45,$textypos,"Contado",'',0,'L',0);
$pdf->setY(80);$pdf->setX(10);
$pdf->Cell(185,$textypos,"",'LBR',0,'L',0);
$pdf->Ln();
$pdf->Ln();
    /////////////////////////////
//// Array de Cabecera
$header = array("Cod.", "Descripcion","Cant.","Precio","Total");
//// Arrar de Productos
$products = array(
	array("0010", "Producto 1",2,120,0),
	array("0024", "Producto 2",5,80,0),
	array("0001", "Producto 3",1,40,0),
	array("0001", "Producto 3",5,80.43,0),
	array("0001", "Producto 3",4,30,0),
	array("0001", "Producto 3",7,80,0),
);
    // Column widths
    $w = array(20, 95, 20, 25, 25);
    // Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
    // Data
    $total = 0;
    foreach($products as $row)
    {
        $pdf->Cell($w[0],6,$row[0],1);
        $pdf->Cell($w[1],6,$row[1],1);
        $pdf->Cell($w[2],6,number_format($row[2]),'1',0,'R');
        $pdf->Cell($w[3],6,"$ ".number_format($row[3],2,".",","),'1',0,'R');
        $pdf->Cell($w[4],6,"$ ".number_format($row[3]*$row[2],2,".",","),'1',0,'R');

        $pdf->Ln();
        $total+=$row[3]*$row[2];

    }
/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$pdf->Ln();
$pdf->Ln();
$yposdinamic = 70 + (count($products)*10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln();
/////////////////////////////
$header = array("", "");
$data2 = array(
	array("Subtotal",$total),
	array("Descuento", 0),
	array("Impuesto", 0),
	array("Total", $total),
);
    // Column widths
    $w2 = array(40, 40);
    // Header

    $pdf->Ln();
    // Data
    foreach($data2 as $row)
    {
$pdf->setX(115);
        $pdf->Cell($w2[0],6,$row[0],1);
        $pdf->Cell($w2[1],6,"$ ".number_format($row[1], 2, ".",","),'1',0,'R');

        $pdf->Ln();
    }
/////////////////////////////
$total_letra=numeroATexto($total);

$yposdinamic += (count($data2)*10);
$pdf->SetFont('Arial','',10);    

$pdf->setY($yposdinamic);
$pdf->setX(10);
$pdf->Cell(185,$textypos," Son pesos " . $total_letra,'LTBR',0,'R',0);
$pdf->SetFont('Arial','',10);    

$pdf->setY($yposdinamic+10);
$pdf->setX(10);
$pdf->Cell(70,20,$pdf->Image('./img/afip.png',$pdf->GetX(), $pdf->GetY(), 0),'',0,'C',0);
$pdf->setX(130);
$pdf->SetFont('Arial','B',8);   

$numeroAleatorio = '';
for ($i = 0; $i < 14; $i++) {
    $numeroAleatorio .= mt_rand(0, 9);
}

$pdf->Cell(50,$textypos,"CAE Nro: " . $numeroAleatorio);

$pdf->setY($yposdinamic+15);
$pdf->setX(130);

$pdf->Cell(5,$textypos,"Venc CAE: " . $numeroAleatorio);

$pdf->setY($yposdinamic+50);

$pdf->setX(140);
$pdf->Cell(5,$textypos,"Powered by Sysmoto");

$nro_factura= 3;
$pdf->output('', 'Factura_N_' . $nro_factura, true);

function numeroATexto($numero) {
    $parteEntera = floor($numero);
    $centavos = round(($numero - $parteEntera) * 100);

    $textoEntero = numeroATextoEntero($parteEntera);

    $textoCentavos = "";
    if ($centavos > 0) {
        $textoCentavos = " con " . numeroATextoEntero($centavos) . " centavos";
    }

    return $textoEntero . $textoCentavos;
}


function numeroATextoEntero($numero) {
    $unidades = array("", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve");
    $decenas = array("", "diez", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa");
    $decenasEspeciales = array("once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", "dieciocho", "diecinueve");
    $centenas = array("", "cien", "doscientos", "trescientos", "cuatrocientos", "quinientos", "seiscientos", "setecientos", "ochocientos", "novecientos");

    $texto = "";

    if ($numero == 0) {
        $texto = "cero";
    } elseif ($numero < 10) {
        $texto = $unidades[$numero];
    } elseif ($numero < 20) {
        $texto = $decenasEspeciales[$numero - 11];
    } elseif ($numero < 100) {
        $decena = floor($numero / 10);
        $unidad = $numero % 10;
        $texto = $decenas[$decena];
        if ($unidad > 0) {
            $texto .= " y " . $unidades[$unidad];
        }
    } elseif ($numero < 1000) {
        $centena = floor($numero / 100);
        $resto = $numero % 100;
        $texto = $centenas[$centena];
        if ($resto > 0) {
            $texto .= " " . numeroATexto($resto);
        }
    } elseif ($numero < 1000000) {
        $millar = floor($numero / 1000);
        $resto = $numero % 1000;
        $texto = numeroATexto($millar) . " mil";
        if ($resto > 0) {
            $texto .= " " . numeroATexto($resto);
        }
    } elseif ($numero < 1000000000) {
        $millon = floor($numero / 1000000);
        $resto = $numero % 1000000;
        $texto = numeroATexto($millon) . " millones";
        if ($resto > 0) {
            $texto .= " " . numeroATexto($resto);
        }
    }

    return $texto;
}

$numero = 1234;
$texto = numeroATexto($numero);

echo "Número: $numero\n";
echo "En palabras: $texto";
?>
