<?php

	  //llamo a la conexion de la base de datos 
      require_once("../config/conexion.php");
     //llamo al modelo matriz
      require_once("../modelos/matriz.php");
		//llamo al modelo matriz
		require_once("../modelos/gestion.php");

      //llamo al modelo Ventas
     require_once("../modelos/Ventas.php");

  
     $gestion = new Gestion();


     //declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo
   
   //los valores vienen del atributo name de los campos del formulario
   /*el valor id_usuario y cedula_cliente se carga en el campo hidden cuando se edita un registro*/
   //se copian los campos de la tabla clientes
   $id_usuario=isset($_POST["id_usuario"]);
   $id_matriz=isset($_POST["id_matriz"]);
   $id_pais=isset($_POST["id_pais"]);
   $pais1 = isset($_POST["pais"]);
   $abrev = isset($_POST["abrev"]);
   


      switch($_GET["op"]){

           case "guardaryeditar":

	       	   /*si id_matriz no existe entonces lo registra
	           importante: se debe poner el $_POST sino no funciona*/
				
	          	if(empty($_POST["id_pais"])){
	       	  		
		 				$pais->registrar_pais($pais1,$abrev,$id_usuario);
			       	   	$messages[]="Se registró correctamente";

			    }//cierre de empty
	            else {
	            	/*si ya existe entonces editamos matriz*/
						$pais->editar_pais($id_pais,$pais1,$abrev,$id_usuario);
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

     case 'mostrar':
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

     $datos=$pais->get_pais();

     //Vamos a declarar un array
 	 $data= Array();

     foreach($datos as $row)

			{
				$sub_array = array();
			
	             $sub_array[] = $row["pais"];
				 $sub_array[] = $row["abrev"];

				 $sub_array[] = '<button type="button" onClick="mostrar('.$row["id_pais"].');" id="'.$row["id_pais"].'" class="btn btn-warning btn-md"><i class="glyphicon glyphicon-edit"></i> Editar</button>';
                 $sub_array[] = '<button type="button" onClick="eliminar('.$row["id_pais"].');" id="'.$row["id_pais"].'" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';
 
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

     case "eliminar_cliente":

        	 
  //IMPORTANTE:normalmente las compras y ventas no se pude eliminar pero aqui le estamos aplicando seguridad en PHP para tener mas seguridad con los haquers
        //verificamos si el cliente existe en la tabla ventas y detalle_ventas, si existe entonces no se puede eliminar el cliente

        $ventas = new Ventas();

        $vent= $ventas->get_ventas_por_id_cliente($_POST["id_cliente"]);

        $detalle_vent= $ventas->get_detalle_ventas_por_id_cliente($_POST["id_cliente"]);

        
        if(is_array($vent)==true and count($vent)>0 && is_array($detalle_vent)==true and count($detalle_vent)>0){


        	   //si existe el cliente en ventas y detalle_ventas entonces no lo elimina
					
					
			    $errors[]="El cliente existe en ventas y en detalle ventas, no se puede eliminar";


   	    }//fin

   	    else{

            
             //validamos si existe el registro en la bd
            $datos= $clientes->get_cliente_por_id($_POST["id_cliente"]);


		       if(is_array($datos)==true and count($datos)>0){

		            $clientes->eliminar_cliente($_POST["id_cliente"]);

		            $messages[]="El Cliente se eliminó exitosamente";

		       
		       }
		      
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