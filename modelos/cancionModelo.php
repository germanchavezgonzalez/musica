<?php
include_once('../db/conectar.php');


// Modelo contiene la lógica de la aplicación: clases y métodos que se comunican
// con la Base de Datos

//Creación de una clase para ejecutar la sentencia SQL
class Cancion{
	public $TrackId;
	public $Name;
	public $AlbumId;
	public $MediaTypeId;
	public $GenreId;
	public $Composer;
	public $Milliseconds;
	public $Bytes;
	public $UnitPrice;
 
    public function __construct(){
    }

    public function encontrarTodas(){
        $db=Conectar::conexion();
		$sql="select * from Track";
		/*select a.Name, MediaType.Name 
  			 from track a join MediaType b on
   			 a.MediaTypeId=b.MediaTypeId order by a.Name asc ";*/
		$resultado = mysqli_query($db,$sql);

		$rows = array();
		$listaCanciones = array();


		while ($rs = mysqli_fetch_object($resultado,"Cancion")){
			$listaCanciones[]= $rs;
		}
	return $listaCanciones;
    }

    public function seleccionarCancion($idCancion){
		$db=Conectar::conexion();
		$sql="select * from Track where TrackId=".$idCancion;
		$resultado = mysqli_query($db,$sql);

		$rows = array();
		$listaDetalleCancion = array();


		$rs = mysqli_fetch_object($resultado,"Cancion");
		
	return $rs;
	}

	public function getPrecio($idCancion){
		$db=Conectar::conexion();
		$sql="select UnitPrice from Track where TrackId=".$idCancion;
		$sentencia=mysqli_query($db, $sql);
		$resultado = mysqli_fetch_array($sentencia);
		$return=$resultado["UnitPrice"];
		return $return;
	}


}

        
?>