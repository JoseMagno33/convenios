<?php

	  //llamo a la conexion de la base de datos 
      require_once("../config/conexion.php");
     //llamo al modelo Clientes
      require_once("../modelos/matrizmulti.php");

     
  
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

			if(empty($_POST["id_multilateral"])){
				//COMO SUGERENCIA ASIGNAR UN NOMBRE NUEVO AL ARCHIVO PARA QUE NO SE CONFUNDA CON OTRO
				$matrizmulti->registrar_multilateral($descripcion,$id_entidad,$nombre_archivo,$fecha,$id_usuario);
					 $messages[]="Se registró correctamente";

	   		 }//cierre de empty
	   		else {
		   /*si ya existe entonces editamos multilateral*/
			   $matrizmulti->editar_multilateral($id_multilateral,$descripcion,$id_entidad,$nombre_archivo,$fecha,$id_usuario);
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
			
			$datos=$matrizmulti->get_multilateral_por_id($_POST["id_multilateral"]);

    				foreach($datos as $row)
    				{	
											
    					$output["id_multilateral"] = $row["id_multilateral"];						
						$output["descripcion"] = $row["descripcion"];
						$output["id_entidad"] = $row["id_entidad"];	
						$output["fecha"] = $row["fecha"];
						$output["nombre_archivo"] ='  ';
						//$output["fecha_actualizacion"] = $row["fecha_actualizacion"];						
						/*if($row["nombre_archivo"] != '' )										
						{
							$output['nombre_archivo'] = '<a href="upload/'.$row["nombre_archivo"].'" /><input type="hidden" name="hidden_producto_imagen" value="'.$row["nombre_archivo"].'" />';
					
						}
						else
						{
						$output['nombre_archivo'] = '<input type="hidden" name="hidden_producto_imagen" value="" />';
						}*/
																	
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

     

     case 'listar':

     $datos=$matrizmulti->get_sub_m();

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
                 $sub_array[] = '<button type="button" onClick="mostrar('.$row["id_multilateral"].');" id="'.$row["id_multilateral"].'" class="btn btn-warning btn-md"><i class="glyphicon glyphicon-edit"></i> Editar</button>';
                 $sub_array[] = '<button type="button" onClick="eliminar('.$row["id_multilateral"].');" id="'.$row["id_multilateral"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';
                	
				$data[] = $sub_array;
			}

      $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


     break;


	 case 'listarconid':

		$datos=$matrizmulti->buscar_hijo($_POST["id_entidad"]);
		
		$data= Array();
   
		foreach($datos as $row)
		   
			   {
				   $sub_array = array();
					
					$sub_array[] = $row["id_entidad"];
					$sub_array[] = $row["descripcion"];					
					//$sub_array[] = $row["nombre_archivo"];
					if($row["nombre_archivo"] != '')
					
						{
							$sub_array[] = '

							<a  href="upload/'.$row["nombre_archivo"].'" target="_blank" >Ver Archivo</a>
							';
						}
						else
						{
							$sub_array[] = '<button type="button" id="" class="btn btn-primary btn-md"><i class="fa fa-picture-o" aria-hidden="true"></i> Sin Archivo</button>';
						}
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