<?php
require('../libs/fpdf/fpdf.php');

require_once '../funciones/conexion.php';
$MiConexion=ConexionBD();

require_once '../funciones/articulos.php';
require_once '../funciones/pedidos.php';
$articulos=Listar_art_corto($MiConexion);
$CantidadArticulos=count($articulos);
$pedido= listar_pedido($_GET["id_venta"],$MiConexion);
//print_r($pedido);
$proveedor=$pedido['PROVE_NOMBRE'];

$mail=$pedido['CONTACTO_EMAIL'];
//echo $proveedor;
$items = listar_item_pedido($_GET["id_venta"],$MiConexion);
$cantidadItems=count($items);
$id=$_GET['id_venta'];
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $time = time();
    $id=$_GET['id_venta'];
    
    $dia = date("d/m/Y", $time);
    // Logo
    $this->Image('../assets/img/logo/logo2.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(80,10,'Pedido Nro '.$id.' - '.$dia,1,0,'C');
    // Salto de línea
    $this->Ln(25);
   
    
}
function Header2($pedido) {
    $this->Cell(10,10,$pedido['PROVE_NOMBRE']."mierda",1,0,'C'); 
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

function FancyTable($header, $items) {
    $CantidadArticulos=count($items);
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(30, 30, 70, 20);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = true;
    for ($i=0; $i<$CantidadArticulos; $i++) 
    {
       

        $this->Cell($w[0],6,$items[$i]['MARCA_NOMBRE'],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$items[$i]['MODELO_NOMBRE'],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$items[$i]['ART_INFOADICIONAL'],'LR',0,'L',$fill);
        $this->Cell($w[3],6,$items[$i]['DETPEDPROV_CANT'],'LR',0,'C',$fill);

        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$header = array('Marca','Modelo','Articulo', 'Cantidad');

$pdf->AliasNbPages();
$pdf->SetFont('Times','',8);
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Write(5,"Sr : $proveedor\n");
$pdf->SetFont('Times','',10);
$pdf->Write(5,"Necesitamos presupuesto de los siguientes articulos. \nGracias. \n\n");
$pdf->SetFont('Times','',8);
$pdf->FancyTable($header,$items);

$pdf->Output("pedidos/pedido".$id.".pdf","I");



?>