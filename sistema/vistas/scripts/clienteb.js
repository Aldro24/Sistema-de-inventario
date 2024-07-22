var tabla;

//funcion que se ejecuta al inicio

function init(){

mostrarform(false);
listar();

$("#formulario").on("submit", function(e){
	guardaryeditar(e);
})
}

// funcion limpiar

function limpiar(){
$("#nombre").val("");
$("#num_documento").val("");
$("#direccion").val("");
$("#telefono").val("");
$("#email").val("");
$("#idpersona").val("");

}

//funcion mostrar formulario

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		
		$("#btnagregar").hide();


	}else
	{
			$("#listadoregistros").show();
			$("#formularioregistros").hide();
			$("#btnagregar").show();

	
	}
}

//funcion cancelarform

function cancelarform(){
	limpiar();
	mostrarform(false);
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
			url: '../ajax/persona.php?op=listarc',
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

//funcion para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault();//No se activara la accion predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/persona.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos)
		{
			bootbox.alert(datos);
			mostrarform(false);
			tabla.api().ajax.reload();
		}

	});
	limpiar();
}

function mostrar(idpersona)
{
$.post("../ajax/persona.php?op=mostrar",{idpersona : idpersona}, function(data, status)
{
	data = JSON.parse(data);
	mostrarform(true);
	$("#nombre").val(data.nombre);
	$("#tipo_documento").val(data.tipo_documento);
	$("#tipo_documento").selectpicker('refresh');
	$("#num_documento").val(data.num_documento);
	$("#direccion").val(data.direccion);
	$("#telefono").val(data.telefono);
	$("#email").val(data.email);
	$("#idpersona").val(data.idpersona);
	
	
})
}

//funcion para desactivar registros

function eliminar(idpersona)
{
bootbox.confirm("¿Esta seguro que quiere eliminar el cliente?",function(result){

	if(result)
	{
$.post("../ajax/persona.php?op=eliminar",{idpersona : idpersona}, function(e)
	{
		bootbox.alert(e);
		tabla.api().ajax.reload();

	});
}
})
}



init();


