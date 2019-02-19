<?php 
include_once('../db/conectar.php');

class Usuario{
	
	public  $CustomerId;
	public  $FirstName;
	public  $LastName;
	public  $Company;
	public  $Address;
	public  $City;
	public  $State;
	public  $Country;
	public  $PostalCode;
	public  $Phone;
	public  $Fax;
	public  $Email;
	public  $SupportRepId;
	  
	  public function __construct(){
		  
	  }
	  
	public static function usuarioExiste($username, $password){
		$db=Conectar::conexion();
	  $myusername = mysqli_real_escape_string($db,$username);
      $mypassword = mysqli_real_escape_string($db,$password); 
      $sql = "SELECT CustomerId FROM Customer WHERE Email = '$myusername' and LastName = '$mypassword'";
	  echo $sql;
	  $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	  var_dump($row);
	  return $row['CustomerId'];
	}

	public function getUsuario($customerId){
		$db=Conectar::conexion();
		$sql="select * from Customer where CustomerId=".$customerId;
		$resultado = mysqli_query($db,$sql);

		$rows = array();
		$listaFacturas = array();


		$rs = mysqli_fetch_object($resultado,"Usuario");
		$this->CustomerId = $rs->CustomerId;
		$this->FirstName = $rs->FirstName;
		$this->LastName = $rs->LastName;
		$this->Company = $rs->Company;
		$this->Address = $rs->Address;
		$this->City = $rs->City;
		$this->State = $rs->State;
		$this->Country = $rs->Country;
		$this->PostalCode = $rs->PostalCode;
		$this->Phone = $rs->Phone;
		$this->Fax = $rs->Fax;
		$this->Email = $rs->Email;
		$this->SupportRepId = $rs->SupportRepId;

	return $rs;
	}
}
?>
