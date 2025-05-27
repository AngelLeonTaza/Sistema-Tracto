<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/series.controlador.php";
require_once "../modelos/series.modelo.php";

require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";


class TablaProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductos(){


		$item = null;
    	$valor = null;
    	$orden = "id";

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<a href='#'><img src='".$productos[$i]["imagen_producto"]."'width='100px'></a> ";

		  	/*=============================================
 	 		TRAEMOS EL PRECIO DE COMPRA
  			=============================================*/ 
			$PrecioCompraFormateado = number_format($productos[$i]["precio_compra"], 2, ',', '.'); 

		  	$precio_compra = "<td> S/.".$PrecioCompraFormateado."</td>";

		  	/*=============================================
 	 		TRAEMOS EL PRECIO DE VENTA
  			=============================================*/ 
			$PrecioVentaFormateado = number_format($productos[$i]["precio_venta"], 2, ',', '.'); 

		  	$precio_venta = "<td> S/.".$PrecioVentaFormateado."</td>";

		  	/*=============================================
 	 		TRAEMOS LA MARCA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $productos[$i]["marca_producto"];

		  	$categorias = ControladorMarcas::ctrMostrarMarcas($item, $valor);
			
			if (is_array($categorias)) {
				$respuestaMarca = strtoupper($categorias["marca"]);
			}

		  	/*=============================================
 	 		TRAEMOS LA SERIE
  			=============================================*/ 

  			

		  	$itemSerie = "id";

		  	$valorSerie = $productos[$i]["serie_producto"];

			$series = ControladorSeries::ctrMostrarSeries($itemSerie, $valorSerie);


			if (is_array($series)) {
				$nombreSerie = strtoupper($series["serie"]);
			}

		  	
		  	/*=============================================
 	 		STOCK
  			=============================================*/ 

  			if($productos[$i]["stock"] <= 10){

  				$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

  			}else if($productos[$i]["stock"] >= 11 && $productos[$i]["stock"] <= 15){

  				$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

		  	$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pen'></i></button><button class='btn btn-success btnVerProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalVerProducto'><i class='fa fa-eye'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo_producto"]."' imagen='".$productos[$i]["imagen_producto"]."'><i class='fa fa-times'></i></button></div>"; 

		  	

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$productos[$i]["codigo_producto"].'",
			      "'.$productos[$i]["nombre_producto"].'",
			      "'.$productos[$i]["ubicacion"].'",
			      "'.$respuestaMarca.'",
			      "'.$nombreSerie.'",
			      "'.$productos[$i]["parte_producto"].'",
			      "'.$stock.'",
			      "'.$productos[$i]["codigo_mundial"].'",
			      "'.$precio_compra.'",
			      "'.$precio_venta.'",
			      "'.$botones.'",
			      "'.$productos[$i]["codigo_alternativo"].'",
			      "'.$productos[$i]["compatibilidades"].'",
			      "'.$productos[$i]["descripcion_producto"].'",
			      "'.$productos[$i]["fecha_registro"].'",
			      "'.$productos[$i]["ventas"].'"
			      
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;

	}
}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

