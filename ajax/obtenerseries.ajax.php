<?php

require_once "../controladores/series.controlador.php";
require_once "../modelos/series.modelo.php";

// Conectar a la base de datos y obtener las series según la marca seleccionada
$marcaSeleccionada = $_GET['marca'];

// Realizar la consulta a la base de datos para obtener las series correspondientes a la marca seleccionada
// Supongamos que $series es un array con las series obtenidas de la base de datos

$item = null;
$valor = null;

$series = ControladorSeries::ctrMostrarSeries($item, $valor);

foreach ($series as $serie) {
    if($serie["marca"] == $marcaSeleccionada){

    $options .= '<option value="' . $serie['id'] . '">' . $serie['serie'] . '</option>';

    }

}

echo $options;