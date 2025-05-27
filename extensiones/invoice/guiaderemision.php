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

	$pdf->SetLineWidth(0.);

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

	$pdf->Rect(17, 75, 25, 10, 'F');
	$pdf->Rect(117, 75, 40, 10, 'F');
	$pdf->Rect(7, 88, 95, 5, 'F');
	$pdf->Rect(112, 88, 95, 5, 'F');
	$pdf->Rect(7, 107, 95, 6, 'F');
	$pdf->Rect(112, 107, 95, 6, 'F');

	$pdf->SetFillColor(210, 210, 210);
	$pdf->Rect(7, 215.5, 70, 5, 'F');
	$pdf->Rect(82, 215.5, 73, 5, 'F');
	$pdf->Rect(7, 245.5, 70, 5, 'F');


	
	
	$pdf->SetDrawColor(0, 0, 0);
	
	$pdf->Cell(70,10,iconv("UTF-8", "ISO-8859-1","GUIA DE REMISIÓN"),'LR',0,'C');
	$pdf->Ln(7);
	$pdf->Cell(130,0,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
	$pdf->Cell(70,10,iconv("UTF-8", "ISO-8859-1","ELECTRONICA DEL REMITENTE"),'LR',0,'C');
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

	$vendedor = $respuestaVendedor["usuario"];

	$fecha = $respuestaVenta["fecha"];
	$metodo_pago = $respuestaVenta["metodo_pago"];

	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','B',9);
	
	$pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(25,5,iconv("UTF-8", "ISO-8859-1","FECHA DE"),'TLR',0,'L');
	$pdf->Cell(25,5,iconv("UTF-8", "ISO-8859-1",""),'TLR',0,'L');
	$pdf->Cell(50,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(40,5,iconv("UTF-8", "ISO-8859-1","FECHA DE EMISION DE"),'TLR',0,'L');
	$pdf->Cell(40,5,iconv("UTF-8", "ISO-8859-1",""),'TLR',0,'L');
	$pdf->Ln(5);

	$pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(25,5,iconv("UTF-8", "ISO-8859-1","EMISION"),'BLR',0,'L');
	

	//VARIABLE DE FECHA
	$pdf->Cell(25,5,iconv("UTF-8", "ISO-8859-1",""),'BLR',0,'L');

	$pdf->Cell(50,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(40,5,iconv("UTF-8", "ISO-8859-1","TRASLADO"),'LRB',0,'L');
	$pdf->Cell(40,5,iconv("UTF-8", "ISO-8859-1",""),'BLR',0,'L');
	
	$pdf->Ln(7);
	$pdf->Cell(35,0,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(20,-14,iconv("UTF-8", "ISO-8859-1","08-02-2024"),'',0,'L');
	$pdf->Cell(95,-14,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(20,-14,iconv("UTF-8", "ISO-8859-1","08-02-2024"),'',0,'L');
	
	$pdf->Ln(1);

	//datos del la guia

	$pdf->SetFont('Arial','B',9);
	
	$pdf->Cell(95,5,iconv("UTF-8", "ISO-8859-1","A.P Y NOMBRES / RAZÓN SOCIAL DESTINARIO"),'TBLR',0,'C');
	$pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(95,5,iconv("UTF-8", "ISO-8859-1","PUNTO DE LLEGADA"),'TLRB',0,'C');
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(95,7,iconv("UTF-8", "ISO-8859-1"," YOPLA CORTEZ, RAFAEL"),'LR',0,'L');
	$pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(95,7,iconv("UTF-8", "ISO-8859-1","060101 - CAJAMARCA"),'TLR',0,'L');
	$pdf->Ln(7);
	$pdf->Cell(95,5,iconv("UTF-8", "ISO-8859-1"," RUC/DNI: 26659596"),'BLR',0,'L');
	$pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(95,5,iconv("UTF-8", "ISO-8859-1","C.P. puylucana km1 - LOS BAÑOS DEL INCA - CAJAMARCA"),'LRB',0,'L');
	
	$pdf->Ln(7);

	//VARIABLE DEL PUNTO DE PARTIDA
	$pdf->SetFont('Arial','B',9);
	
	$pdf->Cell(95,6,iconv("UTF-8", "ISO-8859-1","PUNTO DE PARTIDA"),'TBLR',0,'C');
	$pdf->Cell(10,6,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(95,6,iconv("UTF-8", "ISO-8859-1","UNIDAD DE TRANSPORTE CONDUCTOR"),'TLR',0,'C');
	$pdf->Ln(6);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(95,7,iconv("UTF-8", "ISO-8859-1","120114 - JR. Manuel Alonso Aguirre N°573 Urb. Lamblaspata"),'LR',0,'L');
	$pdf->Cell(10,7,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(95,7,iconv("UTF-8", "ISO-8859-1"," N°DOC: 1: .-"),'TLR',0,'L');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(95,7,iconv("UTF-8", "ISO-8859-1","DST: El Tambo PROV: Huancayo DEP:JUNÍN"),'BLR',0,'L');
	$pdf->Cell(10,7,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(95,7,iconv("UTF-8", "ISO-8859-1"," N° LICENCIA"),'LRB',0,'L');
	
	
	$pdf->Ln(-3.5);

	$pdf->Cell(95,7,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(95,7,iconv("UTF-8", "ISO-8859-1"," NÚMERO DE PLACA SEMIRREMOLQUE: "),'',0,'L');
	
	
	$pdf->Ln(12);

	
	
	$pdf->Ln(1);
	# Tabla de productos #
	$pdf->SetFont('Arial','B',8);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0,0,0);
	
	$pdf->Cell(30,6,iconv("UTF-8", "ISO-8859-1","CÓDIGO."),1,0,'C',true);
	$pdf->Cell(15,6,iconv("UTF-8", "ISO-8859-1","CANT."),1,0,'C',true);
	$pdf->Cell(95,6,iconv("UTF-8", "ISO-8859-1","DESCRIPCIÓN"),1,0,'C',true);
	$pdf->Cell(30,6,iconv("UTF-8", "ISO-8859-1","PESO APROX."),1,0,'C',true);
	$pdf->Cell(30,6,iconv("UTF-8", "ISO-8859-1","PESO TOTAL"),1,0,'C',true);

	$pdf->Ln(6);

	for($i=0; $i<19; $i++){
	
		$pdf->SetFont('Arial', '', 6);
		
		$pdf->Cell(30,4,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
		$pdf->Cell(15,4,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
		$pdf->Cell(95,4,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
		$pdf->Cell(30,4,iconv("UTF-8", "ISO-8859-1",""),'LB',0,'C');
		$pdf->Cell(30,4,iconv("UTF-8", "ISO-8859-1",""),'LRB',0,'C');
		$pdf->Ln(4);

	}
	
	$pdf->SetTextColor(39,39,51);

	$textoBonito = "TRACTOR SHANGHAI NEW HOLLAND MODELO 704, COLOR AZUL, DOBLE TRACCION, SIN CABINA.";


	// Antes del bucle foreach de productos

	/*----------  Detalles de la tabla  ----------*/

	foreach ($productos as $key => $item) {


		$itemProducto = "nombre_producto";
		$valorProducto = $item["nombre_producto"];
		$orden = null;

		$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

		$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

		$precioTotal = number_format($item["total"], 2);

		$pdf->SetFont('Arial', '', 8);
		
		$pdf->Cell(30,-147,iconv("UTF-8", "ISO-8859-1",$respuestaProducto["codigo_producto"]),'',0,'C');
		$pdf->Cell(15,-147,iconv("UTF-8", "ISO-8859-1",$item["cantidad"]),'',0,'C');
		$pdf->Cell(95,-147,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
		$pdf->Cell(30,-147,iconv("UTF-8", "ISO-8859-1","1"),'',0,'C');
		$pdf->Cell(30,-147,iconv("UTF-8", "ISO-8859-1",$item["cantidad"]),'',0,'C');

		$pdf->Ln(4);
		
	}

	
	/*----------  Fin Detalles de la tabla  ----------*/

	$pdf->SetDrawColor(210, 210, 210); 

	//1
	$pdf->Rect(112, 221, 3, 3);
	$pdf->Rect(111.9, 220.9, 3, 3);
	$pdf->Rect(111.8, 220.8, 3, 3);
	//7
	$pdf->Rect(150, 222.5, 3, 3);
	$pdf->Rect(149.9, 222.4, 3, 3);
	$pdf->Rect(149.8, 222.3, 3, 3);
	//2
	$pdf->Rect(112, 226, 3, 3);
	$pdf->Rect(111.9, 225.9, 3, 3);
	$pdf->Rect(111.8, 225.8, 3, 3);
	//8
	$pdf->Rect(150, 228, 3, 3);
	$pdf->Rect(149.9, 227.9, 3, 3);
	$pdf->Rect(149.8, 227.8, 3, 3);
	//3
	$pdf->Rect(112, 231, 3, 3);
	$pdf->Rect(111.9, 230.9, 3, 3);
	$pdf->Rect(111.8, 230.8, 3, 3);
	//9
	$pdf->Rect(150, 235.3, 3, 3);
	$pdf->Rect(149.9, 235.2, 3, 3);
	$pdf->Rect(149.8, 235.1, 3, 3);
	//4
	$pdf->Rect(112, 235.3, 3, 3);
	$pdf->Rect(111.9, 235.2, 3, 3);
	$pdf->Rect(111.8, 235.1, 3, 3);
	//10
	$pdf->Rect(150, 240.5, 3, 3);
	$pdf->Rect(149.9, 240.4, 3, 3);
	$pdf->Rect(149.8, 240.3, 3, 3);
	//5
	$pdf->Rect(112, 239.2, 3, 3);
	$pdf->Rect(111.9, 239.1, 3, 3);
	$pdf->Rect(111.8, 239.0, 3, 3);
	//11
	$pdf->Rect(150, 245, 3, 3);
	$pdf->Rect(149.9, 244.9, 3, 3);
	$pdf->Rect(149.8, 244.8, 3, 3);
	//6
	$pdf->Rect(112, 246, 3, 3);
	$pdf->Rect(111.9, 245.9, 3, 3);
	$pdf->Rect(111.8, 245.8, 3, 3);

	# Impuestos & totales #
	$pdf->SetFont('Arial','',10);
	$pdf->Ln(-0);
	$pdf->Cell(70,5,iconv("UTF-8", "ISO-8859-1","TRANSPORTISTA"),'TLRB',0,'C');
	$pdf->Cell(5,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'C');
	$pdf->Cell(73,5,iconv("UTF-8", "ISO-8859-1","MOTIVO DEL TRASLADO"),'TLRB',0,'C');
	$pdf->Ln(5);

	$pdf->Cell(70,23,iconv("UTF-8", "ISO-8859-1",""),'LRB',0,'L');
	$pdf->Cell(5,23,iconv("UTF-8", "ISO-8859-1",""),'',0,'R');
	$pdf->Cell(35,40,iconv("UTF-8", "ISO-8859-1",""),'LRB',0,'L');
	$pdf->Cell(38,40,iconv("UTF-8", "ISO-8859-1",""),'LRB',0,'L');

	$pdf->Ln(1);

	
	$pdf->Cell(70,5,iconv("UTF-8", "ISO-8859-1","NOMBRE:"),'',0,'L');
	$pdf->Cell(5,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'R');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(29.5,2,iconv("UTF-8", "ISO-8859-1","1.-VENTA"),'',0,'L');
	$pdf->Cell(5.5,2,iconv("UTF-8", "ISO-8859-1","X"),'',0,'L');
	$pdf->Cell(37,5,iconv("UTF-8", "ISO-8859-1","7.-RECOJO DE BIENES"),'',0,'L');

	$pdf->Ln(5);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(70,5,iconv("UTF-8", "ISO-8859-1","POMA RAMOS WALTER"),'',0,'L');
	$pdf->Cell(5,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'R');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,-1,iconv("UTF-8", "ISO-8859-1","2.-VENTA SUJETA A"),'',0,'L');
	$pdf->Cell(38,5,iconv("UTF-8", "ISO-8859-1","8.-TRASLADOS"),'',0,'L');

	$pdf->Ln(5);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(70,5,iconv("UTF-8", "ISO-8859-1","DNI:"),'',0,'L');
	$pdf->Cell(5,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'R');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,-5,iconv("UTF-8", "ISO-8859-1","CONFIRMAR"),'',0,'L');
	$pdf->Cell(38,1,iconv("UTF-8", "ISO-8859-1","ZONA PRIMARIA"),'',0,'L');

	$pdf->Ln(5);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(70,5,iconv("UTF-8", "ISO-8859-1","46183505:"),'',0,'L');
	$pdf->Cell(5,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'R');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,-7,iconv("UTF-8", "ISO-8859-1","3.-COMPRA"),'',0,'L');
	$pdf->Cell(38,1,iconv("UTF-8", "ISO-8859-1","9.-IMPORTACION"),'',0,'L');

	$pdf->Ln(5);
	$pdf->Cell(70,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'L');
	$pdf->Cell(5,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'R');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,-9,iconv("UTF-8", "ISO-8859-1","4.-CONSIGNACION"),'',0,'L');
	$pdf->Cell(38,1,iconv("UTF-8", "ISO-8859-1","10.-EXPORTACION"),'',0,'L');

	$pdf->Ln(0);
	$pdf->Cell(75,2,iconv("UTF-8", "ISO-8859-1",""),'',0,'R');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,-1,iconv("UTF-8", "ISO-8859-1","5.-DEVOLUCION"),'',0,'L');
	$pdf->Cell(38,10,iconv("UTF-8", "ISO-8859-1","11.-OTROS"),'',0,'L');

	$pdf->Ln(0);
	$pdf->Cell(75,2,iconv("UTF-8", "ISO-8859-1",""),'',0,'R');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,6,iconv("UTF-8", "ISO-8859-1","6.-ENTRE"),'',0,'L');

	$pdf->Ln(0);
	$pdf->Cell(75,2,iconv("UTF-8", "ISO-8859-1",""),'',0,'R');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,12,iconv("UTF-8", "ISO-8859-1","ESTABLECIMIENTO"),'',0,'L');

	$pdf->Ln(0);
	$pdf->Cell(75,2,iconv("UTF-8", "ISO-8859-1",""),'',0,'R');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,17,iconv("UTF-8", "ISO-8859-1","DE LA MISMA"),'',0,'L');

	$pdf->Ln(0);
	$pdf->Cell(75,2,iconv("UTF-8", "ISO-8859-1",""),'',0,'R');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,23,iconv("UTF-8", "ISO-8859-1","EMPRESA"),'',0,'L');
	$pdf->Ln(9);

	$pdf->SetFont('Arial','',10);
	$pdf->Ln(-5);
	$pdf->Cell(70,5,iconv("UTF-8", "ISO-8859-1","COMPROBANTE DE PAGO"),'TLRB',0,'C');
	$pdf->Cell(5,5,iconv("UTF-8", "ISO-8859-1",""),'',0,'C');
	$pdf->Ln(5);
	$pdf->SetFont('Arial','B',20);
	$pdf->Cell(70,10,iconv("UTF-8", "ISO-8859-1","B001-1007"),'BLR',0,'C');

	$pdf->SetDrawColor(0, 0, 0); 

	$pdf->Ln(13);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(200,4,iconv("UTF-8", "ISO-8859-1","ELABORADO POR TRACTOLEO IMPORT. PROVEEDOR DE REPUESTOS DE TRACTORES"),'LRTB',0,'C');

	$pdf->Ln(8);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(200,4,iconv("UTF-8", "ISO-8859-1","Para consultar el comprobante ingresar a https://produccion.tractoleoimports.com/buscar"),'',0,'C');

	$pdf->Ln(-100);

	$pdf->Cell(30,4,iconv("UTF-8", "ISO-8859-1",""),'',0,'C');
	$pdf->Cell(15,4,iconv("UTF-8", "ISO-8859-1",""),'',0,'C');

	$pdf->MultiCell(95,4,iconv("UTF-8", "ISO-8859-1","TRACTOR SHANGHAI NEW HOLLAND MODELO 704, COLOR AZUL, DOBLE TRACCION, SIN CABINA."),0,'L',false,1);
	
	$pdf->Image('img/QRtractoleo.png',173,225,25,25	,'PNG');

	# Nombre del archivo PDF #
	$pdf->Output("I","Factura_Nro_1.pdf",true);


