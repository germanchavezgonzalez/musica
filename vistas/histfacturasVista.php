<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   
      <title>FACTURAS</title>
   </head>
   
   <body>
   <form action="../controladores/facturaControlador.php" method="post">
	<h3>Inserta las fechas desde donde quieres realizar la búsqueda</h3></br>
		desde
			<input type="date" name="fechaDesde" step="1" min="2009-01-01" max="9999-12-31" value="<?php echo date("Y-m-d");?>">
		
		 hasta 
			 <input type="date" name="fechaHasta" step="1" min="2009-01-01" max="9999-12-31" value="<?php echo date("Y-m-d");?>">

			 <button type="submit" class="btn btn-primary" >Enviar</button>
	</form>
			<table class="table">
				<thead>
					<tr>
					<th scope="col">FacturaID</th>
					<th scope="col">Fecha</th>
					<th scope="col">Importe</th>
					<th scope="col">Detalle Pedido</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
						//<td><a href='../controladores/detalleFacturaControlador.php?invoiceId=99>Ver Detalle</input></a></td>
						$button1 ="<td><a href='../controladores/detalleFacturaControlador.php?invoiceId=";
						$button2 ="'>Ver Detalle</input></a></td>";
						// Solo muestra datos no accede a los mismos
						foreach ($datos as $dato) {
							echo "<tr><td>".$dato->InvoiceId."</td><td>".$dato->InvoiceDate."</td><td>".$dato->Total."</td>".$button1.$dato->InvoiceId.$button2."</tr>";
							
						}
					?>
					
				</tbody>
			</table>
	  
	  <a href = "../vistas/menuVista.phtml">volver</a>
      <h2><a href = "../controladores/logoutControlador.php">Cerrar Sesion</a></h2>
   </body>
   
</html>