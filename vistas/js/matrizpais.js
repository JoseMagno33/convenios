

var tabla;

var tabla_en_ventas;



//Función que se ejecuta al inicio
function init(){
	
	//listar();

	//llama la lista de clientes en ventana modal en ventas.php
    //listar_en_ventas();

	 //cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	 document.getElementById('vista_a').style.display = 'none';
	 document.getElementById('vista_b').style.display = 'none';
	 document.getElementById('vista_c').style.display = 'none';
	$("#matrizpais_form").on("submit",function(e)
	{
		
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
	
	$('#compromiso').val("");
	$('#entidad_responsable').val("");
	$('#contacto').val("");
	$('#observaciones').val("");
	$('#fecha_cumplimiento').val("");
	$('#direccion').val("");
	$('#estado_cumplimiento').val("");
	$('#fecha_actualizacion').val("");
}
function encontrar_titulo(id_pais)
{
	
	tabla=$('#titulo_data').dataTable(
		{
			searching: false, paging: false, info: false,
			"aProcessing": false,//Activamos el procesamiento del datatables
			"aServerSide": false,
			
			"ajax":
					{
						url: '../ajax/matrizpais.php?op=mostrartitulo',
						type : "POST",
						data:{id_pais:id_pais},
						dataType : "json",						
						error: function(e){
							console.log(e.responseText);	
						}
					},
			"bDestroy": true,
			"responsive": true,
			"bInfo":true,
			
			
			   
		}).DataTable();

}	

function asignar_entidad_22(id_pais)
{

	$.ajax({
		type:"POST",
		url:"../ajax/matrizpais.php?op=encontrarentidad",
		data:{id_pais:id_pais},
		dataType: 'html',
		success:function(data){
			$('#ent_r').html(data);
			$('#ent_r2').html(data);
		}
	})

}

function encontrar_titulo_plan(id_plan)
{
	
	tabla=$('#titulo_data').dataTable(
		{
			searching: false, paging: false, info: false,
			"aProcessing": true,//Activamos el procesamiento del datatables
			"aServerSide": true,
			
			"ajax":
					{
						url: '../ajax/matrizpais.php?op=mostrartituloplan',
						type : "POST",
						data:{id_plan:id_plan},
						dataType : "json",						
						error: function(e){
							console.log(e.responseText);	
						}
					},
			"bDestroy": true,
			"responsive": true,
			"bInfo":true
			   
		}).DataTable();

}

function completarselect(id_pais)
{
	//var selector = document.getElementsById("lst_com1").value;


	//alert(id_pais);
	$.ajax({
		type:"POST",
		url:"../ajax/matrizpais.php?op=encontrarcomixtas",
		data:{id_pais:id_pais},
		dataType: 'html',
		success:function(data){
			$('#selectlistacom').html(data);
		
		}

	})


}
function listar_matriz_por_pais_d()
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

function listar_matriz_por_pais()
{

	document.getElementById('vista_a').style.display = 'none';
	document.getElementById('vista_b').style.display = 'contents';
	document.getElementById('vista_c').style.display = 'contents';

	var id_pais = $('#lst_pais').val();
	var id_usu= $('#id_usu').val();
	//completarselect(id_pais);

	encontrar_titulo(id_pais);

	tabla=$('#matrizpais_data').dataTable(
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
					url: '../ajax/matrizpais.php?op=listarconid',
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
//Función Listar
function listar()
{
	tabla=$('#matrizpais_data').dataTable(
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
					url: '../ajax/matrizpais.php?op=listar',
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

function listar_matriz_por_plan1()
{

	document.getElementById('vista_a').style.display = 'none';
	document.getElementById('vista_b').style.display = 'contents';
	document.getElementById('vista_c').style.display = 'contents';
	
	var id_plan = $('#lst_com1').val();
	var id_usuario= $('#id_usu').val();
	var id_pais = $('#lst_pais').val();
	//alert(id_usuario);
	encontrar_titulo_plan(id_plan);
	asignar_entidad_22(id_pais);

	tabla=$('#matrizpais_data').dataTable(
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
					url: '../ajax/matrizpais.php?op=matrizporplan',
					type : "POST",
					data:{id_plan:id_plan, id_usuario:id_usuario},
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
function mostrar(id_matriz)
{
	$.post("../ajax/matrizpais.php?op=mostrar",{id_matriz : id_matriz}, function(data, status)
	{
		data = JSON.parse(data);

		 //alert(data.cedula);

		   console.log(data);
		
					$('#matrizpaisModal').modal('show');
					$('#id_matriz').val(id_matriz);
					$('#id_tema').val(data.id_tema);
					$('#id_pais').val(data.id_pais);
					$('#id_usuario').val(data.id_usuario);
					$('#subgrupo').val(data.subgrupo);
					$('#nro_compromiso').val(data.nro_compromiso);
					$('#compromiso').val(data.compromiso);
					$('#entidad_responsable').val(data.entidad_responsable);
					$('#contacto').val(data.contacto);
					$('#fecha_cumplimiento').val(data.fecha_cumplimiento);
					$('#observaciones').val(data.observaciones);
					$('#estado_cumplimiento').val(data.estado_cumplimiento);
					$('.modal-title').text("Editar Matriz");
					$('#id_matriz').val(id_matriz);	
		});
        
        
	}

	function llenamatriz(id_pais)
	{
		$.post("../ajax/matrizpais.php?op=llenamatriz",{id_pais : id_pais}, function(data, status)
		{
			data = JSON.parse(data);
	
			   console.log(data);
			
						//$('#paisModal').modal('show');
						//$('#paisModal').modal('show');
						$('#pais').val(data.pais);
						$('#abrev').val(data.abrev);
						//$('.modal-title').text("Editar Pais");
						$('#id_pais').val(id_pais);	
			});
			
			
	}


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
	
	//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#matrizpais_form")[0]);
		//alert("entramos aqui? si es asi es guardaryeditar");
	
		$.ajax({
			url: "../ajax/matrizpais.php?op=guardaryeditar",
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

	            $('#matrizpais_form')[0].reset();
				$('#matrizpaisModal').modal('hide');

				$('#resultados_ajax').html(datos);
				$('#matrizpais_data').DataTable().ajax.reload();
				
                limpiar();
					
		    }

		});
       
}


init();