<?php 
//Incluimos inicialmente la conexion a la base de datos
require"../config/Conexion.php";

Class articulo
{
	//Implementamos nuestro constructor
	public function _construct()
	{

	}

	//Implementamos un método para insertar registros 

	public function insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen)
	{
		$sql="INSERT INTO articulo (idcategoria,codigo,nombre,stock, descripción,imagen, condicion)
		VALUES ('$idcategoria','$codigo','$nombre', '$stock','$descripcion','$imagen' ,'1')";

		return ejecutarConsulta($sql);
	}



	public function editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen)
	{
		$sql="UPDATE articulo SET idcategoria='$idcategoria', codigo='$codigo',nombre='$nombre',stock='$stock',descripción='$descripcion', imagen='$imagen' WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}

//implementamos un metodo para desactivar articulos


public function desactivar ($idarticulo)
{
	$sql="UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}

public function activar ($idarticulo)
{
	$sql="UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}

//implementar un metodo para mostrar los datos de un registro a modificar

public function mostrar($idarticulo){

	$sql= " SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
	return ejecutarConsultaSimpleFila($sql);
}

// implementar un metodo para listar los registros

public function listar()
{
$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria, a.codigo,a.nombre, a.stock, a.descripción,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria";
return ejecutarConsulta($sql); 
}

//listar registros activos
public function listarActivos()
{
$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria, a.codigo,a.nombre, a.stock, a.descripción,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
return ejecutarConsulta($sql); 
}

//metodo para listar registros activos,precio stock finales, ademas de unir registro con la tabla detalle_ingreso


public function listarActivosVenta()
{
	$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripción,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	return ejecutarConsulta($sql);
}

public function listara()
{
$sql="SELECT * FROM articulo WHERE condicion='1'";
return ejecutarConsulta($sql); 
}

}





 ?>