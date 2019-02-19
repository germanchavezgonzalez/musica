<?php
echo "Iniciando contrlador"."<br>";
//Llamada al modelo -- Intermediario entre vista y modelo !!!ç
session_start();
require_once("../modelos/facturaModelo.php");
$fechaDesde=null;
$fechaHasta=null;
if(isset($_POST['fechaDesde'])) $fechaDesde =$_POST['fechaDesde'];
if(isset($_POST['fechaHasta'])) $fechaHasta =$_POST['fechaHasta'];

$idCustomer=$_SESSION['idUsuario'];
$factura=new Factura();
$datos=$factura->listaFactura($idCustomer,$fechaDesde,$fechaHasta);

//Llamada a la vista -- Intermediario entre vista y modelo !!!
require_once("../vistas/histfacturasVista.php");
?>