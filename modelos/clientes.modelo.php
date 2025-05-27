<?php

require_once "conexion.php";

class ModeloClientes{

	/*=============================================
	CREAR CLIENTE
	=============================================*/

	static public function mdlIngresarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(DNI, nombre_cliente, telefono, telefono_alternativo, perfil_facebook, perfil_instagram, procedencia_cliente, distrito, departamento, fecha_nacimiento, tipo_cliente, descripcion, fuentedeconocimiento) VALUES (:DNI, :nombre_cliente, :telefono, :telefono_alternativo, :perfil_facebook, :perfil_instagram, :procedencia_cliente, :distrito, :departamento, :fecha_nacimiento, :tipo_cliente, :descripcion, :fuentedeconocimiento)");

		$stmt->bindParam(":DNI", $datos["DNI"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_alternativo", $datos["telefono_alternativo"], PDO::PARAM_STR);

		$stmt->bindParam(":perfil_facebook", $datos["perfil_facebook"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil_instagram", $datos["perfil_instagram"], PDO::PARAM_STR);
		$stmt->bindParam(":procedencia_cliente", $datos["procedencia_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":distrito", $datos["distrito"], PDO::PARAM_STR);
		$stmt->bindParam(":departamento", $datos["departamento"], PDO::PARAM_STR);

		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_cliente", $datos["tipo_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":fuentedeconocimiento", $datos["fuentedeconocimiento"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientes($tabla, $item, $valor){

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
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET DNI = :DNI, nombre_cliente = :nombre_cliente, telefono = :telefono, procedencia_cliente = :procedencia_cliente, fecha_nacimiento = :fecha_nacimiento, tipo_cliente = :tipo_cliente, descripcion = :descripcion WHERE id = :id");

		$stmt->bindParam(":DNI", $datos["DNI"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":procedencia_cliente", $datos["procedencia_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_cliente", $datos["tipo_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}