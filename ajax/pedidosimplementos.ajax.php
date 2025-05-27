<?php

require_once "../controladores/pedidosimplementos.controlador.php";
require_once "../modelos/pedidosimplementos.modelo.php";

class AjaxPedidosImplementos{

	/*=============================================
	EDITAR Tractor
	=============================================*/	

	public $idPedidoImplemento;

	public function ajaxEditarPedidoImplemento(){

		$item = "id";
		$valor = $this->idPedidoImplemento;

		$respuesta = ControladorPedidosImplementos::ctrMostrarPedidosImplementos($item, $valor);

		echo json_encode($respuesta);

	}

	
}

/*=============================================
EDITAR MARCA
=============================================*/	
if(isset($_POST["idPedidoImplemento"])){

	$PedidoImplemento = new AjaxPedidosImplementos();
	$PedidoImplemento -> idPedidoImplemento = $_POST["idPedidoImplemento"];
	$PedidoImplemento -> ajaxEditarPedidoImplemento();
}
