<?php

require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";

class AjaxMarcas{

	/*=============================================
	EDITAR MARCA
	=============================================*/	

	public $idMarca;

	public function ajaxEditarMarca(){

		$item = "id";
		$valor = $this->idMarca;

		$respuesta = ControladorMarcas::ctrMostrarMarcas($item, $valor);

		echo json_encode($respuesta);

	}

	
}

/*=============================================
EDITAR MARCA
=============================================*/	
if(isset($_POST["idMarca"])){

	$Marca = new AjaxMarcas();
	$Marca -> idMarca = $_POST["idMarca"];
	$Marca -> ajaxEditarMarca();
}
