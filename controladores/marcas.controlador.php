<?php

class ControladorMarcas{

	/*=============================================
	CREAR MarcaS
	=============================================*/

	static public function ctrCrearMarca(){

		if(isset($_POST["nuevaMarca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarca"])){

				$tabla = "marcas";

				$datos = $_POST["nuevaMarca"];

				$respuesta = ModeloMarcas::mdlIngresarMarca($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						  title: "¡La Marca ah sido guardad correctamente!",
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
	MOSTRAR MarcaS
	=============================================*/

		static public function ctrMostrarMarcas($item, $valor){

		$tabla = "marcas";

		$respuesta = ModeloMarcas::mdlMostrarMarcas($tabla, $item, $valor);

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
