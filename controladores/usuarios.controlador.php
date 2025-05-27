<?php

class ControladorUsuarios{

	//INGRESO DE USUARIOS

	static public function ctrIngresoUsuario(){

		if (isset($_POST["ingUsuario"])) {
			// code...
			if (preg_match('/^[a-zA-Z0-9]/', $_POST["ingUsuario"]) &&
				preg_match('/^[a-zA-Z0-9]/', $_POST["ingPassword"]) ) {
				// code...

				$encriptar = crypt($_POST["ingPassword"], '$6$rounds=5000$usesomesillystringforsalt$');


				$tabla = "usuarios";

				$item = "usuario";

				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);



				if(is_array($respuesta) && $respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

					if ($respuesta["estado"] == 1) {
						// code...
					

					$_SESSION["iniciarSesion"] = "ok";

					$_SESSION["id"] = $respuesta["id"];
					$_SESSION["nombre"] = $respuesta["nombre"];
					$_SESSION["usuario"] = $respuesta["usuario"];
					$_SESSION["foto"] = $respuesta["foto"];
					$_SESSION["perfil"] = $respuesta["perfil"];

					//REGISTRAR FECHA PARA EL ULTIMO LOGIN

					date_default_timezone_set('America/Lima');

					$fecha = date('Y-m-d');
					$hora = date('H:i:s');

					$fechaActual = $fecha.' '.$hora;

					$item1 = "ultimo_login";

					$valor1 = $fechaActual;

					$item2 = "id";

					$valor2 = $respuesta["id"];

					$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);


					if($ultimoLogin == "ok")

					{




					echo '<script>
						window.location = "inicio";
					</script>';


					}

					

					}else{
					echo '<div class="alert-danger" style="padding:10px; text-align: center;"> El usuario no esta activo</div>';
				}

				} else{
					echo '<div class="alert-danger" style="padding:10px; text-align: center;"> Error al ingresar, vuelve a intentarlo</div>';
				}

			 }
		}
	}

	//REGISTRO USUARIO

	static public function ctrCrearUsuario(){

		if (isset($_POST["nuevoUsuario"])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) && 
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){


				$ruta = "";

				//validar imagen

				if(isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_FILES["nuevaImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

					mkdir($directorio, 0755, true);


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpeg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);


						imagejpeg($destino, $ruta, true);

					}

					if($_FILES["nuevaFoto"]["type"] ==  "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta, true);

					}



				}



			   	$tabla = "usuarios";

			   	$encriptar = crypt($_POST["nuevoPassword"], '$6$rounds=5000$usesomesillystringforsalt$');

			   	$datos = array("nombre" => $_POST["nuevoNombre"],
			   			 	   "usuario" => $_POST["nuevoUsuario"],
			   			 	   "password" => $encriptar,
			   			 	   "perfil" => $_POST["nuevoPerfil"],
			   			 	   "foto" => $ruta);

			   	$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

			   	if($respuesta == "ok"){

			   		echo '<script>

								Swal.fire({
								  title: "¡El usuario fue registrado exitosamente!",
								  icon: "success"
								}).then(function(result){

								if(result.value){
								
									window.location = "usuarios";

								}

							});
						

						</script>';

			   	}




			} else{

				echo '<script>

						Swal.fire({
						  title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						  icon: "error"
						}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';

			}
			// code...
		}
	}


	//MOSTRAR USUARIO

	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuarios";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$encriptar = crypt($_POST["editarPassword"], '$6$rounds=5000$usesomesillystringforsalt$');

					}else{

						echo '<script>

								Swal.fire({
								  title: "¡la contraseña no puede ir vacia!",
								  icon: "error"
								}).then(function(result){

								if(result.value){
								
									window.location = "usuarios";

								}

							});
						

						</script>';

						  	return;

					}


				}else{

					$encriptar = $_POST["passwordActual"];

				}

				$datos = array("nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"],
							   "foto" => $ruta);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						Swal.fire({
						  title: "¡El usuario ah sido actualizado correctamente!",
						  icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';


				}else{

				echo '<script>

						Swal.fire({
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  icon: "error"
						}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';

			}

		}

		}

	}

///BORRAR USUARIO

	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="usuarios";
			$datos = $_GET["idUsuario"];

			if($_GET["fotoUsuario"] != ""){

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
						  title: "¡El usuario fue borrado correctamente!",
						  icon: "success"
						}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});

				</script>';

			}		

		}

	}


}

