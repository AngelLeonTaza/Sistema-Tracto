<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

$arrayFechas = array();
$arrayVentas = array();
$sumaPagosMes = array();

foreach ($respuesta as $key => $value) {

	if($value["prioridad"] == "VENTA"){

		#Capturamos sólo el año y el mes
		$fecha = substr($value["fecha"],0,7);

		#Introducir las fechas en arrayFechas
		array_push($arrayFechas, $fecha);

		#Capturamos las ventas
		$arrayVentas = array($fecha => $value["total"]);

		#Sumamos los pagos que ocurrieron el mismo mes
		foreach ($arrayVentas as $key => $value) {
		
		$sumaPagosMes[$key] += $value;
	}

	}

	

}


$noRepetirFechas = array_unique($arrayFechas);


?>

<!--=====================================
GRÁFICO DE VENTAS
======================================-->


<div class="card card-solid bg-teal-gradient">
	
	<div class="card-header">

  		<h3 class="box-title">GRÁFICO DE VENTAS</h3>

	</div>

	<div class="card-body border-radius-none nuevoGraficoVentas">

		<div class="chart" id="line-chart-ventas" style="height: 250px;"></div>

  </div>

</div>

<script>
	
 var line = new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'line-chart-ventas',
  resize           : true,
  data:[

  <?php

    if($noRepetirFechas != null){

	    foreach($noRepetirFechas as $key){

			

	    	echo "{ y: '".$key."', ventas: ".$sumaPagosMes[$key]." },";


	    }

	    echo "{y: '".$key."', ventas: ".$sumaPagosMes[$key]." }";

    }else{

       echo "{ y: '0', ventas: '0' }";

    }

    ?>
	  ],
	  // The name of the data record attribute that contains x-values.
	  xkey: 'y',
	  ykeys: ['ventas'],
	  labels: ['ventas'],
	  lineWidth        : 2,
	  hideHover        : 'auto',
	  gridTextFamily   : 'Open Sans',
	  preUnits         : 'S/.'
});

</script>