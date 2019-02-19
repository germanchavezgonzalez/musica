<?php
include_once('../db/conectar.php');
include_once('../modelos/usuarioModelo.php');
include_once('../modelos/detalleFacturaModelo.php');

class Factura{

	public $InvoiceId;
	public $CustomerId;
	public $InvoiceDate;
	public $BillingAddress;
	public $BillingCity;
	public $BillingState;
	public $BillingCountry;
	public $BillingPostalCode;
	public $Total;
	
	/*Es como hacíamos en java, pero en vez de crear dos constructores uno vacío y otro con los datos que le pasabas, directamente en un único constructor le puede pasabas
	 o no los parámetros vacío o con información, de modo que no rellenas un parámetro saldrá null*/
    /*public function __construct($invoiceId = null,$customerId = null, invoiceDate = null,billingAddress = null,
	$billingAddress = null,$billingCity = null,$billingState = null,$billingCountry = null,$billingPostalCode = null,$total = null){*/
	public function __construct() {
	}
	
	
	/*si fuera con el set
	public function_set_factura($factura){
		$db=Conectar::conexion();
		
        $consulta=$this->db->query("update set customerId='$factura->customerId' from invoice where invoiceId=".$invoiceId);
		$resultado = mysqli_query($db,$consulta);
		$rs = mysqli_fetch_array($resultado);
		
	}
	*/
	public function pagar($customerId,  $listaCanciones){
		$db=Conectar::conexion();
		$total=$this->totalPrecio($listaCanciones);

		$nuevoId=$this->ultimIdAdd()+1;
		$usuario=new Usuario();		
		$usuario->getUsuario($customerId);
	
		$sql="insert into Invoice values($nuevoId,$customerId, now(),'$usuario->Address',
			'$usuario->City','$usuario->State','$usuario->Country','$usuario->PostalCode','$total')";

		$sentencia = mysqli_query($db,$sql);
		echo "La operación ha sido realizada, se envíará a tu dirección predeterminada con el identificador:".$nuevoId;
		$df = new DetalleFactura();
		$df->addDetalleFactura($listaCanciones,$nuevoId);
	}






	public function totalPrecio($listaCanciones){
		$db=Conectar::conexion();
		$total=0;
		foreach($listaCanciones as $cancion => $cantidad){
				$sql="select max(UnitPrice * ".$cantidad.") as suma from Track where TrackId=".$cancion;
				$cantidad = mysqli_query($db,$sql);
				$resultado = mysqli_fetch_array($cantidad);
				$return = $resultado['suma'];
				$total = $total + $return;
		}

		return $total;
	}
	




	public function ultimIdAdd(){
		$db=Conectar::conexion();
		
		$sql="select max(InvoiceId) as newId from Invoice";
		$cantidad = mysqli_query($db,$sql);
		$resultado = mysqli_fetch_array($cantidad);
		$result = $resultado['newId'];
		return $result;
		
	}





	
	public function listaFactura($customerId,$fechaDesde,$fechaHasta){
		$db=Conectar::conexion();
		$params="";
		if(!is_null($fechaDesde) && !is_null($fechaHasta)){
			$params ="and InvoiceDate between '".$fechaDesde."' and '".$fechaHasta."'";
		}
			$sql="select * from Invoice where CustomerId=".$customerId." ".$params;


		$resultado = mysqli_query($db,$sql);

		$rows = array();
		$listaFacturas = array();


		while ($rs = mysqli_fetch_object($resultado,"Factura")){
			$listaFacturas[]= $rs;
		}
	return $listaFacturas;
	}






	public function getFactura($invoiceId){
		$db=Conectar::conexion();
		$sql="select * from Invoice where InvoiceId=".$invoiceId;
		$resultado = mysqli_query($db,$sql);

		$rows = array();
		$listaFacturas = array();


		$rs = mysqli_fetch_object($resultado,"Factura");
		
	return $rs;
	}

	


}
	

?>