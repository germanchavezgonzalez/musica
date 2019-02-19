<?php
echo "Iniciando contrlador"."<br>";
//Llamada al modelo 
session_start();
require_once("../modelos/cancionModelo.php");

require_once("../modelos/facturaModelo.php");

$cancionId=null;
if(isset($_POST['idCancion'])) $cancionId =$_POST['idCancion'];

$cancion=new Cancion();
$datos=$cancion->encontrarTodas();

require_once("../modelos/facturaModelo.php");
$option=null;
if(isset($_GET['action'])) $option=$_GET['action'];

switch ($option) {
    case 'pagar':
        pagar();
        break;
    case 'addCancion':
        addCancion();
        break;
    default:
      
        break;
}

function addCancion(){
 
    $cancionCompra=0;
    $cantidad=0;
    if(isset($_POST['cancion'])) $cancionCompra=$_POST['cancion'];
    if(isset($_POST['cantidad']))  $cantidad=$_POST['cantidad'];
    if($cantidad >0 && $cancionCompra >0 ){
        if(isset($_COOKIE['cookie'])){
            $listaCookies = unserialize($_COOKIE['cookie'], ["allowed_classes" => false]);	
        }else {
            $listaCookies=array();
        }   
        $listaCookies[$cancionCompra]=$cantidad;
        setcookie('cookie', serialize($listaCookies), time()+3600);
        var_dump($listaCookies);

    }
}
function pagar(){
    $idCustomer=$_SESSION['idUsuario'];
    $listaCanciones = unserialize($_COOKIE['cookie'], ["allowed_classes" => false]);	
    $factura=new Factura();
    $datos=$factura->pagar($idCustomer,  $listaCanciones);
    $listaCanciones=array();
    setcookie('cookie', serialize($listaCanciones), time()+3600);
}


//Llamada a la vista 
require_once("../vistas/downmusicVista.phtml");



?>
