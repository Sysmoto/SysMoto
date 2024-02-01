<?php
session_start();
//print_r($_SESSION);
if (empty($_SESSION["Usuario"])) {

    header("Location: ../logout.php");

    exit();
}
$id_venta =$_POST['id_venta'];

require_once '../funciones/conexion.php';
$MiConexion=ConexionBD();


require_once '../funciones/ventas.php';
$presupuesto= listar_venta($id_venta,$MiConexion);
//print_r($presupuesto);
$nro_factura= str_pad(number_format($presupuesto['FACTURA_ID'], 0, '', ''), 8, '0', STR_PAD_LEFT);

$items = listar_item_presupuesto($_POST["id_venta"],$MiConexion);
$cantidadItems=count($items);
//print_r($items);

$est_ven=listar_est_venta($MiConexion);
$cantidadEstado=count($est_ven);

$totales = listar_totales_presupuesto($_POST["id_venta"],$MiConexion);

$dat_fact=datos_facturacion($MiConexion);
//print_r($_POST);
//$presupuesto= listar_venta($_POST["imprimir"],$MiConexion);

require('../libs/fpdf/fpdf.php');
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
$pdf->Cell(70,10,$dat_fact['empresa'],'LR',0,'C',0);
$pdf->SetFont('Arial','',8);    
$pdf->setY(35);$pdf->setX(10);
$pdf->Cell(70,$textypos,$dat_fact['direccion'],'LR',0,'C',0);
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(70,$textypos,"Telefono: " . $dat_fact['telefono'],'LR',0,'C',0);
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(70,$textypos,"Email: " . $dat_fact['email'],'LR',0,'C',0);
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(70,$textypos,$dat_fact['inscripcion'],'LTRB',0,'C',0);

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
$pdf->Cell(70,$textypos,"Nro 0001 - " . str_pad(number_format($presupuesto['FACTURA_ID'], 0, '', ''), 8, '0', STR_PAD_LEFT) ,'LR',0,'C',0);
$pdf->setY(25);$pdf->setX(125);
$pdf->Cell(70,$textypos,"",'LR',0,'C',0);
$pdf->SetFont('Arial','',10);    
$pdf->setY(30);$pdf->setX(125);
$pdf->Cell(70,$textypos,"Fecha: " . date("d-m-Y", strtotime($presupuesto['VENTA_FECHAVENTA'])),'LR',0,'C',0);
$pdf->setY(35);$pdf->setX(125);
$pdf->Cell(70,$textypos,"",'LBR',0,'C',0);
$pdf->SetFont('Arial','B',8);    
$pdf->setY(40);$pdf->setX(125);
$pdf->Cell(70,$textypos,"CUIT: " . $dat_fact['cuit'],'LTR',0,'C',0);
$pdf->SetFont('Arial','',8);    
$pdf->setY(45);$pdf->setX(125);
$pdf->Cell(70,$textypos,"Ingresos Brutos: " . $dat_fact['ing_bruto'],'LR',0,'C',0);
$pdf->setY(50);$pdf->setX(125);
$pdf->Cell(70,$textypos,"Inicio de actividades: " . date("d-m-Y", strtotime($dat_fact['inicio'])),'LBR',0,'C',0);
/// Apartir de aqui empezamos con la tabla de productos

$pdf->setY(58);$pdf->setX(10);
$pdf->Cell(185,$textypos,"",'LTR',0,'L',0);    
$pdf->setY(60);$pdf->setX(10);
$pdf->SetFont('Arial','B',8); 
$pdf->Cell(185,$textypos,"   Nombre Apellido / Razon Social: ",'LR',0,'L',0);
$pdf->setY(60);$pdf->setX(60);
$pdf->SetFont('Arial','',8); 
$pdf->Cell(120,$textypos,$presupuesto["CLIENTE"],'LTRB',0,'L',0);
$pdf->setY(65);$pdf->setX(10);
$pdf->Cell(185,$textypos,"",'LR',0,'L',0);

$pdf->setY(67);$pdf->setX(10);
$pdf->SetFont('Arial','B',8); 
$pdf->Cell(185,$textypos,"   Domicilio: ",'LR',0,'L',0);
$pdf->setY(67);$pdf->setX(30);
$pdf->SetFont('Arial','',8); 
$pdf->Cell(70,$textypos,$presupuesto['DOMICILIO'],'LTRB',0,'L',0);
$pdf->setY(67);$pdf->setX(100);
$pdf->SetFont('Arial','B',8); 
$pdf->Cell(85,$textypos,"   Localidad: ",'',0,'L',0);
$pdf->setY(67);$pdf->setX(120);
$pdf->SetFont('Arial','',8); 
$pdf->Cell(60,$textypos,$presupuesto['CIUDAD'],'LTRB',0,'L',0);
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

    // Column widths
    $w = array(20, 95, 20, 25, 25);
    // Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
    // Data
    $total = 0;
    for ($i=0; $i<$cantidadItems; $i++)
    {
        $pdf->Cell($w[0],6,$items[$i]['ART_ID'],1);
        $pdf->Cell($w[1],6,$items[$i]['ART_INFOADICIONAL'],1);
        $pdf->Cell($w[2],6,number_format($items[$i]['DETVENTA_CANT']),'1',0,'R');
        $pdf->Cell($w[3],6,"$ ".number_format($items[$i]['DETVENTA_PRECUNIT'],2,".",","),'1',0,'R');
        $pdf->Cell($w[4],6,"$ ".number_format($items[$i]['DETVENTA_CANT']*$items[$i]['DETVENTA_PRECUNIT'],2,".",","),'1',0,'R');

        $pdf->Ln();
        $total+=$items[$i]['DETVENTA_CANT']*$items[$i]['DETVENTA_PRECUNIT'];

    }
/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$pdf->Ln();
$pdf->Ln();
$yposdinamic = 80 + (count($items)*10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln();
/////////////////////////////
$subtotal = $total;
$descuento = $total * ($presupuesto['VENTA_DESCUENTO'] / 100);
$impuestos = $total* ($presupuesto['PORCENTAJE']/100);
$total= $total + $impuestos - $descuento;
$header = array("", "");
$data2 = array(
	array("Subtotal",$subtotal),
	array("Descuento ( " . $presupuesto['VENTA_DESCUENTO'] . " %)", $descuento),
	array("Impuesto ( " . $presupuesto['IMPUESTO'] ." )", $impuestos),
	array("Total", $total),
);
    // Column widths
    $w2 = array(50, 40);
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
$timestamp=strtotime($presupuesto['VENTA_FECHAVENTA']);
$timestamp_nuevo = $timestamp + (7 * 24 * 60 * 60); // 7 días en segundos

// Formatear la nueva fecha
$fecha_nueva = date("d-m-Y", $timestamp_nuevo);

$pdf->Cell(5,$textypos,"Venc CAE: " . $fecha_nueva);

$pdf->setY($yposdinamic+50);

$pdf->setX(140);
$pdf->Cell(5,$textypos,"Powered by Sysmoto");


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


?>
