<?php

   require_once("../config/conexion.php");
   require_once("../modelos/archivo.php");
   require_once("../modelos/Usuarios.php");
   require_once("../modelos/pais.php");
   require_once("../modelos/tema.php");
   //llamo al modelo matriz
   require_once("../modelos/matriz.php");

  
   $pais = new Pais();
   $user = new Usuarios();
   $tem = new Tema();
   $matriz = new Matriz();
  

   $id_plan = $_GET["plan"];
   $id_pais = $_GET["pais"];


/*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/


//se debe crear toda la matriz... como primero con el...
	//titulo o plan crear la tabla
		//get plan

		$titulo = $matriz->get_titulo_por_id_plan($id_plan);
		$tituloplan = '';	
		foreach($titulo as $row)
		{
			$tituloplan = '<h4>'.$row["plan"].'</h4>'	;		
		}


		$pais=$matriz->get_pais($id_pais);
		
		$datapais = '';
		foreach($pais as $row)
	
				{
					$datapais = $row["pais"];			
				}


		$data ='
    <style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;

    }
    
    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
      vertical-align: top;
      text-align: left;

    }
    
    #customers tr:nth-child(even){background-color: #f2f2f2;}
    
    #customers tr:hover {background-color: #ddd;}
    
    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }
    </style>
    
    
    
    
            <table border="1" id="customers">
						<thead>
							<tr > 
								<th colspan="7"><h4>'.$tituloplan.'</h4></th>
							</tr>
							<tr >
								<th>Nro</th>                                      
								<th >Compromiso</th>
								<th >Bolivia</th>   
								<th >'.$datapais.'</th>    
								<th width="190px">Fecha de cumplimiento</th>                             
								<th >Acciones Realizadas</th>
								<th width="190px">Estado Cumplimiento</th>
							            
							</tr>  
						</thead>
						<tbody>

		';

		//luego get toda la comixta, crear las filas en la tabla


		$datos=$matriz->get_comixta_by_id_plan($id_plan);	
		$cantidad=0;
		foreach($datos as $row)
		{
			$cantidad++;
		}
		
		//otra consulta que solo saque por grupos y hay que sacar cuantos reistros hay 
		$datosmatriz = '';		
		 //Vamos a declarar un array
		$tema=1;

		echo "<script>console.log('Debug Objects: " .$cantidad. "' );</script>";
		$variable='tema';
		$varsubgrupo='subgrupo';
		 foreach($datos as $row)
	
				{

					$tem = $row["id_tema"];
					$subg = $row["subgrupo"];
					//si son diferentes temas lo cambiamos
					if($variable != $tem)
					{
						$variable = $tem;
						$datosmatriz = $datosmatriz.'<tr>'.
						'<th colspan="7">'.$row["id_tema"].'</th>'.
						'</tr>';						

					}
					//si es diferente subgrupo lo cambiamos
					if($varsubgrupo != $subg)
					{
						$varsubgrupo = $subg;
						$datosmatriz = $datosmatriz.'<tr>'.
						'<th colspan="6">'.$row["subgrupo"].'</th>'.
						'</tr>';						

					}


						$datosmatriz = $datosmatriz.'<tr ">'.
						'<td width="500px">'.$row["nro_compromiso"].'</td>'.
						'<td width="500px">'.$row["nro_compromiso"].'. '.$row["compromiso"].'</td>'.
						'<td width="200px">'.$row["entidad_responsable"].'</td>'.
						'<td width="200px">'.$row["entidad_responsable_2"].'</td>'.
						'<td width="190px">'.$row["fecha_cumplimiento"].'</td>'.
						'<td width="500px">'.$row["observaciones"].'</td>'.
						'<td width="190px">'.$row["estado_cumplimiento"].'</td>'.
						'</tr>';		
					
													
				}
			
				$data=  $data.$datosmatriz.'</tbody>            
						  		</table>';	



/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
  
  //echo $id_plan;
   //echo "<script>console.log(".$id_plan.");</script>";   
  // echo "<script>console.log('llegan2');</script>";
  // echo "<script>console.log(".$_GET["plan"].");</script>";

/* HTML a Excel
Autor: Hugo Parrales
Website: hugoparrales.com
version: 0.1
*/ 
//establecemos el timezone para obtener la hora local
date_default_timezone_set('America/El_Salvador');
 
//la fecha y hora de exportación sera parte del nombre del archivo Excel
$fecha = date("d-m-Y H:i:s");
 
//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Convertido_$fecha.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");

//Aqui va la tabla HTML
echo utf8_decode($data);



?>  
                


