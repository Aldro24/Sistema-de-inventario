<?php 
require_once "global.php";

$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query( $conexion, 'SET NAMES "'.DB_ENCODE.'"');

//Si tenemos un posible error en la conexión lo mostramos
if (mysqli_connect_errno())
{
	printf("Falló conexión a la base de datos: %s\n",mysqli_connect_error());
	exit();
}

if (!function_exists('ejecutarConsulta'))
{

	function ejecutarConsultaKardex($sql,$idarticulo)
	{
		global $conexion;


		$stmt = $conexion->prepare("DELETE FROM  kardex");
		$stmt->execute();

		$stmt1 = $conexion->prepare("INSERT INTO `kardex`(`fecha`, `cantidad`, `precio`, `idproducto`) SELECT ingreso.fecha_hora,detalle_ingreso.cantidad_articulos,detalle_ingreso.precio_compra,articulo.idarticulo FROM articulo,detalle_ingreso,ingreso where articulo.idarticulo=detalle_ingreso.idarticulo and detalle_ingreso.idingreso=ingreso.idingreso and articulo.idarticulo='$idarticulo'");
		$stmt1->execute();

		$stmt3 = $conexion->prepare("INSERT INTO `kardex`(`fecha`, `cantidad`, `precio`, `idproducto`) SELECT venta.fecha_hora,detalle_venta.cantidad*(-1),detalle_venta.precio_venta,articulo.idarticulo FROM articulo,detalle_venta,venta where articulo.idarticulo=detalle_venta.idarticulo and detalle_venta.idventa=venta.idventa and articulo.idarticulo='$idarticulo'");
		$stmt3->execute();


		$query = $conexion->query($sql);
		return $query;
	}


	function ejecutarConsulta($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
	}

	function ejecutarConsultaSimpleFila($sql)
	{
		global $conexion;

		$query = $conexion->query($sql);		
		$row = $query->fetch_assoc();
		
		return $row;
	}

	function ejecutarConsulta_retornarID($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);		
		return $conexion->insert_id;			
	
	}

	function limpiarCadena($str)
	{
		global $conexion;
		$str = mysqli_real_escape_string($conexion,trim($str));
		return htmlspecialchars($str);
	}
}
?>