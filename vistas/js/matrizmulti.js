var tabla;

var tabla_en_ventas;

//Función que se ejecuta al inicio
function init(){
	
	//listar();
	//alert('ingresando... ');
	//document.getElementById('vista_a').style.display = 'none';
	document.getElementById('vista_b').style.display = 'none';
	//document.getElementById('vista_c').style.display = 'none';

  //  listar_en_ventas();

	 //cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#matriz_form").on("submit",function(e)
	{
		//alert("entramos aqui? si es asi es guardaryeditar1111");
		guardaryeditar(e);	
		
	})
    
    //cambia el titulo de la ventana modal cuando se da click al boton
	$("#add_button").click(function(){

		     //habilita los campos cuando se agrega un registro nuevo
			 // $("#cedula").attr('disabled', false);
			 // $("#nombre").attr('disabled', false);
			 // $("#apellido").attr('disabled', false);		
			$(".modal-title").text("Agregar Matriz");
		
	  });

	
}

//Función limpiar
/*IMPORTANTE: no limpiar el campo oculto del id_usuario, sino no se registra
el cliente*/



function limpiar()
{
	
	$('#id_multilateral').val("");
	$('#descripcion').val("");
	$('#nro_compromiso').val("");
	$('#fecha').val("");
	$('#fecha_actualizacion').val("");
	$('#id_entidad').val("");

}

function completarselect(id_entidad)
{

	$.ajax({
		type:"POST",
		url:"../ajax/matrizmulti.php?op=encontrarcomponente",
		data:{id_entidad:id_entidad},
		dataType: 'html',
		success:function(data){
			$('#selectlistamulti').html(data);
		
		}

	})


}
function buscarcomponentes()
{
	document.getElementById('vista_b').style.display = 'contents';
	var id_entidad = $('#lst_entidad').val();
	completarselect(id_entidad);

}

function buscarsubcomponentes()
{

	//document.getElementById('vista_a').style.display = 'none';
	//document.getElementById('vista_b').style.display = 'contents';
	//document.getElementById('vista_c').style.display = 'contents';
	
	var id_entidads = $('#lst_compo').val();
	//var id_usu= $('#id_usu').val();
	//completarselect(id_pais);
	
	//alert(id_entidad);
	//encontrar_titulo(id_pais);
	
	tabla=$('#multi_data').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
		AutoWidth: false,
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            
		        ],
		"ajax":
				{
					url: '../ajax/matrizmulti.php?op=listarconid',
					type : "POST",
					data:{id_entidad:id_entidads},
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": false,//Ordenar (columna,orden)
	    
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


//llenamos select de comixta
function llenarcomixta(){
	var comixta = $('#comixta');
	$('#lst_pais').change(function(){
		var id_pais = $(this).val(); //obtener el id seleccionado
		if(id_pais !== ''){ //verificar haber seleccionado una opcion valida
		  $.ajax({
			data: {id_pais:id_pais}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
			dataType: 'html', //tipo de datos que esperamos de regreso
			type: 'POST', //mandar variables como post o get
			url: '../ajax/matrizpais.php?op=encontrarcomixtas' //url que recibe las variables
		  }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             
		  });		 
		}
	  });

}


function listar_matriz_por_pais2()
{

	document.getElementById('vista_a').style.display = 'none';
	document.getElementById('vista_b').style.display = 'contents';
	document.getElementById('vista_c').style.display = 'contents';
	var id_pais = $('#lst_pais').val();
	completarselect(id_pais);

	//var table = $('#matrizpais_data').DataTable();
	//table.clear().draw();
	//encontrar_titulo(id_pais);
	//alert(id_pais);

}

