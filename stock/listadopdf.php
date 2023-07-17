<?php
require('../libs/fpdf/fpdf.php');

require_once '../funciones/conexion.php';
$MiConexion=ConexionBD();

require_once '../funciones/articulos.php';
$articulos=Listar_art_corto($MiConexion);
$CantidadArticulos=count($articulos);


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $time = time();

    $dia = date("d/m/Y", $time);
    // Logo
    $this->Image('../assets/img/logo/logo2.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(90,10,'Listado de Precios - '.$dia,1,0,'C');
    // Salto de línea
    $this->Ln(20);
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

function FancyTable($header, $articulos) {
    $CantidadArticulos=count($articulos);
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(20, 20, 45, 20,20,20,40);
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
        $foto=base64_encode($articulos[$i]['ART_FOTO']);
     //  $this->Image($foto);

        $this->Cell($w[0],6,$articulos[$i]['MARCA_NOMBRE'],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$articulos[$i]['MODELO_NOMBRE'],'LR',0,'L',$fill);
        $this->Cell($w[2],6,$articulos[$i]['ART_INFOADICIONAL'],'LR',0,'L',$fill);
        $this->Cell($w[3],6,'$'.$articulos[$i]['ART_PRECIOCOMPRA'],'LR',0,'L',$fill);
        $this->Cell($w[4],6,$articulos[$i]['ART_UBICACION'],'LR',0,'L',$fill);
        $this->Cell($w[5],6,$articulos[$i]['ART_CODIGO'],'LR',0,'L',$fill);
        $this->Cell($w[6],6,$foto ,'LR',0,'L',$fill);
        $this->Cell($w[6],6,"/",'LR',0,'L',$fill);

        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$header = array('Marca', 'Modelo', 'Articulo', 'Precio','Ubicacion','Codigo','Foto');

$pdf->AliasNbPages();
$pdf->SetFont('Times','',8);
$pdf->AddPage();


$pdf->FancyTable($header,$articulos);

$pdf->Output("I","Listado.pdf",true);


?>