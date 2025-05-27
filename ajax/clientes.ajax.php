<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}

	
	/*=============================================
	BUSCAR CLIENTE EN SITEMA
	=============================================*/	

	public $dniCliente;

	public function ajaxBuscarClienteSistema(){

		$item = "dni";
		$valor = $this->dniCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}

if(isset($_POST["dniCliente"])){

	$clienteSistema = new AjaxClientes();
	$clienteSistema -> dniCliente = $_POST["dniCliente"];
	$clienteSistema -> ajaxBuscarClienteSistema();

}