<?php

class ControladorPiezasEncontradas{

	/*=============================================
	CREAR MarcaS
	=============================================*/

	static public function ctrCrearPiezaEncontrada(){

		if(isset($_POST["nuevoNombrePieza"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombrePieza"])){

				$tabla = "productos_encontrados";

				$datos = array("nombre_encargado"=>$_POST["nuevoNombreEncargado"],
					"direccion"=>$_POST["nuevaDireccionPieza"],
					"telefono"=>$_POST["nuevoTelefonoPieza"],
					"foto"=>$_POST["nuevaFotoPieza"],
					"nombre_pieza"=>$_POST["nuevoNombrePieza"],
					"precio"=>$_POST["nuevoPrecioPieza"]);

				$respuesta = ModeloPiezasEncontradas::mdlIngresarPiezaEncontrada($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						  title: "¡La Pieza encontrada ah sido guardad correctamente!",
						  icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "piezas-encontradas";

						}

					});
				

				</script>';
				}


			}else{

				echo '<script>

						Swal.fire({
						  title: "¡La Pieza encontrada puede ir vacío o llevar caracteres especiales!",
						  icon: "error"
						}).then(function(result){

						if(result.value){
						
							window.location = "piezas-encontradas";

						}

					});
				

				</script>';

			}

		}

	}


	/*=============================================
	MOSTRAR PIEZAS ENCONTRADAS
	=============================================*/

	STATIC PUBLIC function ctrMostrarPiezasEncontradas($item, $valor){

		$tabla = "productos_encontrados";

		$respuesta = ModeloPiezasEncontradas::mdlMostrarPiezasEncontradas($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR Marca
	=============================================*/

	static public function ctrEditarMarca(){

		if(isset($_POST["editarMarca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])){

				$tabla = "marcas";

				$datos = array("marca"=>$_POST["editarMarca"],
							   "id"=>$_POST["idMarca"]);

				$respuesta = ModeloMarcas::mdlEditarMarca($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						  title: "¡La Marca ah sido cambiada correctamente!",
						  icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "marcas";

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
						
							window.location = "marcas";

						}

					});
				

				</script>';

			}

		}

	}

	/*=============================================
	BORRAR Marca
	=============================================*/

	static public function ctrBorrarMarca(){

		if(isset($_GET["idMarca"])){

			// $respuesta = ModeloProductos::mdlMostrarProductos("productos", "id_Marca", $_GET["idMarca"], "ASC");
		
			// if(!$respuesta){

				$tabla ="marcas";
				$datos = $_GET["idMarca"];

				$respuesta = ModeloMarcas::mdlBorrarMarca($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						Swal.fire({
						  title: "¡La Marca ah sido borrada correctamente!",
						  icon: "success"
						}).then(function(result){
										if (result.value) {

										window.location = "marcas";

										}
									})

						</script>';
				} 

			// }else{

			// 	echo'<script>

			// 		swal({
			// 			  type: "error",
			// 			  title: "La categoría no se puede eliminar porque tiene productos",
			// 			  showConfirmButton: true,
			// 			  confirmButtonText: "Cerrar"
			// 			  }).then(function(result){
			// 						if (result.value) {

			// 						window.location = "Marcas";

			// 						}
			// 					})

			// 		</script>';	

			// }
		}
		
	}

}
