<?php

class ControladorPedidosOtros{

	/*=============================================
	CREAR MarcaS
	=============================================*/

	static public function ctrCrearPedidoOtro(){

		if(isset($_POST["nuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])){


				$ruta = '';
				// Validar imagen
				if (isset($_FILES["nuevaImagenPedidoOtro"]["tmp_name"]) && !empty($_FILES["nuevaImagenPedidoOtro"]["tmp_name"])) {
					list($ancho, $alto) = getimagesize($_FILES["nuevaImagenPedidoOtro"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					// Crear directorio donde se guardará la imagen
					$directorio = "vistas/img/pedidosotros/" . $_POST["nuevoNombre"];

					if (!file_exists($directorio)) {
						mkdir($directorio, 0755, true);
					}

					$aleatorio = mt_rand(100, 999);

					if ($_FILES["nuevaImagenPedidoOtro"]["type"] == "image/jpeg") {
						$ruta = $directorio . "/" . $aleatorio . ".jpeg";
						$origen = imagecreatefromjpeg($_FILES["nuevaImagenPedidoOtro"]["tmp_name"]);
					} elseif ($_FILES["nuevaImagenPedidoOtro"]["type"] == "image/png") {
						$ruta = $directorio . "/" . $aleatorio . ".png";
						$origen = imagecreatefrompng($_FILES["nuevaImagenPedidoOtro"]["tmp_name"]);
					} else {
						echo "Error: Formato de imagen no válido.";
						exit();
					}

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					if ($_FILES["nuevaImagenPedidoOtro"]["type"] == "image/jpeg") {
						if (!imagejpeg($destino, $ruta, 80)) {
							echo "Error al guardar la imagen JPEG.";
							exit();
						}
					} elseif ($_FILES["nuevaImagenPedidoOtro"]["type"] == "image/png") {
						if (!imagepng($destino, $ruta, 5)) {
							echo "Error al guardar la imagen PNG.";
							exit();
						}
					}

					imagedestroy($origen);
					imagedestroy($destino);
				}
				// Continuar con el resto del código después de procesar la imagen...


				$tabla = "pedidos_otros";

				$datos = array("nombre" => $_POST["nuevoNombre"],
							"direccion" => $_POST["nuevaDireccion"],
								"solicitud" => $_POST["nuevaSolicitud"],
								"telefono" => $_POST["nuevoTelefonoPedido"],
								"foto" => $ruta,
								"estado_solicitud" => $_POST["nuevoEstadoSolicitud"],
								"descripcion_pedido" => $_POST["nuevaDescripcionPedido"]);

				$respuesta = ModeloPedidosOtros::mdlIngresarPedidosOtros($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						title: "¡El pedido del Otro ah sido guardado correctamente!",
						icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "pedidos-otros";

						}

					});
				

				</script>';
				}


			}else{

				echo '<script>

						Swal.fire({
						title: "¡El pedido no puede llevar caracteres especiales!",
						icon: "error"
						}).then(function(result){

						if(result.value){
						
							window.location = "pedidos-otros";

						}

					});
				

				</script>';

			}

		}

	}


		/*=============================================
	MOSTRAR MarcaS
	=============================================*/

		static public function ctrMostrarPedidosOtros($item, $valor){

		$tabla = "pedidos_otros";

		$respuesta = ModeloPedidosOtros::mdlMostrarPedidosOtros($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR PEDIDO TRACTOR
	=============================================*/

	static public function ctreditarPedidoOtro(){

		if(isset($_POST["editarNombreOtro"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreOtro"])){

				//VALIDAR IMAGEN

				$ruta = $_POST["imagenActualPedidosOtro"];


				$tabla = "pedidos_otros";

				$datos = array("id" => $_POST["idPedidoOtro"],
								"nombre" => $_POST["editarNombreOtro"],
								"direccion" => $_POST["editarDireccionOtro"],
								"solicitud" => $_POST["editarSolicitudOtro"],
								"telefono" => $_POST["editarTelefonoPedidoOtro"],
								"foto" => $ruta,
								"estado_solicitud" => $_POST["editarEstadoSolicitudOtro"],
								"descripcion_pedido" => $_POST["editarDescripcionPedidoOtro"]);

				$respuesta = ModeloPedidosOtros::mdlEditarPedidoOtro($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						title: "¡El pedido ah sido editada correctamente!",
						icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "pedidos-Otros";

						}

					});
				

				</script>';
				}


			}else{

				echo '<script>

						Swal.fire({
						title: "¡El pedido no puede ir vacío o llevar caracteres especiales!",
						icon: "error"
						}).then(function(result){

						if(result.value){
						
							window.location = "pedidos-otros";

						}

					});
				

				</script>';

			}

		}

	}

	/*=============================================
	BORRAR Marca
	=============================================*/

	static public function ctrBorrarPedidoOtro(){

		if(isset($_GET["idPedidoOtro"])){


			$tabla ="pedidos_Otros";
			$datos = $_GET["idPedidoOtro"];

			$respuesta = ModeloPedidosOtros::mdlBorrarPedidosOtros($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					Swal.fire({
						title: "¡El pedido ah sido borrada correctamente!",
						icon: "success"
					}).then(function(result){
									if (result.value) {

									window.location = "pedidos-otros";

									}
								})

					</script>';
			} 

		}
		
	}

}
