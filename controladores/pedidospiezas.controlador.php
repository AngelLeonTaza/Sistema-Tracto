<?php

class ControladorPedidosPiezas{

	/*=============================================
	CREAR MarcaS
	=============================================*/

	static public function ctrCrearPedidoPieza(){

		if(isset($_POST["nuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])){


				$ruta = '';
				// Validar imagen
				if (isset($_FILES["nuevaImagenPedidoPieza"]["tmp_name"]) && !empty($_FILES["nuevaImagenPedidoPieza"]["tmp_name"])) {
					list($ancho, $alto) = getimagesize($_FILES["nuevaImagenPedidoPieza"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					// Crear directorio donde se guardará la imagen
					$directorio = "vistas/img/pedidospiezas/" . $_POST["nuevoNombre"];

					if (!file_exists($directorio)) {
						mkdir($directorio, 0755, true);
					}

					$aleatorio = mt_rand(100, 999);

					if ($_FILES["nuevaImagenPedidoPieza"]["type"] == "image/jpeg") {
						$ruta = $directorio . "/" . $aleatorio . ".jpeg";
						$origen = imagecreatefromjpeg($_FILES["nuevaImagenPedidoPieza"]["tmp_name"]);
					} elseif ($_FILES["nuevaImagenPedidoPieza"]["type"] == "image/png") {
						$ruta = $directorio . "/" . $aleatorio . ".png";
						$origen = imagecreatefrompng($_FILES["nuevaImagenPedidoPieza"]["tmp_name"]);
					} else {
						echo "Error: Formato de imagen no válido.";
						exit();
					}

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					if ($_FILES["nuevaImagenPedidoPieza"]["type"] == "image/jpeg") {
						if (!imagejpeg($destino, $ruta, 80)) {
							echo "Error al guardar la imagen JPEG.";
							exit();
						}
					} elseif ($_FILES["nuevaImagenPedidoPieza"]["type"] == "image/png") {
						if (!imagepng($destino, $ruta, 5)) {
							echo "Error al guardar la imagen PNG.";
							exit();
						}
					}

					imagedestroy($origen);
					imagedestroy($destino);
				}
				// Continuar con el resto del código después de procesar la imagen...


				$tabla = "pedidos_piezas";

				$datos = array("nombre" => $_POST["nuevoNombre"],
							"direccion" => $_POST["nuevaDireccion"],
								"solicitud" => $_POST["nuevaSolicitud"],
								"telefono" => $_POST["nuevoTelefonoPedido"],
								"foto" => $ruta,
								"estado_solicitud" => $_POST["nuevoEstadoSolicitud"],
								"descripcion_pedido" => $_POST["nuevaDescripcionPedido"]);

				$respuesta = ModeloPedidosPiezas::mdlIngresarPedidosPiezas($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						title: "¡El pedido del Pieza ah sido guardado correctamente!",
						icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "pedidos-piezas";

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
						
							window.location = "pedidos-piezas";

						}

					});
				

				</script>';

			}

		}

	}


		/*=============================================
	MOSTRAR MarcaS
	=============================================*/

		static public function ctrMostrarPedidosPiezas($item, $valor){

		$tabla = "pedidos_piezas";

		$respuesta = ModeloPedidosPiezas::mdlMostrarPedidosPiezas($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR PEDIDO TRACTOR
	=============================================*/

	static public function ctreditarPedidoPieza(){

		if(isset($_POST["editarNombrePieza"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombrePieza"])){

				//VALIDAR IMAGEN

				$ruta = $_POST["imagenActualPedidosPieza"];


				$tabla = "pedidos_piezas";

				$datos = array("id" => $_POST["idPedidoPieza"],
								"nombre" => $_POST["editarNombrePieza"],
								"direccion" => $_POST["editarDireccionPieza"],
								"solicitud" => $_POST["editarSolicitudPieza"],
								"telefono" => $_POST["editarTelefonoPedidoPieza"],
								"foto" => $ruta,
								"estado_solicitud" => $_POST["editarEstadoSolicitudPieza"],
								"descripcion_pedido" => $_POST["editarDescripcionPedidoPieza"]);

				$respuesta = ModeloPedidosPiezas::mdlEditarPedidoPieza($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						title: "¡El pedido ah sido editada correctamente!",
						icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "pedidos-piezas";

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
						
							window.location = "pedidos-piezas";

						}

					});
				

				</script>';

			}

		}

	}

	/*=============================================
	BORRAR Marca
	=============================================*/

	static public function ctrBorrarPedidoPieza(){

		if(isset($_GET["idPedidoPieza"])){


			$tabla ="pedidos_piezas";
			$datos = $_GET["idPedidoPieza"];

			$respuesta = ModeloPedidosPiezas::mdlBorrarPedidosPiezas($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					Swal.fire({
						title: "¡El pedido ah sido borrada correctamente!",
						icon: "success"
					}).then(function(result){
									if (result.value) {

									window.location = "pedidos-piezas";

									}
								})

					</script>';
			} 

		}
		
	}

}
