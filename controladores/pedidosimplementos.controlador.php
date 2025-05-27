<?php

class ControladorPedidosImplementos{

	/*=============================================
	CREAR MarcaS
	=============================================*/

	static public function ctrCrearPedidoImplemento(){

		if(isset($_POST["nuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])){


				$ruta = '';
				// Validar imagen
				if (isset($_FILES["nuevaImagenPedidoImplemento"]["tmp_name"]) && !empty($_FILES["nuevaImagenPedidoImplemento"]["tmp_name"])) {
					list($ancho, $alto) = getimagesize($_FILES["nuevaImagenPedidoImplemento"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					// Crear directorio donde se guardará la imagen
					$directorio = "vistas/img/pedidosimplementos/" . $_POST["nuevoNombre"];

					if (!file_exists($directorio)) {
						mkdir($directorio, 0755, true);
					}

					$aleatorio = mt_rand(100, 999);

					if ($_FILES["nuevaImagenPedidoImplemento"]["type"] == "image/jpeg") {
						$ruta = $directorio . "/" . $aleatorio . ".jpeg";
						$origen = imagecreatefromjpeg($_FILES["nuevaImagenPedidoImplemento"]["tmp_name"]);
					} elseif ($_FILES["nuevaImagenPedidoImplemento"]["type"] == "image/png") {
						$ruta = $directorio . "/" . $aleatorio . ".png";
						$origen = imagecreatefrompng($_FILES["nuevaImagenPedidoImplemento"]["tmp_name"]);
					} else {
						echo "Error: Formato de imagen no válido.";
						exit();
					}

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					if ($_FILES["nuevaImagenPedidoImplemento"]["type"] == "image/jpeg") {
						if (!imagejpeg($destino, $ruta, 80)) {
							echo "Error al guardar la imagen JPEG.";
							exit();
						}
					} elseif ($_FILES["nuevaImagenPedidoImplemento"]["type"] == "image/png") {
						if (!imagepng($destino, $ruta, 5)) {
							echo "Error al guardar la imagen PNG.";
							exit();
						}
					}

					imagedestroy($origen);
					imagedestroy($destino);
				}
				// Continuar con el resto del código después de procesar la imagen...


				$tabla = "pedidos_implementos";

				$datos = array("nombre" => $_POST["nuevoNombre"],
							"direccion" => $_POST["nuevaDireccion"],
								"solicitud" => $_POST["nuevaSolicitud"],
								"telefono" => $_POST["nuevoTelefonoPedido"],
								"foto" => $ruta,
								"estado_solicitud" => $_POST["nuevoEstadoSolicitud"],
								"descripcion_pedido" => $_POST["nuevaDescripcionPedido"]);

				$respuesta = ModeloPedidosImplementos::mdlIngresarPedidosImplementos($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						title: "¡El pedido del implemento ah sido guardado correctamente!",
						icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "pedidos-implementos";

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
						
							window.location = "pedidos-implementos";

						}

					});
				

				</script>';

			}

		}

	}


		/*=============================================
	MOSTRAR MarcaS
	=============================================*/

		static public function ctrMostrarPedidosImplementos($item, $valor){

		$tabla = "pedidos_implementos";

		$respuesta = ModeloPedidosImplementos::mdlMostrarPedidosImplementos($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR PEDIDO TRACTOR
	=============================================*/

	static public function ctreditarPedidoImplemento(){

		if(isset($_POST["editarNombreImplemento"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreImplemento"])){

				//VALIDAR IMAGEN

				$ruta = $_POST["imagenActualPedidosImplemento"];


				$tabla = "pedidos_implementos";

				$datos = array("id" => $_POST["idPedidoImplemento"],
								"nombre" => $_POST["editarNombreImplemento"],
								"direccion" => $_POST["editarDireccionImplemento"],
								"solicitud" => $_POST["editarSolicitudImplemento"],
								"telefono" => $_POST["editarTelefonoPedidoImplemento"],
								"foto" => $ruta,
								"estado_solicitud" => $_POST["editarEstadoSolicitudImplemento"],
								"descripcion_pedido" => $_POST["editarDescripcionPedidoImplemento"]);

				$respuesta = ModeloPedidosImplementos::mdlEditarPedidoImplemento($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						title: "¡El pedido ah sido editada correctamente!",
						icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "pedidos-implementos";

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
						
							window.location = "pedidos-implementos";

						}

					});
				

				</script>';

			}

		}

	}

	/*=============================================
	BORRAR Marca
	=============================================*/

	static public function ctrBorrarPedidoImplemento(){

		if(isset($_GET["idPedidoImplemento"])){


			$tabla ="pedidos_implementos";
			$datos = $_GET["idPedidoImplemento"];

			$respuesta = ModeloPedidosImplementos::mdlBorrarPedidosImplementos($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					Swal.fire({
						title: "¡El pedido ah sido borrada correctamente!",
						icon: "success"
					}).then(function(result){
									if (result.value) {

									window.location = "pedidos-implementos";

									}
								})

					</script>';
			} 

		}
		
	}

}
