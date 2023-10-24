var tabla;

var tabla_en_ventas;

//Función que se ejecuta al inicio
function init(){
	
	listar();

	//llama la lista de clientes en ventana modal en ventas.php
   // listar_en_ventas();

	 //cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#archivo_form").on("submit",function(e)
	{
		
		guardaryeditar(e);	
		
	})
    
    //cambia el titulo de la ventana modal cuando se da click al boton
	$("#add_button").click(function(){

		     //habilita los campos cuando se agrega un registro nuevo
			 // $("#cedula").attr('disabled', false);
			 // $("#nombre").attr('disabled', false);
			 // $("#apellido").attr('disabled', false);
			
			$(".modal-title").text("Agregar Archivo");
		
	  });

	
}

//Función limpiar
/*IMPORTANTE: no limpiar el campo oculto del id_usuario, sino no se registra
el cliente*/
function limpiar()
{
	//todo archivo y pais
	$('#id_archivo').val("");
	$('#id_pais').val("");
	$('#nombre_archivo').val("");

		$('#descripcion').val("");
}


//Función Listar
function listar()
{

	tabla=$('#archivo_data').dataTable(

	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/archivo.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "desc" ]],//Ordenar (columna,orden)
	    
	    "language": {
 
			    "sProcessing":     "Procesando...",
			 
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			 
			    "sZeroRecords":    "No se encontraron resultados",
			 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			 
			    "sInfo":           "Mostrando un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando un total de 0 registros",
			 
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			 
			    "sInfoPostFix":    "",
			 
			    "sSearch":         "Buscar:",
			 
			    "sUrl":            "",
			 
			    "sInfoThousands":  ",",
			 
			    "sLoadingRecords": "Cargando...",
			 
			    "oPaginate": {
			 
			        "sFirst":    "Primero",
			 
			        "sLast":     "Último",
			 
			        "sNext":     "Siguiente",
			 
			        "sPrevious": "Anterior"
			 
			    },
			 
			    "oAria": {
			 
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			 
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			 
			    }

			   }//cerrando language
	       
	}).DataTable();
}


//Mostrar datos del cliente en la ventana modal 
function mostrar(id_archivo)
{
	$.post("../ajax/archivo.php?op=mostrar",{id_archivo : id_archivo}, function(data, status)
	{
		data = JSON.parse(data);

	//	 alert(data.descripcion);

		   console.log(data);
		
					$('#archivoModal').modal('show');
					$('#id_pais').val(data.id_pais);
					$('#descripcion').val(data.descripcion);
					$('#tipov').val(data.tipov);
					$('#producto_uploaded_image').html(data.nombre_archivo);					
					//espero que sea algo agradable
					//$('#abrev').val(data.abrev);
					$('.modal-title').text("Editar Archivo");
					$('#id_archivo').val(id_archivo);	
		});
        
        
}
function llenamatriz(id_pais)
{
	$.post("../ajax/pais.php?op=llenamatriz",{id_pais : id_pais}, function(data, status)
	{
		data = JSON.parse(data);

		 alert(data.id_pais);

		   console.log(data);
		
					//$('#paisModal').modal('show');
					//$('#paisModal').modal('show');
					$('#pais').val(data.pais);
					$('#abrev').val(data.abrev);
					//$('.modal-title').text("Editar Pais");
					$('#id_pais').val(id_pais);	
		});
        
        
}




	//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#archivo_form")[0]);
		//alert("entramos aqui? si es asi es guardaryeditar");
		
		$.ajax({
			url: "../ajax/archivo.php?op=guardaryeditar",
		    type: "POST",
		    data: formData,
		    contentType: false,
		    processData: false,

		    success: function(datos)
		    {                    
		          /*bootbox.alert(datos);	          
		          mostrarform(false);
		          tabla.ajax.reload();*/

		         //alert(datos);
                 
                 /*imprimir consulta en la consola debes hacer un print_r($_POST) al final del metodo 
                    y si se muestran los valores es que esta bien, y se puede imprimir la consulta desde el metodo
                    y se puede ver en la consola o desde el mensaje de alerta luego pegar la consulta en phpmyadmin*/
		         // console.log(datos);

	            $('#archivo_form')[0].reset();
				$('#archivoModal').modal('hide');

				$('#resultados_ajax').html(datos);
				$('#archivo_data').DataTable().ajax.reload();
				
                limpiar();
					
		    }

		});
       
}

//EDITAR ESTADO DEL CLIENTE
//importante:id_cliente, est se envia por post via ajax



    //Función Listar
function listar_en_ventas(){

	tabla_en_ventas=$('#lista_clientes_data').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/cliente.php?op=listar_en_ventas',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "desc" ]],//Ordenar (columna,orden)
	    
	    "language": {
 
			    "sProcessing":     "Procesando...",
			 
			    "sLengthMenu":     "Mostrar _MENU_ registros",
			 
			    "sZeroRecords":    "No se encontraron resultados",
			 
			    "sEmptyTable":     "Ningún dato disponible en esta tabla",
			 
			    "sInfo":           "Mostrando un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando un total de 0 registros",
			 
			    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			 
			    "sInfoPostFix":    "",
			 
			    "sSearch":         "Buscar:",
			 
			    "sUrl":            "",
			 
			    "sInfoThousands":  ",",
			 
			    "sLoadingRecords": "Cargando...",
			 
			    "oPaginate": {
			 
			        "sFirst":    "Primero",
			 
			        "sLast":     "Último",
			 
			        "sNext":     "Siguiente",
			 
			        "sPrevious": "Anterior"
			 
			    },
			 
			    "oAria": {
			 
			        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			 
			        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			 
			    }

			   }//cerrando language
	       
	}).DataTable();
}


//AUTOCOMPLETAR DATOS DEL CLIENTE EN VENTAS
	

	 	function agregar_registro(id_cliente,est){

      
		$.ajax({
			url:"../ajax/cliente.php?op=buscar_cliente",
			method:"POST",
			data:{id_cliente:id_cliente,est:est},
			dataType:"json",
			success:function(data)
			{
               
             
            /*si el cliente esta activo entonces se ejecuta, de lo contrario 
            el formulario no se envia y aparecerá un mensaje */
            if(data.estado){

				$('#modalCliente').modal('hide');
				$('#cedula').val(data.cedula_cliente);
				$('#nombre').val(data.nombre);
				$('#apellido').val(data.apellido);
				$('#direccion').val(data.direccion);
				$('#id_cliente').val(id_cliente);
				

            } else{
                
                bootbox.alert(data.error);
              	


             } //cierre condicional error

                        
				
			}
		})
	
    }
     
     //ELIMINAR MATRIZ

	 function eliminar(id_cliente){

	  
	    bootbox.confirm("¿Está Seguro de eliminar el cliente?", function(result){
		if(result)
		{

				$.ajax({
					url:"../ajax/cliente.php?op=eliminar_cliente",
					method:"POST",
					data:{id_cliente:id_cliente},

					success:function(data)
					{
						//alert(data);
						$("#resultados_ajax").html(data);
						$("#cliente_data").DataTable().ajax.reload();
					}
				});

		      }

		 });//bootbox


   }
		//Enviar venta salida

init();