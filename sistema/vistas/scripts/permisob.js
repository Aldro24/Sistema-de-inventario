var tabla;

//funcion que se ejecuta al inicio

function init(){

mostrarform(false);
listar();
}



//funcion mostrar formulario

function mostrarform(flag){
	//limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		
		$("#btnagregar").hide();


	}else
	{
			$("#listadoregistros").show();
			$("#formularioregistros").hide();
			$("#btnagregar").hide();

	
	}
}



//funcion listar
function listar(){

	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
		"aServerside":true,//Paginacion y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de tabla

		buttons: [

		
],

"ajax": 
		{
			url: '../ajax/permiso.php?op=listar',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseTxt);
			}

		},

		"bDestroy": true,
		"iDisplayLength": 10, //paginación
		"order":[[0,"desc"]] // ordenar (columna, orden)



	}).dataTable();
}

init();


