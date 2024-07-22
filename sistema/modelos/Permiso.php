<?php 
//Incluimos inicialmente la conexion a la base de datos
require"../config/Conexion.php";

Class Permiso 
{
	//Implementamos nuestro constructor
	public function _construct()
	{

	}


public function listar()
{

$sql="SELECT * FROM permiso";
return ejecutarConsulta($sql);
 
}





}





 ?>