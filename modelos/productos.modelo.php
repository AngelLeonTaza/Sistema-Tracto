<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor, $orden){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(imagen_producto, codigo_producto, nombre_producto, descripcion_producto, marca_producto, serie_producto, parte_producto, compatibilidades, codigo_mundial, codigo_alternativo, precio_compra, precio_venta, stock, ubicacion) VALUES (:imagen_producto, :codigo_producto, :nombre_producto, :descripcion_producto, :marca_producto, :serie_producto, :parte_producto, :compatibilidades, :codigo_mundial, :codigo_alternativo, :precio_compra, :precio_venta, :stock, :ubicacion)");

		$stmt->bindParam(":imagen_producto", $datos["imagen_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_producto", $datos["codigo_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_producto", $datos["descripcion_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":marca_producto", $datos["marca_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":serie_producto", $datos["serie_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":parte_producto", $datos["parte_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":compatibilidades", $datos["compatibilidades"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_mundial", $datos["codigo_mundial"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_alternativo", $datos["codigo_alternativo"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion", $datos["ubicacion"], PDO::PARAM_STR);
		
		if ($stmt -> execute()) {

				return "ok";
				// code...
			} else{
				return "error";
			}

			$stmt -> close();

			$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET imagen_producto = :imagen_producto, codigo_producto = :codigo_producto, nombre_producto = :nombre_producto, descripcion_producto = :descripcion_producto, marca_producto = :marca_producto, serie_producto = :serie_producto, parte_producto = :parte_producto, parte_producto = :parte_producto, compatibilidades = :compatibilidades, codigo_mundial = :codigo_mundial, codigo_alternativo = :codigo_alternativo, precio_compra = :precio_compra, precio_venta = :precio_venta, stock = :stock, ubicacion = :ubicacion WHERE codigo_producto = :codigo_producto");

		$stmt->bindParam(":imagen_producto", $datos["imagen_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_producto", $datos["codigo_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_producto", $datos["descripcion_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":marca_producto", $datos["marca_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":serie_producto", $datos["serie_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":parte_producto", $datos["parte_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":compatibilidades", $datos["compatibilidades"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_mundial", $datos["codigo_mundial"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_alternativo", $datos["codigo_alternativo"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion", $datos["ubicacion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

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
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

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

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}
}