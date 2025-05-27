<?php

require_once "../controladores/pedidostractores.controlador.php";
require_once "../modelos/pedidostractores.modelo.php";

class AjaxPedidosTractores{

	/*=============================================
	EDITAR Tractor
	=============================================*/	

	public $idPedidoTractor;

	public function ajaxEditarPedidoTractor(){

		$item = "id";
		$valor = $this->idPedidoTractor;

		$respuesta = ControladorPedidosTractores::ctrMostrarPedidosTractores($item, $valor);

		echo json_encode($respuesta);

	}

	
}

/*=============================================
EDITAR MARCA
=============================================*/	
if(isset($_POST["idPedidoTractor"])){

	$PedidoTractor = new AjaxPedidosTractores();
	$PedidoTractor -> idPedidoTractor = $_POST["idPedidoTractor"];
	$PedidoTractor -> ajaxEditarPedidoTractor();
}
