<?php
include_once('../db/conectar.php');

class DetalleFactura{

	public $InvoiceLineId;
	public $InvoiceId;
	public $TrackID;
	public $UnitPrice;
	public $Quantity;
	
	/*Es como hacíamos en java, pero en vez de crear dos constructores uno vacío y otro con los datos que le pasabas, directamente en un único constructor le puede pasabas
	 o no los parámetros vacío o con información, de modo que no rellenas un parámetro saldrá null*/
    /*public function __construct($invoiceId = null,$customerId = null, invoiceDate = null,billingAddress = null,
	$billingAddress = null,$billingCity = null,$billingState = null,$billingCountry = null,$billingPostalCode = null,$total = null){*/
	public function __construct() {
		/*$this->invoiceId=$invoiceId;
		$this->customerId = $customerId;
		$this->invoiceDate = $invoiceDate;
		$this->billingAddress =$billingAddress;
		$this->billingCity =$billingCity;
		$this->billingState= $billingState;
		$this->billingCountry = $billingCountry;
		$this->billingPostalCode = $billingPostalCode;
		$this->total = $total;*/
	}
	
	public function getFactura($invoiceLineId){
		$db=Conectar::conexion();
		
        $consulta=$db->query("select * from InvoiceLine where InvoiceLineId=".$invoiceId);
		$resultado = mysqli_query($db,$consulta);
		$rs = mysqli_fetch_array($resultado);
		$this->InvoiceId = $rs['InvoiceId'];
		$this->TrackID = $rs['TrackID'];
		$this->UnitPrice = $rs['UnitPrice'];
		$this->Quantity = $rs['Quantity'];
		return $this;
    }
    
    public function addDetalleFactura($listaCanciones,$idFactura){
		$db=Conectar::conexion();

		$can=new Cancion();
		foreach ($listaCanciones as $cancion => $cantidad) {
			$idDetalleFactura=$this->ultimIdAdd()+1;
			$precio=$can->getPrecio($cancion);
			$sql="insert into InvoiceLine values($idDetalleFactura,$idFactura,$cancion,$precio,$cantidad)";

			$cantidad = mysqli_query($db,$sql);
		}
			echo "Se han generado los detalles de tu factura";
	}



	public function ultimIdAdd(){
		$db=Conectar::conexion();
		
		$sql="select max(InvoiceLineId) as newId from InvoiceLine";
		$cantidad = mysqli_query($db,$sql);
		$resultado = mysqli_fetch_array($cantidad);
		$return = $resultado['newId'];
		return $return;
		
	}

    public function listaDetalleFactura($invoiceId){
		$db=Conectar::conexion();
		$sql="select * from InvoiceLine where InvoiceId=".$invoiceId;
		$resultado = mysqli_query($db,$sql);

		$rows = array();
		$listaFacturas = array();


		while ($rs = mysqli_fetch_object($resultado,"DetalleFactura")){
			$listaFacturas[]= $rs;
		}
	return $listaFacturas;
	}
}

   