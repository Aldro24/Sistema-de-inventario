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
$("#idcategoria").val("");
$("#nombre").val("");
$("#descripcion").val("");
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

		'copyHtml5',
		'excelHtml5',
		'csvHtml5',
		'pdf'
],

"ajax": 
		{
			url: '../ajax/categoria.php?op=listar',
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
		url: "../ajax/categoria.php?op=guardaryeditar",
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

function mostrar(idcategoria)
{
$.post("../ajax/categoria.php?op=mostrar",{idcategoria : idcategoria}, function(data, status)
{
	data = JSON.parse(data);
	mostrarform(true);
	$("#nombre").val(data.nombre);
	$("#descripcion").val(data.descripción);
	$("#idcategoria").val(data.idcategoria);
	
})
}

//funcion para desactivar registros

function desactivar(idcategoria)
{
bootbox.confirm("¿Esta seguro que quiere desactivar la categoria?",function(result){

	if(result)
	{
$.post("../ajax/categoria.php?op=desactivar",{idcategoria : idcategoria}, function(e)
	{
		bootbox.alert(e);
		tabla.api().ajax.reload();

	});
}
})
}

function activar(idcategoria)
{
bootbox.confirm("¿Esta seguro que quiere activar la categoria?",function(result){

	if(result)
	{
$.post("../ajax/categoria.php?op=activar",{idcategoria : idcategoria}, function(e)
	{
		bootbox.alert(e);
		tabla.api().ajax.reload();

	});
}
})
}


init();


