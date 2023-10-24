	<?php



		//llamamos a la libreria de excel
		require_once("../excel/Classes/PHPExcel.php");

		//llamo a la conexion de la base de datos 
		require_once("../config/conexion.php");
		//llamo al modelo Clientes
		require_once("../modelos/matriz.php");

		//llamo al modelo Ventas
		require_once("../modelos/Ventas.php");

	
		$matriz = new Matriz();


		//declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo
	
	//los valores vienen del atributo name de los campos del formulario
	/*el valor id_usuario y cedula_cliente se carga en el campo hidden cuando se edita un registro*/
	//se copian los campos de la tabla clientes
	$id_usuario=isset($_POST["id_usuario"]);
	$id_matriz=isset($_POST["id_matriz"]);
	$id_tema=isset($_POST["id_tema"]);
	$id_entidad = isset($_POST["id_entidad"]);
	$id_pais = isset($_POST["id_pais"]);
	$subgrupo = isset($_POST["subgrupo"]);
	$nro_compromiso = isset($_POST["nro_compromiso"]);
	$compromiso=isset($_POST["compromiso"]);
	$entidad_responsable=isset($_POST["entidad_responsable"]);
	$contacto=isset($_POST["contacto"]);
	$fecha_cumplimiento=isset($_POST["fecha_cumplimiento"]);
	$observaciones=isset($_POST["observaciones"]);
	$estado_cumplimiento=isset($_POST["estado_cumplimiento"]);


		switch($_GET["op"]){

		
		case "excelmatriz":
		
			echo "<script>console.log('asdasdasdas');</script>";
			$titulo = $matriz->get_titulo_por_id_plan($_POST["id_plan"]);
			$tituloplan = '';	
			foreach($titulo as $row)
			{
				$tituloplan = '<h4>'.$row["plan"].'</h4>'	;		
			}

			$pais=$matriz->get_pais($_POST["id_pais"]);
			
			$datapais = '';
			foreach($pais as $row)
		
					{
						$datapais = $row["pais"];			
					}


			$data = ' 
					
						<table class="matriz">
							<thead>
								<tr > 
									<th colspan="7"><h4>'.$tituloplan.'</h4></th>
								</tr>
								<tr >
																		
									<th >Compromiso</th>
									<th >Bolivia</th>   
									<th >'.$datapais.'</th>    
									<th width="190px">Fecha de cumplimiento</th>                             
									<th >Acciones Realizadas</th>
									<th width="190px">Estado Cumplimiento</th>
									<th width="100px">Acciones</th>                     
								</tr>  
							</thead>
							<tbody>

			';

			//luego get toda la comixta, crear las filas en la tabla


			$datos=$matriz->get_comixta_by_id_plan($_POST["id_plan"]);	
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
							'<th colspan="7">'.$row["subgrupo"].'</th>'.
							'</tr>';						

						}

							$datosmatriz = $datosmatriz.'<tr ">'.					
							'<td width="500px">'.$row["nro_compromiso"].'. '.$row["compromiso"].'</td>'.
							'<td width="200px">'.$row["entidad_responsable"].'</td>'.
							'<td width="200px">'.$row["entidad_responsable_2"].'</td>'.
							'<td width="190px">'.$row["fecha_cumplimiento"].'</td>'.
							'<td width="500px">'.$row["observaciones"].'</td>'.
							'<td width="190px">'.$row["estado_cumplimiento"].'</td>'.
							'<td width="100px">'.'<button type="button" onClick="mostrar('.$row["id_matriz"].');" id="'.$row["id_matriz"].
							'" class="btn btn-warning btn-md"><i class="glyphicon glyphicon-edit"></i>Ver</button>'.
							'<button type="button" onClick="eliminar('.$row["id_matriz"].');" id="'.$row["id_matriz"].
							'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>'.'</td>'.
							'</tr>';		
						
														
					}
				
					$data=  $data.$datosmatriz.'</tbody>            
									</table>';	

			//	echo $data;
			echo "<script>console.log('me la suda!!!!!!!!!');</script>"
	
			break;
			
		}
	


	?>