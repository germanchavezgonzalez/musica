<?php
echo "Iniciando contrlador"."<br>";
//Llamada al modelo -- Intermediario entre vista y modelo !!!ç
session_start();
require_once("../modelos/detalleFacturaModelo.php");

require_once("../modelos/facturaModelo.php");


$idFactura=$_GET['invoiceId'];
$detalleFactura=new DetalleFactura();
$datos=$detalleFactura->listaDetalleFactura($idFactura);


$factura=new Factura();
$datosFactura=$factura->getFactura($idFactura);


//Llamada a la vista -- Intermediario entre vista y modelo !!!
require_once("../vistas/detalleFacturaVista.phtml");
?>
