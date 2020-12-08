<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $fechaInicio;
public $fechaFinal ;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$fechaInicio = $this->fechaInicio;
$fechaFinal = $this->fechaFin;

//var_dump($fechaInicio, $fechaFinal);

if(isset($fechaInicio)){

	$tabla = "ventas";

	//if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

		$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

	//}
}

//var_dump($ventas);



// $respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

//  $fecha = substr($respuestaVenta["fecha"],0,-8);
//  $productos = json_decode($respuestaVenta["productos"], true);
//  $neto = number_format($respuestaVenta["neto"],2);
// // $impuesto = number_format($respuestaVenta["impuesto"],2);

// $total1 = number_format($respuestaVenta["total"],2);

// //TRAEMOS LA INFORMACIÓN DEL CLIENTE

// $itemCliente = "id";
// $valorCliente = $respuestaVenta["id_cliente"];

// $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

// //TRAEMOS LA INFORMACIÓN DEL VENDEDOR

// $itemVendedor = "id";
// $valorVendedor = $respuestaVenta["id_vendedor"];

// $respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// $pdf->setPrintHeader(false);
// $pdf->setPrintFooter(false);

// $pdf->AddPage('P', 'A7');
//$pdf->SetAutoPageBreak(true,0.1);
//---------------------------------------------------------

$bloque1 = <<<EOF


<table class="table">
	 
	<tr>
		<br><td style="text-align:center; font-size:15px">
			 Reporte de Ventas 
		</td><br>
	</tr>

	<tr>
		<td style="text-align:center; font-size:10px ">
			 Desde: $fechaInicio   Hasta: $fechaFinal <br>
		</td>
	</tr>

	
	<thead>
	    <tr style="font-size:8px; font-weight: bold">
	      <th scope="col">NO. FACTURA</th>
	      <th scope="col">FECHA</th>
	      <th scope="col">CLIENTE</th>
	      <th scope="col">SUB-TOTAL</th>
	      <th scope="col">IMPUESTO</th>
	      <th scope="col">TOTAL</th>
	      
	    </tr> 
  </thead>

  	<tr style=" font-size:10px ">
	      <th>________________________________________________________________________________________________</th>
	      
	</tr>

  
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$ttotal= 0;
$tneto= 0;
$timpuesto =0;
$espacio ="                        ";

foreach ($ventas as $row => $item){

	$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
	$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

	$nombreCliente = $cliente["nombre"];
	$fecha = substr($item["fecha"],0,10);
	$factura = $item["codigo"];
	$impuesto = number_format($item["impuesto"],2);

	$neto = number_format($item["neto"],2);

	$total = number_format($item["total"],2);

	$ttotal = $ttotal + $total;
	$tneto = $tneto + $neto;
	$timpuesto = $timpuesto + $impuesto;


$bloque2 = <<<EOF

<br><br>
<table > 

	<tr>		
 		<td style="font-size:8px"> 

			$factura
		</td>

		<td style="font-size:8px"> 
			 
			 $fecha 			

		</td>

		<td style="font-size:8px">$nombreCliente</td>
		<td style="font-size:8px text-align:right">$neto</td>
		<td style="font-size:8px text-align:right" >$impuesto</td>		
		
		<td style="font-size:8px"> $$total</td>
 	</tr>

 </table>


EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

$cantidad = 0;
$productos =  json_decode($item["productos"], true);

foreach ($productos as $key => $valueProductos) {
			 			
$cantidad= utf8_decode($valueProductos["cantidad"]);
$descripcion= utf8_decode($valueProductos["descripcion"]);
$id= utf8_decode($valueProductos["id"]);

$detalleProducto = ControladorProductos::ctrMostrarProductos("id", $id,"ASC");

$precio = number_format($detalleProducto["precio_venta"],2);

$bloque8 = <<<EOF

<table>
	<tr>		
 		<td style="font-size:8px"> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			$cantidad $descripcion ($precio)
		</td>
	</tr>
	
</table>

EOF;
$pdf->writeHTML($bloque8, false, false, false, false, '');

}

 	// echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		// foreach ($productos as $key => $valueProductos) {
 			
		// 	echo utf8_decode($valueProductos["descripcion"]."<br>");
		
		// }


	
	// echo utf8_decode("<tr>
	// <td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
	// <td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
	// <td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
	// <td style='border:1px solid #eee;'>");
}

$tneto = number_format($tneto,2);
$timpuesto = number_format($timpuesto,2);
$ttotal = number_format($ttotal,2);

// ---------------------------------------------------------
$bloque33 = <<<EOF

<br>_______________________________________________________________________________<br>

<table style="font-size:10px; text-align:left">

	<tr>
		<td><br>$espacio</td>
		
		<td>$espacio </td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$$tneto</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$$timpuesto</td>
		<td>&nbsp;$$ttotal</td>	

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque33, false, false, false, false, '');

/*
// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$id = number_format($item["id"],0);

//** pablo's ****

$item2 = "id";
$valor = $id;
$orden = "id";

$respuesta = ControladorProductos::ctrMostrarProductos($item2, $valor,
$orden);

$itbi = ($respuesta["itbi"]);

if ($itbi ==0){
	$letreroItbi ="0% ITBIS";
}else{
	$letreroItbi ="18% ITBIS";
}

$total = $item["total"];
$valorItbi = number_format((($itbi/100)* $total),2);

//**

$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

//$itbi = number_format($item["itbi"],0);

$bloque2 = <<<EOF

<table style="font-size:9px;">

	
	<tr>
	
		<td style="width:70px; text-align:left">
		$item[cantidad] x $ $valorUnitario 
		
		</td>
	</tr>

	<tr>
		<td style="width:70px; text-align:left">
			 $letreroItbi 
		</td>

	</tr>

	<tr>
	
		<td style="width:70px; text-align:left">
		<strong>$item[descripcion] </strong>
		
		
		</td>

	</tr>

	
	<tr>
	
		<td style="width:108px; text-align:right">
			 $ $valorItbi
		</td>

		<td style="text-align:right">
			
			$ $precioTotal
		</td>

	</tr>



</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------

	$bloque3 = <<<EOF

	<table style="font-size:9px; text-align:right">

		<tr>
		
			<td style="width:160px;">
				=============================
			</td>
		

		</tr>


	<tr>
	
		<td style="width:80px;text-align:left">
			 SUB-TOTAL: 
		</td>

		<td style="width:80px;text-align:right">
			$ $neto
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;text-align:left">
			 IMPUESTO: 
		</td>

		<td style="width:80px;text-align:right">
			$ $impuesto
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			 --------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;text-align:left">
			 TOTAL: 
		</td>

		<td style="width:80px;text-align:right">
			$ $total1
		</td>

	</tr>

	<tr>
	
		<td style="width:160px; text-align:center">
			<br>
			<br>
			Muchas gracias por su compra
		</td>

	</tr>

</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');
*/
// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}


$factura = new imprimirFactura();
$factura -> fechaInicio = $_GET["fechaInicial"];
$factura -> fechaFin = $_GET["fechaFinal"];

$factura -> traerImpresionFactura();

?>