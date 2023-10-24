<?php

		
	  //llamamos a la libreria de excel
	 

	  //llamo a la conexion de la base de datos 
      require_once("../config/conexion.php");
      //llamo al modelo Clientes
      require_once("../modelos/matriz.php");

     

  
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

           case "guardaryeditar":

	       	   /*si id_matriz no existe entonces lo registra
	           importante: se debe poner el $_POST sino no funciona*/
				
	          	if(empty($_POST["id_matriz"])){
	       	  		
		 				$matriz->registrar_matriz($id_tema,$subgrupo,$nro_compromiso,$compromiso,$entidad_responsable,$entidad_responsable_2,$contacto,$fecha_cumplimiento,$observaciones,$estado_cumplimiento,$id_usuario,$id_pais);
			       	   	$messages[]="Se registró correctamente";

			    }//cierre de empty

	            else {

					
	            	/*si ya existe entonces editamos matriz*/


	            	 $matriz->editar_matriz($id_matriz, $id_tema, $subgrupo, $nro_compromiso, $compromiso,$entidad_responsable,$entidad_responsable_2,$contacto,$fecha_cumplimiento,$observaciones,$estado_cumplimiento,$id_usuario,$id_pais);

	            	  $messages[]="Se editó correctamente";
	            	 
	            }

  
      
						//mensaje success
						if (isset($messages)){
									
									?>
									<div class="alert alert-success" role="alert">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>¡Bien hecho!</strong>
											<?php
												foreach ($messages as $message) {
														echo $message;
													}
												?>
									</div>
									<?php
								}
						//fin success

						//mensaje error
							if (isset($errors)){
								
								?>
									<div class="alert alert-danger" role="alert">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Error!</strong> 
											<?php
												foreach ($errors as $error) {
														echo $error;
													}
												?>
									</div>
								<?php

								}

						//fin mensaje error


     break;
						

	 case 'mostrartitulo':
		
	
		$datos=$matrizpais->get_titulo_por_id_pais($_POST["id_pais"]);
		//$datos=$matriz->get_matriz();
   
		//Vamos a declarar un array
		 $data= Array();
   
		foreach($datos as $row)
   
			   {
				   $sub_array = array();
					$sub_array[] = '<h3>'.$row["plan"].'</h3>';		
					$data[] = $sub_array;
			   }
   
		 $results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
			echo json_encode($results);
																																
  

 	break;

	 case 'mostrartituloplan':
		
		
		$datos=$matriz->get_titulo_por_id_plan($_POST["id_plan"]);
		
		$data = '';
		foreach($datos as $row)
	
				{
					$data = '<h4>'.$row["plan"].'</h4>';			
				}

				$data = $data;	
   		echo $data;
																																
  

 	break;

	 case 'encontrarcomixtas':
		
	
		$datos=$matriz->get_comixta_by_id_pais($_POST["id_pais"]);
		
		$data = '';
		foreach($datos as $row)
	
				{
					$data = $data.'<option value="'.$row["id_plan"].'"> '.$row["comixta"].' </option>';			
				}

				$data = '<select name="lst_com1" id="lst_com1" class="form-control"><option value="0">SELECCIONE UNA COMIXTA</option>'.$data.'</select>';	
   		echo $data;

 	break;

	 case 'encontrarentidad':
		
	
		$datos=$matriz->get_pais($_POST["id_pais"]);
		
		$data = '';
		foreach($datos as $row)
	
				{
					$data = $row["pais"];			
				}

				$data = '<label>'.$data.'</label>';	
   		echo $data;

 	break;

	 case 'crearmatrizporplan':
		
	//se debe crear toda la matriz... como primero con el...
	//titulo o plan crear la tabla
		//get plan

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
				  <button  class="btn btn-info" onclick="reporte_matriz('.$_POST["id_plan"].','.$_POST["id_pais"].')" ><!--<a href="prueba.php">-->
				  <span>Excel</span>				   
				  </a></button> 
				  <button  class="btn btn-info"><a href="../vistas/reportes/index.php" target="_blank">
				  <span>Pdf</span>				   
				  </a></button> 
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
						'<td width="100px">'.'<button type="button" onClick="mostrar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-warning btn-md"><i class="glyphicon glyphicon-edit"></i>Ver</button>'.'<button type="button" onClick="eliminar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>'.'</td>'.
						'</tr>';		
					
													
				}
			
				$data=  $data.$datosmatriz.'</tbody>            
						  		</table>';	

			echo $data;
 	break;			

	 case 'matrizporplan':
		
	
		$datos=$matriz->get_comixta_by_id_plan($_POST["id_plan"]);	
   
		 //Vamos a declarar un array
		 $data= Array();



		 foreach($datos as $row)
	
				{
					$sub_array = array();
					 $sub_array[] = $row["id_tema"];
					 $sub_array[] = $row["subgrupo"];				 
					 $sub_array[] = $row["nro_compromiso"].'. '.$row["compromiso"];				 
					 //$sub_array[] = $row["compromiso"];				 
					 $sub_array[] = $row["entidad_responsable"];
					 $sub_array[] = $row["entidad_responsable_2"];
					 $sub_array[] = $row["observaciones"];
					 $sub_array[] = $row["estado_cumplimiento"];
					 //$sub_array[] = date("d-m-Y",strtotime($row["fecha_actualizacion"]));
					 //$sub_array[] = $row["contacto"];
					 //$sub_array[] = $row["fecha_cumplimiento"];
					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-warning btn-md"><i class="glyphicon glyphicon-edit"></i>Ver</button>'.'<button type="button" onClick="eliminar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';
						
					$data[] = $sub_array;
				}
	
		  $results = array(
				 "sEcho"=>1, //Información para el datatables
				 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
				 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				 "aaData"=>$data);
			 echo json_encode($results);																	
  

 	break;


	 case 'matrizporplan2':
		
	
		$datos=$matriz->get_comixta_by_id_plan($_POST["id_plan"]);	
   
		 //Vamos a declarar un array
		 $data= Array();

		 foreach($datos as $row)
	
				{
					$sub_array = array();
				
					 //$sub_array[] = $row["id_matriz"];
					 $sub_array[] = $row["id_tema"];
					 $sub_array[] = $row["subgrupo"];				 
					 $sub_array[] = $row["nro_compromiso"].'. '.$row["compromiso"];					 
					 // $sub_array[] = $row["compromiso"];				 
					 $sub_array[] = $row["entidad_responsable"];
					 $sub_array[] = $row["entidad_responsable_2"];					 
					 $sub_array[] = $row["observaciones"];
					 $sub_array[] = $row["estado_cumplimiento"];
					 // $sub_array[] = date("d-m-Y",strtotime($row["fecha_actualizacion"]));
					 //$sub_array[] = $row["contacto"];
					 //$sub_array[] = $row["fecha_cumplimiento"];
					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-warning btn-md"><i class="glyphicon glyphicon-edit"></i>Ver</button>'.'<button type="button" onClick="eliminar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';
					 //$sub_array[] = '<button type="button" onClick="eliminar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';
						
					$data[] = $sub_array;
				}
	
		  $results = array(
				 "sEcho"=>1, //Información para el datatables
				 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
				 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				 "aaData"=>$data);
			 echo json_encode($results);																	
  

 	break;

	 case 'encontrarcomixtas':
		
	
		$datos=$matriz->get_comixta_by_id_pais_p($_POST["id_pais"]);	
   
		 //Vamos a declarar un array
		 $data= Array();

		 foreach($datos as $row)
	
				{
					$sub_array = array();
				
					 //$sub_array[] = $row["id_matriz"];
					 $sub_array[] = $row["id_tema"];					
					$data[] = $sub_array;
				}
	
		  $results = array(
				 "sEcho"=>1, //Información para el datatables
				 "iTotalRecords"=>count($data), //enviamos el total registros al datatable
				 "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				 "aaData"=>$data);
			 echo json_encode($results);																	
  

 	break;

     case 'mostrar':
			//el parametro cedula se envia por AJAX cuando se edita la matriz
			
			$datos=$matriz->get_matriz_por_id($_POST["id_matriz"]);



    				foreach($datos as $row)
    				{
    					$output["id_matriz"] = $row["id_matriz"];						
						$output["id_tema"] = $row["id_tema"];
						$output["id_pais"] = $row["id_pais"];
						$output["id_usuario"] = $row["id_usuario"];
						$output["subgrupo"] = $row["subgrupo"];
						$output["nro_compromiso"] = $row["nro_compromiso"];
						$output["compromiso"] = $row["compromiso"];
						$output["entidad_responsable"] = $row["entidad_responsable"];
						$output["contacto"] = $row["contacto"];
						$output["fecha_cumplimiento"] = $row["fecha_cumplimiento"];
						$output["observaciones"] = $row["observaciones"];
						$output["estado_cumplimiento"] = $row["estado_cumplimiento"];
    				}

         echo json_encode($output);
	 break;

      case "activarydesactivar":
     
     //los parametros id_cliente y est vienen por via ajax
     $datos=$clientes->get_cliente_por_id($_POST["id_cliente"]);

          // si existe el id del cliente entonces recorre el array
	      if(is_array($datos)==true and count($datos)>0){

              //edita el estado del cliente
		      $clientes->editar_estado($_POST["id_cliente"],$_POST["est"]);
		     
	        } 

     break;


	 

     case "listar":

     $datos=$matriz->get_matriz();

     //Vamos a declarar un array
 	 $data= Array();

     foreach($datos as $row)

			{
				$sub_array = array();
			
	             //$sub_array[] = $row["id_matriz"];
					 $sub_array[] = $row["id_tema"];
					 $sub_array[] = $row["subgrupo"];				 
					 $sub_array[] = $row["nro_compromiso"].'. '.$row["compromiso"];					 
					 // $sub_array[] = $row["compromiso"];				 
					 $sub_array[] = $row["entidad_responsable"];
					 $sub_array[] = $row["entidad_responsable_2"];					 
					 $sub_array[] = $row["observaciones"];
					 $sub_array[] = $row["estado_cumplimiento"];
					 // $sub_array[] = date("d-m-Y",strtotime($row["fecha_actualizacion"]));
					 //$sub_array[] = $row["contacto"];
					 //$sub_array[] = $row["fecha_cumplimiento"];
					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-warning btn-md"><i class="glyphicon glyphicon-edit"></i>Ver</button>'.'<button type="button" onClick="eliminar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';
					 //$sub_array[] = '<button type="button" onClick="eliminar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';
						
				$data[] = $sub_array;
			}

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break;

	 case "listarconid":

		if($_POST["id_usuario"] == 0){
			$datos=$matriz->get_matriz_por_id_pais($_POST["id_pais"],$_POST["id_usuario"]);		
		}
		else{
			$datos=$matriz->get_matriz_por_id_pais_cu($_POST["id_pais"],$_POST["id_usuario"]);		
		}
		//$datos=$matriz->get_matriz();
   
		//Vamos a declarar un array
		 $data= Array();
   
		foreach($datos as $row)
   
			   {
				   $sub_array = array();
					 //$sub_array[] = $row["id_matriz"];
					 $sub_array[] = $row["id_tema"];
					 $sub_array[] = $row["subgrupo"];				 
					 $sub_array[] = $row["nro_compromiso"].'. '.$row["compromiso"];					 
					 // $sub_array[] = $row["compromiso"];				 
					 $sub_array[] = $row["entidad_responsable"];
					 $sub_array[] = $row["entidad_responsable_2"];					 
					 $sub_array[] = $row["observaciones"];
					 $sub_array[] = $row["estado_cumplimiento"];
					 // $sub_array[] = date("d-m-Y",strtotime($row["fecha_actualizacion"]));
					 //$sub_array[] = $row["contacto"];
					 //$sub_array[] = $row["fecha_cumplimiento"];
					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-warning btn-md"><i class="glyphicon glyphicon-edit"></i>Ver</button>'.'<button type="button" onClick="eliminar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';
					 //$sub_array[] = '<button type="button" onClick="eliminar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';
					
					$data[] = $sub_array;
			   }
   
		 $results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
			echo json_encode($results);
   
   
	break;

      /*se muestran en ventana modal el datatable de los clientes en ventas para seleccionar luego los clientes activos y luego se autocomplementa los campos de un formulario*/
     case "listar_en_ventas":

     $datos=$clientes->get_clientes();

     //Vamos a declarar un array
 	 $data= Array();

     foreach($datos as $row)
			{
				$sub_array = array();

				$est = '';
				
				 $atrib = "btn btn-success btn-md estado";
				if($row["estado"] == 0){
					$est = 'INACTIVO';
					$atrib = "btn btn-warning btn-md estado";
				}
				else{
					if($row["estado"] == 1){
						$est = 'ACTIVO';
						
					}	
				}
				
				
	             $sub_array[] = $row["cedula_cliente"];
				 $sub_array[] = $row["nombre_cliente"];
				 $sub_array[] = $row["apellido_cliente"];
				 
				
                 $sub_array[] = '<button type="button"  name="estado" id="'.$row["id_cliente"].'" class="'.$atrib.'">'.$est.'</button>';


                 $sub_array[] = '<button type="button" onClick="agregar_registro('.$row["id_cliente"].','.$row["estado"].');" id="'.$row["id_cliente"].'" class="btn btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>';
                
				$data[] = $sub_array;
			}

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break;


     /*valida los clientes activos y se muestran en un formulario*/
     case "buscar_cliente":


	$datos=$clientes->get_cliente_por_id_estado($_POST["id_cliente"],$_POST["est"]);


          // comprobamos que el cliente esté activo, de lo contrario no lo agrega
	      if(is_array($datos)==true and count($datos)>0){

				foreach($datos as $row)
				{
					$output["cedula_cliente"] = $row["cedula_cliente"];
					$output["nombre"] = $row["nombre_cliente"];
					$output["apellido"] = $row["apellido_cliente"];
					$output["direccion"] = $row["direccion_cliente"];
					$output["estado"] = $row["estado"];
					
				}

			

	        } else {
                 
                 //si no existe el registro entonces no recorre el array
                
                 $output["error"]="El cliente seleccionado está inactivo, intenta con otro";


	        }

	        echo json_encode($output);

     break;

     case "eliminar_matriz":

        	 
  //IMPORTANTE:normalmente las compras y ventas no se pude eliminar pero aqui le estamos aplicando seguridad en PHP para tener mas seguridad con los haquers
        //verificamos si el cliente existe en la tabla ventas y detalle_ventas, si existe entonces no se puede eliminar el cliente

                  
             //validamos si existe el registro en la bd
            $datos= $matriz->get_matriz_por_id($_POST["id_matriz"]);


		       if(is_array($datos)==true and count($datos)>0){

		            $clientes->eliminar_matriz($_POST["id_matriz"]);

		            $messages[]="El registro se eliminó exitosamente";

		       
		       }
		      
   	  




	//prueba mensaje de success

     if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}


	//fin mensaje success


	   //inicio de mensaje de error

				if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}

	   //fin de mensaje de error


     break;


	 	
	 }
  


   ?>