<?php

	# Incluyendo librerias necesarias #
	require_once "../../controladores/ventas.controlador.php";
	require_once "../../modelos/ventas.modelo.php";

	require_once "../../controladores/clientes.controlador.php";
	require_once "../../modelos/clientes.modelo.php";

	require_once "../../controladores/usuarios.controlador.php";
	require_once "../../modelos/usuarios.modelo.php";

	require_once "../../controladores/productos.controlador.php";
	require_once "../../modelos/productos.modelo.php";

	
	require "./code128.php";

	$pdf = new PDF_Code128('P','mm','A4');
	$pdf->SetMargins(7,5,5,4);
	$pdf->AddPage();
	date_default_timezone_set('America/Lima');


	# Logo de la empresa formato png #

	$pdf->Image('img/logo.png', 10,120, 190, 100, 'PNG', '', '', true, 20, '', false, false,0);

	$pdf->Image('img/tractores.png',5,7,72,27,'PNG');

	$pdf->Image('img/logo_tractoleo.png',80,7,52,27,'PNG');


	//TRAEMOS LA INFORMACIÓN DE LA VENTA

	$itemVenta = "id";
	$valorVenta = isset($_GET['idVenta']) ? $_GET['idVenta'] : '';

	$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

	$fecha = substr($respuestaVenta["fecha"],0,-8);
	$productos = json_decode($respuestaVenta["productos"], true);
	$neto = number_format($respuestaVenta["neto"],2);
	$impuesto = number_format($respuestaVenta["impuesto"],2);
	$total = number_format($respuestaVenta["total"],2);

	//TRAEMOS LA INFORMACIÓN DEL CLIENTE

	$itemCliente = "id";
	$valorCliente = $respuestaVenta["id_cliente"];

	$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

	//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

	$itemVendedor = "id";
	$valorVendedor = $respuestaVenta["id_vendedor"];

	$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

	# Encabezado y datos de la empresa #

	$item = null;
	$valor = null;  
                
                
	$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

	$pdf->SetFont('arial','B',12);
	$pdf->SetTextColor(39,39,51);
	$pdf->Ln(6);
	$pdf->Cell(130,0,iconv("UTF-8", "ISO-8859-1",""),0,0,'R');
	$pdf->Cell(70,10,iconv("UTF-8", "ISO-8859-1","RUC 20608220233"),'LRT',0,'C');
	$pdf->Ln(7);
	$pdf->Cell(130,0,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
	// Establecer el color de fondo claro
	$pdf->SetFillColor(235, 235, 235); // Gris claro
	// Dibujar un rectángulo para servir como fondo claro
	//SERIE
	$pdf->Rect(137, 20, 70, 12.7, 'F');

	
	$pdf->Cell(70,10,iconv("UTF-8", "ISO-8859-1","BOLETA DE VENTA"),'LR',0,'C');
	$pdf->Ln(7);
	$pdf->Cell(130,0,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
	$pdf->Cell(70,10,iconv("UTF-8", "ISO-8859-1","ELECTRONICA"),'LR',0,'C');
	$pdf->Ln(7);
	$pdf->Cell(130,0,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
	$pdf->Cell(70,10,iconv("UTF-8", "ISO-8859-1",$valorVenta),'LRB',0,'C');
	$pdf->Ln(-16);
	

	$pdf->SetFont('Arial','',9);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(150,45,iconv("UTF-8", "ISO-8859-1","JR. Manuel Alonso Aguirre N°573 Urb. Lamblaspata El Tambo , Huancayo - JUNÍN"),0,0,'L');

	$pdf->Ln(4);

	$pdf->Cell(150,45,iconv("UTF-8", "ISO-8859-1","964 003 600 / 910 861 959 | Email: tractoleoimport@gmail.com"),0,0,'L');

	$pdf->Ln(55);

	$pdf->Image('img/logo_marcas.png',10,45,190,27,'PNG');


	# Tabla datos de factura #

	$nombre_cliente = $respuestaCliente["nombre_cliente"];
	$DNI = $respuestaCliente["DNI"];
	$procedencia_cliente = $respuestaCliente["procedencia_cliente"];
	$procedencia_cliente_departamento = $respuestaCliente["departamento"];

	$vendedor = $respuestaVendedor["usuario"];

	$fecha = $respuestaVenta["fecha"];
	$metodo_pago = $respuestaVenta["metodo_pago"];


	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(100,5,iconv("UTF-8", "ISO-8859-1","Cliente                       : ".$nombre_cliente),'TL',0,'L');
	$pdf->Cell(100,5,iconv("UTF-8", "ISO-8859-1","Vendedor                      : ".$vendedor),'TR',0,'M');
	$pdf->Ln(5);
	$pdf->Cell(200,5,iconv("UTF-8", "ISO-8859-1","DNI                             : ".$DNI),'LR',0,'M');
	$pdf->Ln(5);
	$pdf->Cell(100,5,iconv("UTF-8", "ISO-8859-1","Direccion                   : ".$procedencia_cliente),'L',0,'L');
	$pdf->Cell(100,5,iconv("UTF-8", "ISO-8859-1","Fecha de Emisión         : ".$fecha),'R',0,'M');
	$pdf->Ln(5);
	$pdf->Cell(200,5,iconv("UTF-8", "ISO-8859-1","Provincia                   : 	".$procedencia_cliente_departamento),'LR',0,'M');
	$pdf->Ln(5);
	$pdf->Cell(100,5,iconv("UTF-8", "ISO-8859-1","Condicion de venta  : ".$metodo_pago),'LB',0,'L');
	$pdf->Cell(100,5,iconv("UTF-8", "ISO-8859-1","Fecha de Vencimiento  : "),'RB',0,'M');
	$pdf->Ln(7);

	# Tabla de productos #
	$pdf->SetFont('Arial','B',8);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(15,6,iconv("UTF-8", "ISO-8859-1","CANT."),1,0,'C',true);
	$pdf->Cell(30,6,iconv("UTF-8", "ISO-8859-1","CÓDIGO."),1,0,'C',true);
	$pdf->Cell(90,6,iconv("UTF-8", "ISO-8859-1","DESCRIPCIÓN"),1,0,'C',true);
	$pdf->Cell(25,6,iconv("UTF-8", "ISO-8859-1","CASILLA"),1,0,'C',true);
	$pdf->Cell(20,6,iconv("UTF-8", "ISO-8859-1","PRECIO U."),1,0,'C',true);
	$pdf->Cell(20,6,iconv("UTF-8", "ISO-8859-1","TOTAL"),1,0,'C',true);

	$pdf->Ln(6);

	$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(15,84,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
		$pdf->Cell(30,84,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
		$pdf->Cell(90,84,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
		$pdf->Cell(25,84,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
		$pdf->Cell(20,84,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
		$pdf->Cell(20,84,iconv("UTF-8", "ISO-8859-1",""),'LRB',0,'C');
		$pdf->Ln(1);

	$pdf->SetTextColor(39,39,51);

	/*----------  Detalles de la tabla  ----------*/

	$espacio = 0;

	foreach ($productos as $key => $item) {

		$itemProducto = "nombre_producto";
		$valorProducto = $item["nombre_producto"];
		$orden = null;

		$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

		$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

		$precioTotal = number_format($item["total"], 2);

		$pdf->SetFont('Arial', '', 7.5);
		$pdf->Cell(15, 4, iconv("UTF-8", "ISO-8859-1", $item["cantidad"]), '', 0, 'C');
		$pdf->Cell(30, 4, iconv("UTF-8", "ISO-8859-1", $respuestaProducto["codigo_producto"]), '', 0, 'C');
		$pdf->Cell(87, 4, '', '', 0, 'L');
		$pdf->Cell(25, 4, iconv("UTF-8", "ISO-8859-1", $respuestaProducto["ubicacion"]), '', 0, 'R');
		$pdf->Cell(20, 4, iconv("UTF-8", "ISO-8859-1", "S/.".$valorUnitario), '', 0, 'R');
		$pdf->Cell(20, 4, iconv("UTF-8", "ISO-8859-1", "S/.".$precioTotal), '', 0, 'R');
		$ancho = $pdf->GetStringWidth($item["nombre_producto"]);
		$pdf->Cell(-150, 4, '', '', 0, 'R');
		$pdf->MultiCell(87, 4, iconv("UTF-8", "ISO-8859-1", $item["nombre_producto"]), '', 0, 'L');
		$pdf->Ln(0);

		
		
		if($ancho > 80){
			$espacio += 8;
		} else{
			$espacio +=4;
		}

		

	}
	

	/*----------  Fin Detalles de la tabla  ----------*/

	$espacioFinal = 84 - $espacio;


	$pdf->Ln($espacioFinal);

	$fmt = new NumberFormatter('es', NumberFormatter::SPELLOUT);

	$texto = strtoupper($fmt->format($respuestaVenta["total"]));
		

	$pdf->SetFont('Arial','B',9);
		
	# Impuestos & totales #
	$pdf->Ln(1);
	$pdf->Cell(200,4,iconv("UTF-8", "ISO-8859-1","SON: ".$texto)." CON 00/100 SOLES",'TLRB',0,'L');
	$pdf->Ln(4);

	$pdf->SetFont('Arial','',7.5);
	$pdf->Cell(100,4,iconv("UTF-8", "ISO-8859-1","OBSERVACION:"),'LR',0,'L');
	$pdf->Cell(40,4,iconv("UTF-8", "ISO-8859-1","OP. GRABADAS"),'RB',0,'R');
	$pdf->Cell(60,4,iconv("UTF-8", "ISO-8859-1","S/. ".$neto),'RB',0,'R');

	$pdf->Ln(4);

	$pdf->SetFont('Arial','',7.5);
	$pdf->Cell(100,4,iconv("UTF-8", "ISO-8859-1",''),'LR',0,'L');
	$pdf->Cell(40,4,iconv("UTF-8", "ISO-8859-1","IGB (18%)"),'RB',0,'R');
	$pdf->Cell(60,4,iconv("UTF-8", "ISO-8859-1","S/. ".$impuesto),'RB',0,'R');
	$pdf->Ln(4);

	$pdf->SetFont('Arial','',7.5);
	$pdf->Cell(100,4,iconv("UTF-8", "ISO-8859-1",''),'LR',0,'L');
	$pdf->Cell(40,4,iconv("UTF-8", "ISO-8859-1","ICBPER"),'RB',0,'R');
	$pdf->Cell(60,4,iconv("UTF-8", "ISO-8859-1","S/. 0.00"),'RB',0,'R');
	$pdf->Ln(4);

	$pdf->SetFont('Arial','',7.5);
	$pdf->Cell(100,4,iconv("UTF-8", "ISO-8859-1",''),'LR',0,'L');
	$pdf->Cell(40,4,iconv("UTF-8", "ISO-8859-1","ANTICIPO"),'RB',0,'R');
	$pdf->Cell(60,4,iconv("UTF-8", "ISO-8859-1","S/. 0.00"),'RB',0,'R');
	$pdf->Ln(4);

	$pdf->SetFont('Arial','',7.5);
	$pdf->Cell(100,4,iconv("UTF-8", "ISO-8859-1",''),'LR',0,'L');
	$pdf->Cell(40,4,iconv("UTF-8", "ISO-8859-1","OP. EXONERADAS"),'RB',0,'R');
	$pdf->Cell(60,4,iconv("UTF-8", "ISO-8859-1","S/. 0.00"),'RB',0,'R');
	$pdf->Ln(4);

	$pdf->SetFont('Arial','',7.5);
	$pdf->Cell(100,4,iconv("UTF-8", "ISO-8859-1",''),'LR',0,'L');
	$pdf->Cell(40,4,iconv("UTF-8", "ISO-8859-1","Total, a pagar"),'RB',0,'R');
	$pdf->Cell(60,4,iconv("UTF-8", "ISO-8859-1","S/. ".$total),'RB',0,'R');
	$pdf->Ln(4);

	$pdf->SetFont('Arial','',7.5);
	$pdf->Cell(100,4,iconv("UTF-8", "ISO-8859-1",''),'LR',0,'L');
	$pdf->Cell(40,4,iconv("UTF-8", "ISO-8859-1","TOTAL, RECIBO"),'RB',0,'R');
	$pdf->Cell(60,4,iconv("UTF-8", "ISO-8859-1","S/. 0.00"),'RB',0,'R');
	$pdf->Ln(4);

	$pdf->SetFont('Arial','',7.5);
	$pdf->Cell(100,4,iconv("UTF-8", "ISO-8859-1",''),'LRB',0,'L');
	$pdf->Cell(40,4,iconv("UTF-8", "ISO-8859-1","VUELTO"),'RB',0,'R');
	$pdf->Cell(60,4,iconv("UTF-8", "ISO-8859-1","S/. 0.00"),'RB',0,'R');
	$pdf->Ln(5);


	$pdf->SetFont('Arial','',7);

	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(30,4,iconv("UTF-8", "ISO-8859-1","MONEDA"),'TL',0,'C');
	$pdf->Cell(30,4,iconv("UTF-8", "ISO-8859-1","CTA. CTE"),'TLR',0,'C');
	$pdf->Cell(30,4,iconv("UTF-8", "ISO-8859-1","CCI"),'TR',0,'C');
	$pdf->Cell(110,4,iconv("UTF-8", "ISO-8859-1",""),'TR',0,'C');
	$pdf->Ln(4);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(90,4,iconv("UTF-8", "ISO-8859-1","BANCO DE CREDITO DEL PERU"),'LRBT',0,'C');
	$pdf->Cell(110,4,iconv("UTF-8", "ISO-8859-1","Después de haber facturado no hay opción de reclamo por ningún motivo."),'R',0,'L');
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(90,4,iconv("UTF-8", "ISO-8859-1","SOLES"),'LRT',0,'L');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(110,4,iconv("UTF-8", "ISO-8859-1","Representación impresa de la factura de venta electrónica, esta puede ser consultada"),'R',0,'L');
	$pdf->Ln(4);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(90,4,iconv("UTF-8", "ISO-8859-1","N°: 355-9885611-0-12"),'LR',0,'L');
	$pdf->Cell(110,4,iconv("UTF-8", "ISO-8859-1","en https://demo.tractoleoimports.com/"),'R',0,'L');
	
	$pdf->Ln(4);
	$pdf->Cell(90,4,iconv("UTF-8", "ISO-8859-1","CCI: 00235500988561101261"),'RL',0,'L');
	$pdf->Cell(110,4,iconv("UTF-8", "ISO-8859-1","retentivos Autorizado mediante resolución de intendencia SUNAT."),'R',0,'L');
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(90,4,iconv("UTF-8", "ISO-8859-1","DÓLARES AMERICANOS"),'LR',0,'L');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(110,4,iconv("UTF-8", "ISO-8859-1",""),'R',0,'L');
	$pdf->Ln(4);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(90,4,iconv("UTF-8", "ISO-8859-1","N°: 355-9841149-1-11"),'LR',0,'L');
	$pdf->Cell(110,4,iconv("UTF-8", "ISO-8859-1",""),'R',0,'C');
	$pdf->Ln(4);
	$pdf->Cell(90,4,iconv("UTF-8", "ISO-8859-1","CCI: 00235500984114911165"),'LRB',0,'L');
	$pdf->Cell(110,4,iconv("UTF-8", "ISO-8859-1",""),'RB',0,'C');
	$pdf->Ln(4);
	$pdf->Cell(200,4,iconv("UTF-8", "ISO-8859-1","ELABORADO POR TRACTOLEO IMPORT. PROVEEDOR DE REPUESTOS DE TRACTORES"),'LRB',0,'C');

	$pdf->Ln(8);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(200,4,iconv("UTF-8", "ISO-8859-1","Para consultar el comprobante ingresar a https://produccion.tractoleoimports.com/buscar"),'',0,'C');
	
	$pdf->Image('img/QRtractoleo.png',99,252,10,10,'PNG');

	# Nombre del archivo PDF #
	$pdf->Output("I","Factura_Nro_1.pdf",true);


