<?php

require_once "conexion.php";

class ModeloPiezasEncontradas{

	//Crear Marca

	static public function mdlIngresarPiezaEncontrada($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_encargado, direccion, telefono, foto, nombre_pieza, precio) VALUES (:nombre_encargado, :direccion, :telefono, :foto, :nombre_pieza, :precio)");

		$stmt -> bindParam(":nombre_encargado", $datos["nombre_encargado"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre_pieza", $datos["nombre_pieza"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			// code...
			return "ok";

		} else{

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}

		/*=============================================
	MOSTRAR MarcaS
	=============================================*/

	static public function mdlMostrarPiezasEncontradas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	EDITAR Marca
	=============================================*/

	static public function mdlEditarMarca($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET marca = :marca WHERE id = :id");

		$stmt -> bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	/*=============================================
	BORRAR Marca
	=============================================*/

	static public function mdlBorrarMarca($tabla, $datos){

			try {
			    $conexion = Conexion::conectar();
			    $stmt = $conexion->prepare("DELETE FROM $tabla WHERE id = :id");
			    $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

			    if ($stmt->execute()) {
			        $sqlRestablecer = "ALTER TABLE $tabla AUTO_INCREMENT = 1";
			        $stmtRestablecer = $conexion->prepare($sqlRestablecer);
			        $stmtRestablecer->execute();
			        return "ok";
			    } else {
			        return "error";
			    }
			} catch (PDOException $e) {
			    echo "Error de PDO: " . $e->getMessage();
			    return "error";
			} finally {
			    $stmt->closeCursor();
			    $stmt = null;
			    $conexion = null;
			}


	}

}