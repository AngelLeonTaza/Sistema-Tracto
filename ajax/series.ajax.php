<?php

require_once "../controladores/series.controlador.php";
require_once "../modelos/series.modelo.php";

class AjaxSeries {
    public $idSerie;

    public function ajaxEditarSerie() {
        $item = "id";
        $valor = $this->idSerie;

        $respuesta = ControladorSeries::ctrMostrarSeries($item, $valor);

        if ($respuesta) {
            echo json_encode($respuesta);
        }
    }
}

// Verificar si se recibió el ID de la serie por POST
if (isset($_POST["idSerie"])) {
    $editar = new AjaxSeries();
    $editar-> idSerie = $_POST["idSerie"];
    $editar->ajaxEditarSerie();
} 
