<?php


require_once '../conexion.php';
//$codigo=htmlspecialchars($_GET['codigo'],ENT_QUOTES,'UTF-8');

$query="SELECT
matriz.id_tema
FROM
matriz";

if($resultado = $mysqli->query($query)){
  while ($row = $resultado->fetch_assoc()) {
      

 $html.='

    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
    <meta name="author" content="CONTROL_SOCIAL" />
    
    <style type="text/css">
    html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:11pt; background-color:white }
    a.comment-indicator:hover + div.comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em }
    a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em }
    div.comment { display:none }
    table { border-collapse:collapse; page-break-after:always }
    .gridlines td { border:1px dotted black }
    .gridlines th { border:1px dotted black }
    .b { text-align:center }
    .e { text-align:center }
    .f { text-align:right }
    .inlineStr { text-align:left }
    .n { text-align:right }
    .s { text-align:left }
    td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style1 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style1 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style2 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style2 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style3 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style3 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style4 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style4 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style5 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style5 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style6 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style6 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style7 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    th.style7 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    td.style8 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    th.style8 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    td.style9 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    th.style9 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    td.style10 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    th.style10 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    td.style11 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style11 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style12 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style12 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style13 { vertical-align:top; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style13 { vertical-align:top; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style14 { vertical-align:top; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style14 { vertical-align:top; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style15 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:Calibri; font-size:9pt; background-color:white }
    th.style15 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:Calibri; font-size:9pt; background-color:white }
    td.style16 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:Calibri; font-size:8pt; background-color:white }
    th.style16 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:Calibri; font-size:8pt; background-color:white }
    td.style17 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style17 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style18 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style18 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style19 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style19 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style20 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style20 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style21 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style21 { vertical-align:bottom; text-align:right; padding-right:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style22 { vertical-align:top; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style22 { vertical-align:top; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style23 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    th.style23 { vertical-align:top; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    td.style24 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    th.style24 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    td.style25 { vertical-align:top; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    th.style25 { vertical-align:top; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:Calibri; font-size:11pt; background-color:white }
    td.style26 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    th.style26 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    td.style27 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    th.style27 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    td.style28 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    th.style28 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:Calibri; font-size:7pt; background-color:white }
    table.sheet0 col.col0 { width:135.555554pt }
    table.sheet0 col.col1 { width:132.16666515pt }
    table.sheet0 col.col2 { width:168.08888696pt }
    table.sheet0 col.col3 { width:122.67777637pt }
    table.sheet0 tr { height:15pt }
    table.sheet0 tr.row0 { height:52.5pt }
    table.sheet0 tr.row1 { height:15.75pt }
    table.sheet0 tr.row2 { height:22.5pt }
    table.sheet0 tr.row3 { height:20.25pt }
    table.sheet0 tr.row4 { height:18pt }
    table.sheet0 tr.row5 { height:67.5pt }
    table.sheet0 tr.row6 { height:67.5pt }
    table.sheet0 tr.row7 { height:67.5pt }
    table.sheet0 tr.row8 { height:67.5pt }
    table.sheet0 tr.row9 { height:67.5pt }
    table.sheet0 tr.row10 { height:67.5pt }
    table.sheet0 tr.row11 { height:67.5pt }
    table.sheet0 tr.row12 { height:67.5pt }
    table.sheet0 tr.row13 { height:67.5pt }
    table.sheet0 tr.row14 { height:67.5pt }
    table.sheet0 tr.row15 { height:67.5pt }
    table.sheet0 tr.row16 { height:67.5pt }
    </style>
    </head>
    
    <body>
    <style>
    @page { margin-left: 0.31496062992126in; margin-right: 0.31496062992126in; margin-top: 0.35433070866142in; margin-bottom: 0.35433070866142in; }
    body { margin-left: 0.31496062992126in; margin-right: 0.31496062992126in; margin-top: 0.35433070866142in; margin-bottom: 0.35433070866142in; }
    
    
    </style>
    
    <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
      <col class="col0">
      <col class="col1">
      <col class="col2">
      <col class="col3">
      <tbody>
        <tr class="row0">
          <td class="column0 style1 null style11" rowspan="2"><IMG SRC="logo_vds2021_3.png" WIDTH=130 HEIGHT=120 ALT="Obra de K. Haring"></td> <br><br><br>
          
        </tr>
    
     
    
    
    
      </tbody>
    </table>
    </body>
    
    ';


  }
}

require_once __DIR__ . '/../vendor/autoload.php';

/*$mpdf = new \Mpdf\Mpdf(
['mode' => 'UTF-8', 'format' => [80,130]]
);*/

/*$mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);*/
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

$mpdf->WriteHTML($html);
$mpdf->Output();