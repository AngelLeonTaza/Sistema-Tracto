<?php

require_once "../controladores/pedidosotros.controlador.php";
require_once "../modelos/pedidosotros.modelo.php";

class AjaxPedidosOtros{

	/*=============================================
	EDITAR Tractor
	=============================================*/	

	public $idPedidoOtro;

	public function ajaxEditarPedidoOtro(){

		$item = "id";
		$valor = $this->idPedidoOtro;

		$respuesta = ControladorPedidosOtros::ctrMostrarPedidosOtros($item, $valor);

		echo json_encode($respuesta);

	}

	
}

/*=============================================
EDITAR MARCA
=============================================*/	
if(isset($_POST["idPedidoOtro"])){

	$PedidoOtro = new AjaxPedidosOtros();
	$PedidoOtro -> idPedidoOtro = $_POST["idPedidoOtro"];
	$PedidoOtro -> ajaxEditarPedidoOtro();
}
