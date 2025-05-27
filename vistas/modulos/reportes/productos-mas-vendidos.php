
<?php

  $item = null;
  $valor = null;
  $orden = "ventas";

  $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

  $colores = array("red","green","yellow","orange","purple","blue","cyan","magenta","orange","gold");

  $totalVentas = ControladorProductos::ctrMostrarSumaVentas();


?>

<!--=====================================
PRODUCTOS MÁS VENDIDOS
======================================-->

<div class="card card-default">
	
	<div class="card-header with-border">
  
      <h3 class="box-title">PRODUCTOS MÁS VENDIDOS</h3>


    </div>

	<div class="box-body">
    
      	<div class="row">

	        <div class="col-md-12">

	 			       <div class="chart-responsive">
	            
	            	<canvas id="donutChart" height="300"></canvas>
	          
	          	</div>

	        </div>

		</div>

    </div>

    <div class="box-footer no-padding">
    	
		<ul class="nav nav-pills flex-column">
			
			 <?php

          	for($i = 0; $i <5; $i++){
			
          		echo '<li>
						 
  						 <a>

    						 <img src="'.$productos[$i]["imagen_producto"].'" class="img-thumbnail" width="100px" style="margin:10px 20px"> 
    						 '.$productos[$i]["nombre_producto"].'

    						 <span class="pull-right text-'.$colores[$i].'" style="margin-left:20px">   
    						 '.ceil($productos[$i]["ventas"]*100/$totalVentas["total"]).'%
    						 </span>
  							
  						 </a>

      				</li>';

			}

			?>


		</ul>

    </div>

</div>

<script>
	
   //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {

      labels: [

        <?php 

          for ($i = 0; $i < 5; $i++) {

              echo "'" . $productos[$i]["nombre_producto"] . "',";

          }

        ?>


      ],

      datasets: [
        {

          data: [700,500,400,600,300,100],
          backgroundColor : [

            <?php 

          for ($i = 0; $i < 5; $i++) {

              echo "'" . $colores[$i] . "',";

          }

        ?>

            ],

        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })



</script>