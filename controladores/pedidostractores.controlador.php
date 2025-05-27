	<?php

	class ControladorPedidosTractores{

		/*=============================================
		CREAR MarcaS
		=============================================*/

		static public function ctrCrearPedidoTractor(){

			if(isset($_POST["nuevoNombre"])){

				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])){


						$ruta = '';
						// Validar imagen
						if (isset($_FILES["nuevaImagenPedido"]["tmp_name"]) && !empty($_FILES["nuevaImagenPedido"]["tmp_name"])) {
							list($ancho, $alto) = getimagesize($_FILES["nuevaImagenPedido"]["tmp_name"]);
							$nuevoAncho = 500;
							$nuevoAlto = 500;

							// Crear directorio donde se guardará la imagen
							$directorio = "vistas/img/pedidostractores/" . $_POST["nuevoNombre"];

							if (!file_exists($directorio)) {
								mkdir($directorio, 0755, true);
							}

							$aleatorio = mt_rand(100, 999);

							if ($_FILES["nuevaImagenPedido"]["type"] == "image/jpeg") {
								$ruta = $directorio . "/" . $aleatorio . ".jpeg";
								$origen = imagecreatefromjpeg($_FILES["nuevaImagenPedido"]["tmp_name"]);
							} elseif ($_FILES["nuevaImagenPedido"]["type"] == "image/png") {
								$ruta = $directorio . "/" . $aleatorio . ".png";
								$origen = imagecreatefrompng($_FILES["nuevaImagenPedido"]["tmp_name"]);
							} else {
								echo "Error: Formato de imagen no válido.";
								exit();
							}

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							if ($_FILES["nuevaImagenPedido"]["type"] == "image/jpeg") {
								if (!imagejpeg($destino, $ruta, 80)) {
									echo "Error al guardar la imagen JPEG.";
									exit();
								}
							} elseif ($_FILES["nuevaImagenPedido"]["type"] == "image/png") {
								if (!imagepng($destino, $ruta, 5)) {
									echo "Error al guardar la imagen PNG.";
									exit();
								}
							}

							imagedestroy($origen);
							imagedestroy($destino);
						}

						// Continuar con el resto del código después de procesar la imagen...


					$tabla = "pedidos_tractores";

					$datos = array("nombre" => $_POST["nuevoNombre"],
								"direccion" => $_POST["nuevaDireccion"],
									"solicitud" => $_POST["nuevaSolicitud"],
									"telefono" => $_POST["nuevoTelefonoPedido"],
									"foto" => $ruta,
									"estado_solicitud" => $_POST["nuevoEstadoSolicitud"],
									"descripcion_pedido" => $_POST["nuevaDescripcionPedido"]);

					$respuesta = ModeloPedidosTractores::mdlIngresarPedidosTractores($tabla, $datos);

					if($respuesta == "ok"){

						echo '<script>

							Swal.fire({
							title: "¡La Marca ah sido guardado correctamente!",
							icon: "success"
							}).then(function(result){

							if(result.value){
							
								window.location = "pedidos-tractores";

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
							
								window.location = "pedidos-tractores";

							}

						});
					

					</script>';

				}

			}

		}


			/*=============================================
		MOSTRAR MarcaS
		=============================================*/

			static public function ctrMostrarPedidosTractores($item, $valor){

			$tabla = "pedidos_tractores";

			$respuesta = ModeloPedidosTractores::mdlMostrarPedidosTractores($tabla, $item, $valor);

			return $respuesta;
		
		}

		/*=============================================
		EDITAR PEDIDO TRACTOR
		=============================================*/

		static public function ctreditarPedidoTractor(){

			if(isset($_POST["editarNombre"])){

				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])&&
					preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDireccion"])){

					//VALIDAR IMAGEN

					$tabla = "pedidos_tractores";

					$datos = array(	"id" => $_POST["idPedidoTractor"],
									"nombre" => $_POST["editarNombre"],
									"direccion" => $_POST["editarDireccion"],
									"solicitud" => $_POST["editarSolicitud"],
									"telefono" => $_POST["editarTelefonoPedido"],
									"foto" => $_POST["imagenActualPedidosTractores"],
									"estado_solicitud" => $_POST["editarEstadoSolicitud"],
									"descripcion_pedido" => $_POST["editarDescripcionPedido"]);

					$respuesta = ModeloPedidosTractores::mdlEditarPedidoTractor($tabla, $datos);

					if($respuesta == "ok"){

						echo '<script>

							Swal.fire({
							title: "¡El pedido ah sido editada correctamente!",
							icon: "success"
							}).then(function(result){

							if(result.value){
							
								window.location = "pedidos-tractores";

							}

						});
					

					</script>';
					}


				}else{

					echo '<script>

							Swal.fire({
							title: "¡La Marca no puede ir vacío o llevar caracteres especiales!",
							icon: "error"
							}).then(function(result){

							if(result.value){
							
								window.location = "pedidos-tractores";

							}

						});
					

					</script>';

				}

			}

		}

		/*=============================================
		BORRAR Marca
		=============================================*/

		static public function ctrBorrarPedidoTractor(){

			if(isset($_GET["idPedidoTractor"])){


				$tabla ="pedidos_tractores";
				$datos = $_GET["idPedidoTractor"];

				$respuesta = ModeloPedidosTractores::mdlBorrarPedidosTractores($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						Swal.fire({
							title: "¡El pedido ah sido borrada correctamente!",
							icon: "success"
						}).then(function(result){
										if (result.value) {

										window.location = "pedidos-tractores";

										}
									})

						</script>';
				} 

			}
			
		}

	}
