<?php

require_once "conexion.php";

class ModeloSeries{

	static public function mdlMostrarSeries($tabla, $item, $valor){

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

	//crear serie

	static public function mdlIngresarSerie($tabla, $datos){
 	    	
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(serie, marca) VALUES (:serie, :marca)");
        $stmt->bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
        $stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR Serie
	=============================================*/

	static public function mdlEditarSerie($tabla, $datos){

		try {
		    // Preparar la consulta de actualización
		    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET serie = :serie WHERE id = :id");

		    // Vincular los parámetros
		    $stmt->bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
		    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		    // Ejecutar la consulta de actualización
		    if ($stmt->execute()) {
		        // La actualización fue exitosa
		        return "ok";
		    } else {
		        // Hubo un error en la actualización
		        return "error";
		    }
		} catch (PDOException $e) {
		    // Manejar la excepción de PDO, imprime o registra el error
		    echo "Error de PDO: " . $e->getMessage();
		    return "error";
		} finally {
		    // Cierra la conexión y libera los recursos
		    $stmt->closeCursor();
		    $stmt = null;
		}


	}

	/*=============================================
	BORRAR Serie
	=============================================*/

	static public function mdlBorrarSerie($tabla, $datos){

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