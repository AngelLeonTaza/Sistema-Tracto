<?php

require_once "../controladores/pedidospiezas.controlador.php";
require_once "../modelos/pedidospiezas.modelo.php";

class AjaxPedidosPiezas{

	/*=============================================
	EDITAR Tractor
	=============================================*/	

	public $idPedidoPieza;

	public function ajaxEditarPedidoPieza(){

		$item = "id";
		$valor = $this->idPedidoPieza;

		$respuesta = ControladorPedidosPiezas::ctrMostrarPedidosPiezas($item, $valor);

		echo json_encode($respuesta);

	}

	
}

/*=============================================
EDITAR MARCA
=============================================*/	
if(isset($_POST["idPedidoPieza"])){

	$PedidoPieza = new AjaxPedidosPiezas();
	$PedidoPieza -> idPedidoPieza = $_POST["idPedidoPieza"];
	$PedidoPieza -> ajaxEditarPedidoPieza();
}
