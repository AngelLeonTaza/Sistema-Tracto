<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["nuevoDNI"])){

			if(preg_match('/^[0-9]+$/', $_POST["nuevoDNI"])){

			   	$tabla = "clientes";

			   	$datos = array("DNI"=>$_POST["nuevoDNI"],
					           "nombre_cliente"=>$_POST["nuevoCliente"],
					           "telefono"=>$_POST["nuevoTelefono"],
					           "telefono_alternativo"=>$_POST["nuevoTelefonoAlternativo"],
					       		"perfil_facebook"=>$_POST["nuevoPerfilFacebook"],
					       		"perfil_instagram"=>$_POST["nuevoPerfilInstagram"],
					           "procedencia_cliente"=>$_POST["nuevaProcedencia"],
					           "distrito"=>$_POST["nuevoDistrito"],
					       		"departamento"=>$_POST["nuevoDepartamento"],
					           "fecha_nacimiento"=>$_POST["nuevoCumpleaños"],
					           "tipo_cliente"=>$_POST["nuevoTipoCliente"],
					       		"descripcion"=>$_POST["nuevaDescripcionCliente"],
					       		"fuentedeconocimiento"=>$_POST["nuevaFuenteConocimiento"]);

			   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

						Swal.fire({
						  title: "¡El cliente ah sido registrado correctamente!",
						  icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

				</script>';

				}

			}else{

				echo'<script>

						Swal.fire({
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  icon: "error"
						}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

				</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDNI"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarTelefono"])){

			   	$tabla = "clientes";

			   	$datos = array("id"=>$_POST["idCliente"],
			   				   "DNI"=>$_POST["editarDNI"],
					           "nombre_cliente"=>$_POST["editarCliente"],
					           "telefono"=>$_POST["editarTelefono"],
					           "procedencia_cliente"=>$_POST["editarProcedencia"],
					           "fecha_nacimiento"=>$_POST["editarFechaNacimiento"],
					           "tipo_cliente"=>$_POST["editarTipoCliente"],
					       		"descripcion"=>$_POST["editarDescripcionCliente"]);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

						Swal.fire({
						  title: "¡El cliente ah sido editado correctamente!",
						  icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

				</script>';

				}

			}else{

				echo'<script>

						Swal.fire({
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  icon: "error"
						}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

				</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

						Swal.fire({
						  title: "¡El cliente fue eliminado correctamente!",
						  icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

				</script>';

			}		

		}

	}

}

