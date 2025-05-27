<?php

class ControladorSeries{

	static public function ctrCrearSerie(){

		if(isset($_POST["nuevaSerie"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaSerie"])){

				$tabla = "series";

				$datos = array("serie" => $_POST["nuevaSerie"],
			   			 	   "marca" => $_POST["marcaSerie"]);

				$respuesta = ModeloSeries::mdlIngresarSerie($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						  title: "¡La Serie ah sido guardado correctamente!",
						  icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "series";

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
						
							window.location = "series";

						}

					});
				

				</script>';

			}

		}

	}


	/*=============================================
	MOSTRAR SERIE
	=============================================*/

	static public function ctrMostrarSeries($item, $valor){

		$tabla = "series";

		$respuesta = ModeloSeries::mdlMostrarSeries($tabla, $item, $valor);

		return $respuesta;

		console.log($respuesta);
	
	}
	
	/*=============================================
	EDITAR SERIE
	=============================================*/

	static public function ctrEditarSerie(){

		if(isset($_POST["editarSerie"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarSerie"])){

				$tabla = "series";

				$datos = array("serie" => $_POST["editarSerie"],
							   "id" => $_POST["idSerie"],
							   "marca" => $_POST["editarMarcaSerie"]);

				$respuesta = ModeloSeries::mdlEditarSerie($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						  title: "¡La Serie ah sido editada correctamente!",
						  icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "series";

						}

					});
				

				</script>';
				}


			}else{

				echo '<script>

						Swal.fire({
						  title: "¡La Serie no puede ir vacío o llevar caracteres especiales!",
						  icon: "error"
						}).then(function(result){

						if(result.value){
						
							window.location = "series";

						}	

					});
				

				</script>';

			}

		}

	}

	/*=============================================
	BORRAR SERIE
	=============================================*/

	static public function ctrBorrarSerie(){

		if(isset($_GET["idSerie"])){

			// $respuesta = ModeloProductos::mdlMostrarProductos("productos", "id_Marca", $_GET["idMarca"], "ASC");
		
			// if(!$respuesta){

				$tabla ="series";
				$datos = $_GET["idSerie"];

				$respuesta = ModeloSeries::mdlBorrarSerie($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						Swal.fire({
						  title: "¡La Serie ah sido borrada correctamente!",
						  icon: "success"
						}).then(function(result){
										if (result.value) {

										window.location = "series";

										}
									})

						</script>';
				}

			}

		}
} 