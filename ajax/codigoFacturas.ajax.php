<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

$item = null;
$valor = null;
$contador = 0;

$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

foreach ($ventas as $value) {
    if ($value["tipo_comprobante"] == "FACTURA") {
        $contador++;
    }
}


if ($contador == 0) {
    // Si no hay ventas, asignamos un valor inicial
    $codigo = 10001;
} else {
    
    $codigo = 10001 + $contador;
}



// Devolver el valor como respuesta a la solicitud AJAX
echo $codigo;
