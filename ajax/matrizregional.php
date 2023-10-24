<?php

	  //llamo a la conexion de la base de datos 
      require_once("../config/conexion.php");
     //llamo al modelo Clientes
      require_once("../modelos/matrizregional.php");

     
  
     $matrizmulti = new MatrizMulti();


     //declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo
   
   //los valores vienen del atributo name de los campos del formulario
   /*el valor id_usuario y cedula_cliente se carga en el campo hidden cuando se edita un registro*/
   //se copian los campos de la tabla clientes
   
   $id_usuario=isset($_POST["id_usuario"]);
   $id_multilateral=isset($_POST["id_multilateral"]);
   $descripcion=isset($_POST["descripcion"]);
   $id_entidad=isset($_POST["id_entidad"]);
   $nombre_archivo=isset($_POST["nombre_archivo"]);
   $fecha=isset($_POST["fecha"]);
   $fecha_actualizacion=isset($_POST["fecha_actualizacion"]);
   



      switch($_GET["op"]){

           case "guardaryeditar":

	       	   /*si id_matriz no existe entonces lo registra
	           importante: se debe poner el $_POST sino no funciona*/
				
	          	if(empty($_POST["id_matriz"])){
	       	  		
		 				$matrizpais->registrar_matriz($id_tema,$compromiso,$entidad_responsable,$contacto,$fecha_cumplimiento,$observaciones,$estado_cumplimiento,$id_usuario);
			       	   	$messages[]="Se registró correctamente";

			    }//cierre de empty
	            else {

					
	            	/*si ya existe entonces editamos matriz*/


	            	 $matrizpais->editar_matriz($id_matriz,$observaciones,$estado_cumplimiento,$id_usuario);


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

	
	 case 'encontrarcomponente':
		
	
		$datos= $matrizmulti->get_componente($_POST["id_entidad"]);
		
		$data = '';
		
		foreach($datos as $row)
				{
					$data = $data.'<option value="'.$row["id_entidad"].'"> '.$row["nombre_entidad"].'</option>';			
				}

				$data = '<select name="lst_compo" id="lst_compo" class="form-control"><option value="0">SELECCIONE UN COMPONENTE</option>'.$data.'</select>';	
   		echo $data;

 	break;


     case 'mostrar':
			//el parametro cedula se envia por AJAX cuando se edita la matriz
			
			$datos=$matrizpais->get_matriz_por_id($_POST["id_matriz"]);



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

	  case 'llenarmatriz':
			//el parametro id_pais se envia por AJAX cuando se edita la pais
			
			$datos=$pais->get_pais_por_id($_POST["id_pais"]);



					foreach($datos as $row)
					{
						$output["id_pais"] = $row["id_pais"];
						$output["pais"] = $row["pais"];
						$output["abrev"] = $row["abrev"];
						
					}

		echo json_encode($output);
		
	break;

     

     case "listar":

     $datos=$matrizpais->get_sub_m();

     //Vamos a declarar un array
 	 $data= Array();

     foreach($datos as $row)

			{
				$sub_array = array();
			
	             //$sub_array[] = $row["id_multilateral"];
				 $sub_array[] = $row["id_entidad"];
				 $sub_array[] = $row["descripcion"];					
				 $sub_array[] = $row["nombre_archivo"];
				 $sub_array[] = $row["fecha"];
                 $sub_array[] = '<button type="button" onClick="mostrar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-warning btn-md"><i class="glyphicon glyphicon-edit"></i> Editar</button>';
                 $sub_array[] = '<button type="button" onClick="eliminar('.$row["id_matriz"].');" id="'.$row["id_matriz"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';
                	
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

		$datos=$matrizmulti->buscar_hijo($_POST["id_entidad"]);
		
		$data= Array();
   
		foreach($datos as $row)
		   
			   {
				   $sub_array = array();
					
					$sub_array[] = $row["id_entidad"];
					$sub_array[] = $row["descripcion"];					
					$sub_array[] = $row["nombre_archivo"];
					$sub_array[] = $row["fecha"];
					$sub_array[] = '<button type="button" onClick="mostrar('.$row["id_multilateral"].');" id="'.$row["id_multilateral"].'" class="btn btn-warning btn-md"><i class="glyphicon glyphicon-edit"></i> Editar</button>';		
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
    


     /*valida los clientes activos y se muestran en un formulario*/
     

	 }
  


   ?>