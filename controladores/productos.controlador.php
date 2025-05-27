<?php

class ControladorProductos
{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor, $orden)
	{

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

		return $respuesta;
	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearProducto()
	{

		if (isset($_POST["nuevoCodigo"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCodigo"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = 'vistas/img/productos/default/anonymous.png';

				if (isset($_FILES["nuevaImagen"]["tmp_name"]) && !empty($_FILES["nuevaImagen"]["tmp_name"])) {
					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					$directorio = "vistas/img/productos/" . $_POST["nuevoCodigo"];

					// Crear el directorio si no existe
					if (!file_exists($directorio)) {
						mkdir($directorio, 0755, true);
					}

					if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/productos/" . $_POST["nuevoCodigo"] . "/" . $aleatorio . ".jpeg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta, true);
					}

					if ($_FILES["nuevaImagen"]["type"] == "image/png") {

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/productos/" . $_POST["nuevoCodigo"] . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta, true);
					}
				} else {
				}



				$tabla = "productos";

				$datos = array(
					"imagen_producto" => $ruta,
					"codigo_producto" => $_POST["nuevoCodigo"],
					"nombre_producto" => $_POST["nuevoNombre"],
					"descripcion_producto" => $_POST["nuevaDescripcion"],
					"marca_producto" => $_POST["nuevaMarca"],
					"serie_producto" => $_POST["nuevaSerie"],
					"parte_producto" => $_POST["nuevaParte"],
					"compatibilidades" => $_POST["nuevaCompatibilidad"],
					"codigo_mundial" => $_POST["nuevoCodigoMundial"],
					"codigo_alternativo" => $_POST["nuevoCodigoAlternativo"],
					"precio_compra" => $_POST["nuevoPrecioCompra"],
					"precio_venta" => $_POST["nuevoPrecioVenta"],
					"ubicacion" => $_POST["nuevaUbicacion"],
					"stock" => $_POST["nuevoStock"]
				);

				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

								Swal.fire({
  								title: "¡El producto fue registrado exitosamente!",
								  icon: "success"
								}).then(function(result){

								if(result.value){
								
									window.location = "productos";

								}

							});
						

						</script>';
				}
			} else {

				echo '<script>

						Swal.fire({
						  title: "¡El producto no puede ir vacío o llevar caracteres especiales!",
						  icon: "error"
						}).then(function(result){

						if(result.value){
						
							window.location = "productos";

						}

					});
				

				</script>';
			}
		}
	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto()
	{

		if (isset($_POST["editarCodigo"])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCodigo"])
			) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["imagenActual"];

				if (isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/" . $_POST["editarCodigo"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if (!empty($_POST["imagenActual"])) {

						unlink($_POST["imagenActual"]);
					} else {

						mkdir($directorio, 0755, true);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["editarImagen"]["type"] == "image/jpeg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/productos/" . $_POST["editarCodigo"] . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if ($_FILES["editarImagen"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/productos/" . $_POST["editarCodigo"] . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "productos";

				$datos = array(
					"imagen_producto" => $ruta,
					"codigo_producto" => $_POST["editarCodigo"],
					"nombre_producto" => $_POST["editarNombre"],
					"descripcion_producto" => $_POST["editarDescripcion"],
					"marca_producto" => $_POST["editarMarca"],
					"serie_producto" => $_POST["editarSerie"],
					"parte_producto" => $_POST["editarParte"],
					"compatibilidades" => $_POST["editarCompatibilidad"],
					"codigo_mundial" => $_POST["editarCodigoMundial"],
					"codigo_alternativo" => $_POST["editarCodigoAlternativo"],
					"precio_compra" => $_POST["editarPrecioCompra"],
					"precio_venta" => $_POST["editarPrecioVenta"],
					"ubicacion" => $_POST["editarUbicacion"],
					"stock" => $_POST["editarStock"]
				);

				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

								Swal.fire({
								  title: "¡El Producto fue editado exitosamente!",
								  icon: "success"
								}).then(function(result){

								if(result.value){
								
									window.location = "productos";

								}

							});
						

						</script>';
				}
			} else {

				echo '<script>

						Swal.fire({
						  title: "¡El producto no puede ir vacío o llevar caracteres especiales!",
						  icon: "error"
						}).then(function(result){

						if(result.value){
						
							window.location = "productos";

						}

					});
				

				</script>';
			}
		}
	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto()
	{

		if (isset($_GET["idProducto"])) {

			$tabla = "productos";
			$datos = $_GET["idProducto"];

			if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png") {

				unlink($_GET["imagen"]);
				rmdir('vistas/img/productos/' . $_GET["codigo"]);
			}

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

								Swal.fire({
								  title: "¡El Producto fue eliminado exitosamente!",
								  icon: "success"
								}).then(function(result){

								if(result.value){
								
									window.location = "productos";

								}

							});
						

						</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentas()
	{

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;
	}
}
