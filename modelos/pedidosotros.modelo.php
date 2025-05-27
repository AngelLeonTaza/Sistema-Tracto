<?php

require_once "conexion.php";

class ModeloPedidosOtros{

	//CREAR PEDIDO TRACTOR

	static public function mdlIngresarPedidosOtros($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, direccion, solicitud, telefono, foto, estado_solicitud, descripcion_pedido) VALUES (:nombre, :direccion, :solicitud, :telefono, :foto, :estado_solicitud, :descripcion_pedido)");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":solicitud", $datos["solicitud"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado_solicitud", $datos["estado_solicitud"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion_pedido", $datos["descripcion_pedido"], PDO::PARAM_STR);

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
	MOSTRAR PEDIDOS
	=============================================*/

	static public function mdlMostrarPedidosOtros($tabla, $item, $valor){

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
	EDITAR PEDIDOS TRACTORES
	=============================================*/

	static public function mdlEditarPedidoOtro($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, direccion = :direccion, solicitud = :solicitud, telefono = :telefono, foto = :foto, estado_solicitud = :estado_solicitud, descripcion_pedido = :descripcion_pedido WHERE id = :id");
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":solicitud", $datos["solicitud"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado_solicitud", $datos["estado_solicitud"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion_pedido", $datos["descripcion_pedido"], PDO::PARAM_STR);

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

	static public function mdlBorrarPedidosOtros($tabla, $datos){

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