function listar_matriz_por_pais1()
{

	document.getElementById('vista_a').style.display = 'none';
	document.getElementById('vista_b').style.display = 'contents';
	document.getElementById('vista_c').style.display = 'contents';
	
	var id_pais = $('#lst_pais').val();
	var id_usu= $('#id_usu').val();
	completarselect(id_pais);

	encontrar_titulo(id_pais);
	

	tabla=$('#matriz_data').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
		AutoWidth: false,
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/matrizmulti.php?op=listarconid',
					type : "POST",
					data:{id_pais:id_pais,id_usuario:id_usu},
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": false,//Ordenar (columna,orden)
	    
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



function listar_matriz_por_plan()
{

	document.getElementById('vista_a').style.display = 'none';
	document.getElementById('vista_b').style.display = 'contents';
	document.getElementById('vista_c').style.display = 'contents';
	
	var id_plan = $('#lst_com1').val();
	//var id_usu= $('#id_usu').val();
	
	encontrar_titulo_plan(id_plan);



	tabla=$('#matriz_data').dataTable(
		{
			"aProcessing": true,//Activamos el procesamiento del datatables
			"aServerSide": true,//Paginación y filtrado realizados por el servidor
			bAutoWidth: false,
			dom: 'Bfrtip',//Definimos los elementos del control de tabla
		
			buttons: [		          
						'copyHtml5',
						'excelHtml5',
						'csvHtml5',
						'pdf'
					],
			"ajax":
					{
						url: '../ajax/matrizmulti.php?op=matrizporplan',
						type : "POST",
						data:{id_plan:id_plan},
						dataType : "json",						
						error: function(e){
							console.log(e.responseText);	
						}
					},
			"bDestroy": true,
			"responsive": true,
			"bInfo":true,
			"iDisplayLength": 10,//Por cada 10 registros hace una paginación
			"order": false,//Ordenar (columna,orden)
			
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
				 
					},

					columnDefs: [
						{width: "10px",targets: 0 },
					  	{width: "10px",targets: 1 },
					  	{width: "400px",targets: 2},
					  	{width: "40px",targets: 3},
					  	{width: "5px",targets: 4},
					  	{width: "400px",targets: 5},
					  	{width: "70px",targets: 6},
					  	{width: "70px",targets: 7}
					]
	
				   }//cerrando language
			   
		}).DataTable();
	
}


//Listado de archivos



function listar_archivos()
{

	var tipov =$('#tipov').val();
	var id_pais =$('#lst_pais').val();
	
	//alert(arch);		
	document.getElementById('vista_c').style.display = 'none';
	document.getElementById('vista_a').style.display = 'contents';

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
					url: '../ajax/archivo.php?op=listararchivo',
					type : "POST",
					data:{id_pais:id_pais,tipov:tipov},
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
		"order": false,//Ordenar (columna,orden)
	    
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


//Función Listar
function listar()
{

	document.getElementById('vista_a').style.display = 'none';
	document.getElementById('vista_c').style.display = 'contents';
	
	tabla=$('#matriz_data').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
		bAutoWidth: false,
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/matrizmulti.php?op=listar',
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
		"order": false,//Ordenar (columna,orden)
	    
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
function mostrar(id_multilateral)
{
	
	
	$.post("../ajax/matrizmulti.php?op=mostrar",{id_multilateral : id_multilateral}, function(data, status)
	{
		data = JSON.parse(data);



		   console.log(data);
		
					$('#matrizmultiModal').modal('show');
					$('#id_multilateral').val(id_multilateral);
					$('#descripcion').val(data.descripcion);
					$('#id_entidad').val(data.id_entidad);
					$('#nombre_archivo').val(data.nombre_archivo);
					$('#fecha').val(data.fecha);
					$('#fecha_actualizacion').val(data.fecha_actualizacion);					
					$('.modal-title').text("Editar Matriz");					
		});
        
        
	}




	//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#matriz_form")[0]);
		//alert("entramos aqui? si es asi es guardaryeditar");
	console.log(formData);
		$.ajax({
			url: "../ajax/matrizmulti.php?op=guardaryeditar",
		    type: "POST",
		    data: formData,
		    contentType: false,
		    processData: false,

		    success: function(datos)
		    {                    
		         
	            $('#matriz_form')[0].reset();
				$('#matrizmultiModal').modal('hide');

				$('#resultados_ajax').html(datos);
				$('#multi_data').DataTable().ajax.reload();
				
                limpiar();
					
		    }

		});
       
}


//EDITAR ESTADO DEL CLIENTE
//importante:id_cliente, est se envia por post via ajax



     //ELIMINAR CLIENTE

	 function eliminar(id_matriz){

	  
	    bootbox.confirm("¿Está Seguro de eliminar el registro?", function(result){
		if(result)
		{

				$.ajax({
					url:"../ajax/matrizmulti.php?op=eliminar_matriz",
					method:"POST",
					data:{id_matriz:id_matriz},

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