<?php

if($_SESSION["perfil"] == "logistica"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$xml = ControladorVentas::ctrDescargarXML();

if($xml){

  rename($_GET["xml"].".xml", "xml/".$_GET["xml"].".xml");

  echo '<a class="btn btn-block btn-success abrirXML" archivo="xml/'.$_GET["xml"].'.xml" href="ventas">Se ha creado correctamente el archivo XML <span class="fa fa-times pull-right"></span></a>';

}

?>
<div class="content-wrapper">

  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrar Ventas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-venta">

          <button class="btn btn-primary" style="margin-bottom: 20px;">
            CREAR VENTA
          </button>
        </a>

         <button type="button" class="btn btn-default pull-right" id="daterange-btn" style="margin-bottom: 20px;">
           
            <span>
              <i class="fa fa-calendar"></i> 

              <?php

                if(isset($_GET["fechaInicial"])){

                  echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];
                
                }else{
                 
                  echo 'Rango de fecha';

                }

              ?>
            </span>

            <i class="fa fa-caret-down"></i>

         </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>SERIE</th>
           <th>CLIENTE</th>
           <th>VENDEDOR</th>
           <th>TIPO</th>
           <th>IMPORTE NETO</th>
           <th>IMPORTE TOTAL</th> 
           <th>FECHA</th>

           <th>ESTADO</th>

           <th>ACCIONES</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {

          if($value["prioridad"] == "VENTA"){
           
           echo '<tr>

                  <td>'.($key+1).'</td>';

                  $serieComprobante = mostrarSerieComprobante($value["id"]);


                  echo '<td><strong>'.$serieComprobante.'</strong> - '.$value["codigo"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  

                  echo '<td>'.$respuestaCliente["nombre_cliente"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>


                  <td>'.$value["tipo_anticipo"].'</td>

                  <td>S/. '.number_format($value["neto"],2).'</td>

                  <td>S/. '.number_format($value["total"],2).'</td>

                  <td>'.$value["fecha"].'</td>';

                  if($value["estado"] == "PAGADO"){
                    echo '<td class="bg-primary">'.$value["estado"].'</td>';
                  } else{
                    echo '<td class="bg-red">'.$value["estado"].'</td>';
                  }
                  

                  

                  echo '<td>

                    <div class="btn-group">

                      <a class="btn btn-success" href="index.php?ruta=ventas&xml='.$value["codigo"].'">xml</a>
                      
                      <button class="btn btn-info btnImprimirComprobante" idVenta="'.$value["id"].'" tipoComprobante="'.$value["tipo_comprobante"].'" tipoAnticipo="'.$value["tipo_anticipo"].'" codigoVenta="'.$value["codigo"].'">
                        <i class="fa fa-print"></i>
                      </button>
                      
                      <button class="btn btn-info btn-danger btnImprimirGuiaRemision" idVenta="'.$value["id"].'" tipoComprobante="'.$value["tipo_comprobante"].'" tipoAnticipo="'.$value["tipo_anticipo"].'" codigoVenta="'.$value["codigo"].'">

                        <i class="fa fa-bus"></i>

                      </button>';

                      if($_SESSION["perfil"] == "Administrador"){

                      echo '<button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pen"></i></button>

                      <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                      }


                      echo '<button class="btn btn-success btnVerVenta" idVenta="'.$value["id"].'" data-toggle="modal" data-target="#modalVerVenta"><i class="fa fa-eye"></i></button>';

                    echo '</div>  

                  </td>

                </tr>';
                  }
            }

        ?>
               
        </tbody>

       </table>

       

       <?php

        $eliminarVenta = new ControladorVentas();
        $eliminarVenta -> ctrEliminarVenta();

       ?>
       

      </div>

    </div>

  </section>

</div>

<!-- VENTANA MODAL VER VENTA-->
<div class="modal fade" id="modalVerVenta" role="dialog" aria-labelledby="modalDeduccionAnticipo" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

    <form role="form" method="post">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel" >DETALLES DE LA VENTA</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="verVentacontainer">


      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

      </div>

    </form>

    </div>
  </div>
</div>
