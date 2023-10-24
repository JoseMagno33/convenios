<?php

require_once('fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    //$this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(10);
    // Title
    $this->Cell(230,10,'Viceministerio de defensa social y sustancias controladas',0,0,'C');
    // Line break
    $this->SetFont('Arial','B',10);
    $entidad_resp2 ="Ent resp 2";
    $this->Ln(10);
    $this->Cell(10, 7, utf8_decode('Nro'),1,0,'C',0);
    $this->Cell(40,7, 'Compromiso',1,0,'C',0);
    $this->Cell(30,7, 'Bolivia',1,0,'C',0);
    $this->Cell(30,7, $entidad_resp2 ,1,0,'C',0);
    $this->Cell(40,7, 'Fecha Cumplimiento',1,0,'C',0);
    $this->Cell(40,7, 'Acciones Realizadas',1,0,'C',0);
    $this->Cell(40,7, 'Estado Cumplimiento',1,1,'C',0);
    


    
    
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Pag'.$this->PageNo().'/{nb}',0,0,'C');
}
}

require'cn.php';
$consulta = "select m.* from cmx_matriz m order by nro_compromiso";
$resultado = mysqli_query($conn,$consulta);


$pdf = new PDF('L','mm','letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);
$fill=false;
while($row = $resultado->fetch_assoc()){
    $pdf->cell(10,10, $row['nro_compromiso'],1,0,'C',0);
    $pdf->Multicell(40,10, $row['compromiso'],1,'Q',$fill);
    $pdf->SetY(27);
    $pdf->SetX(60);
    $pdf->Multicell(30,10, $row['entidad_responsable'],1,'Q',$fill);
    $pdf->SetY(27);
    $pdf->SetX(90);
    $pdf->Multicell(30,10, $row['entidad_responsable_2'],1,'Q',$fill);
    $pdf->SetY(27);
    $pdf->SetX(120);
    $pdf->cell(40,10, $row['fecha_cumplimiento'],1,0,'C',0);
    $pdf->Multicell(40,10, $row['observaciones'],1,'Q',$fill);
    $pdf->SetY(27);
    $pdf->SetX(150);
    $pdf->cell(40,10, $row['estado_cumplimiento'],1,1,'C',0);  
}
$pdf->Output();


?>


