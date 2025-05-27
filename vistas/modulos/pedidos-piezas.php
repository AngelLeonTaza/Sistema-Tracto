<div class="content-wrapper">

  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrar Pedido de Piezas</h1>
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

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPedidoPieza" style="margin-bottom: 20px;">

              Agregar Pedido de Pieza

            </button>

          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablas" style="width:100%">
              
              <thead>
                
                <tr>
                  
                  <th style="width:10px">#</th>
                  <th> Nombre Cliente</th>
                  <th> Direccion</th>
                  <th> Solicitud</th>
                  <th> Telefono </th>
                  <th> Foto </th>
                  <th> Fecha de la Solicitud </th>
                  <th> Estado del Envio </th>
                  <th> Descripion del Pedido </th>
                  <th> Acciones </th>



                </tr>

              </thead>

              <tbody>

                <?php

          $item = null;
          $valor = null;

          $pedidoPiezas = ControladorPedidosPiezas::ctrMostrarPedidosPiezas($item, $valor);

          foreach ($pedidoPiezas as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["solicitud"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>';

                    if ($value["foto"] != "") {

                      echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="90px"></td>';
                      // code...
                    } else{

                      echo '<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="90px"></td>';

                    }


                    echo '<td class="text-uppercase">'.$value["fecha_solicitud"].'</td>
                    <td class="text-uppercase">'.$value["estado_solicitud"].'</td>
                    <td class="text-uppercase">'.$value["descripcion_pedido"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarPedidoPieza" idPedidoPieza="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPedidoPieza"><i class="fa fa-pen"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarPedidoPieza" idPedidoPieza="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                        }

                      echo '</div>  

                    </td>

                  </tr>';
          }

        ?>

              </tbody>

            </table>

          </div>

        </div>   
    </section>
</div>

<!--=====================================
AGREAR PEDIDO DE Pieza
======================================-->
<div id="modalAgregarPedidoPieza" class="modal fade" role="dialog" >
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Agregar Pedido de Piezas</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card-body">  

          <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" id="nuevoNombre" placeholder="Nombre del Solicitante" required>

              </div>  

            </div>  

            <!--ENTRADA PARA LA DIRECCION-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevaDireccion" name="nuevaDireccion" placeholder="Ingrese la Direccion">

              </div>

            </div>

            <!--ENTRADA PARA LA SOLICITUD-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevaSolicitud" name="nuevaSolicitud" placeholder="Ingrese El producto solicitado">

              </div>

            </div>

            <!--ENTRADA PARA LA TELEFONO-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoTelefonoPedido" name="nuevoTelefonoPedido" placeholder="Ingrese el téfono">

              </div>

            </div>

            <!--ENTRADA PARA EL ESTADO DE SOLICITUD-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoEstadoSolicitud" name="nuevoEstadoSolicitud" placeholder="Ingrese el estado del pedido">

              </div>

            </div>

            <!--ENTRADA PARA EL ESTADO DE SOLICITUD-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevaDesripcionPedido" name="nuevaDescripcionPedido" placeholder="Ingrese el estado del pedido">

              </div>

            </div>
        

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagenPedidoPieza" name="nuevaImagenPedidoPieza">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>

      <?php

        $crearPedidoPieza = new ControladorPedidosPiezas();
        $crearPedidoPieza -> ctrCrearPedidoPieza();

      ?>
      

    </div>

  </div>

</div>

<!--=====================================
EDITAR PEDIDO DE Pieza
======================================-->
<div id="modalEditarPedidoPieza" class="modal fade" role="dialog" >
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Editar Pedido de Piezas</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card-body">  

          <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNombrePieza" id="editarNombrePieza" placeholder="Nombre del Solicitante" required>

                <input type="text" class="form-control input-lg" name="idPedidoPieza" id="idPedidoPieza" placeholder="Nombre del Solicitante" required hidden>

              </div>  

            </div>  

            <!--ENTRADA PARA LA DIRECCION-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDireccionPieza" name="editarDireccionPieza" placeholder="Ingrese la Direccion">

              </div>

            </div>

            <!--ENTRADA PARA LA SOLICITUD-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarSolicitudPieza" name="editarSolicitudPieza" placeholder="Ingrese El producto solicitado">

              </div>

            </div>

            <!--ENTRADA PARA LA TELEFONO-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" id="editarTelefonoPedidoPieza" name="editarTelefonoPedidoPieza" placeholder="Ingrese el téfono">

              </div>

            </div>

            <!--ENTRADA PARA EL ESTADO DE SOLICITUD-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarEstadoSolicitudPieza" name="editarEstadoSolicitudPieza" placeholder="Ingrese el estado del pedido">

              </div>

            </div>

            <!--ENTRADA PARA EL ESTADO DE SOLICITUD-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcionPedidoPieza" name="editarDescripcionPedidoPieza" placeholder="Ingrese la descripcion">

              </div>

            </div>
        

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">


              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActualPedidosPieza" id="imagenActualPedidosPieza">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>

      <?php

        $editarPedidoPieza = new ControladorPedidosPiezas();
        $editarPedidoPieza -> ctreditarPedidoPieza();

      ?>
      

    </div>

  </div>

</div>

<?php

  $borrarPedidoPieza = new ControladorPedidosPiezas();
  $borrarPedidoPieza -> ctrBorrarPedidoPieza();

?>