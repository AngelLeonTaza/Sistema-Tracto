<div class="content-wrapper"> 

  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Reporte de Ventas <span style="font-size: 20px; font-weight: 100;">Panel de Reporte de Ventas</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="ventas">Administrar Ventas</a></li>
              <li class="breadcrumb-item active"> Reporte de Ventas </li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">

      <div class="card">

      <div class="card-header border-0">

        <div class="box-tools pull-right">

        <?php

        if(isset($_GET["fechaInicial"])){

          echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

        }else{

           echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';

        }         

        ?>
           
           <button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>

          </a>

        </div>
         
      </div>

      <div class="body">
        
        <div class="row">

          <div class="col">
            
            <?php

            include "reportes/grafico-ventas.php";

            ?>

          </div>
        </div>

        <div class="row">

           <div class="col">
          
            <?php

            include "reportes/productos-mas-vendidos.php";

            ?>

           </div>

         </div>
        

         <div class="row">

            <div class="col-md-6 col-xs-12">
             
            <?php

            include "reportes/vendedores.php";

            ?>

           </div>

           <div class="col-md-6 col-xs-12">
             
            <?php

            include "reportes/compradores.php";

            ?>

           </div>
          
        </div>

        

      </div>
      
    </div>

    </section>
</div>