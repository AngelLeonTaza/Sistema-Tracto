<div class="content-wrapper">

  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrar Pedido de Otross</h1>
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

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPedidoOtro" style="margin-bottom: 20px;">

              Agregar Pedido de Otro

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

          $pedidoOtros = ControladorPedidosOtros::ctrMostrarPedidosOtros($item, $valor);

          foreach ($pedidoOtros as $key => $value) {
           
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
                          
                        <button class="btn btn-warning btnEditarPedidoOtro" idPedidoOtro="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPedidoOtro"><i class="fa fa-pen"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarPedidoOtro" idPedidoOtro="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
AGREAR PEDIDO DE Otro
======================================-->
<div id="modalAgregarPedidoOtro" class="modal fade" role="dialog" >
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Agregar Pedido de Otros</h4>

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

              <input type="file" class="nuevaImagenPedidoOtro" name="nuevaImagenPedidoOtro">

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

        $crearPedidoOtro = new ControladorPedidosOtros();
        $crearPedidoOtro -> ctrCrearPedidoOtro();

      ?>
      

    </div>

  </div>

</div>

<!--=====================================
EDITAR PEDIDO DE OTROS
======================================-->
<div id="modalEditarPedidoOtro" class="modal fade" role="dialog" >
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Editar Pedido de Otros</h4>

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

                <input type="text" class="form-control input-lg" name="editarNombreOtro" id="editarNombreOtro" placeholder="Nombre del Solicitante" required>

                <input type="text" class="form-control input-lg" name="idPedidoOtro" id="idPedidoOtro" placeholder="Nombre del Solicitante" required hidden>

              </div>  

            </div>  

            <!--ENTRADA PARA LA DIRECCION-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDireccionOtro" name="editarDireccionOtro" placeholder="Ingrese la Direccion">

              </div>

            </div>

            <!--ENTRADA PARA LA SOLICITUD-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarSolicitudOtro" name="editarSolicitudOtro" placeholder="Ingrese El producto solicitado">

              </div>

            </div>

            <!--ENTRADA PARA LA TELEFONO-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" id="editarTelefonoPedidoOtro" name="editarTelefonoPedidoOtro" placeholder="Ingrese el téfono">

              </div>

            </div>

            <!--ENTRADA PARA EL ESTADO DE SOLICITUD-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarEstadoSolicitudOtro" name="editarEstadoSolicitudOtro" placeholder="Ingrese el estado del pedido">

              </div>

            </div>

            <!--ENTRADA PARA EL ESTADO DE SOLICITUD-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcionPedidoOtro" name="editarDescripcionPedidoOtro" placeholder="Ingrese la descripcion">

              </div>

            </div>
        

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">


              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActualPedidosOtro" id="imagenActualPedidosOtro">

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

        $editarPedidoOtro = new ControladorPedidosOtros();
        $editarPedidoOtro -> ctreditarPedidoOtro();

      ?>
      

    </div>

  </div>

</div>

<?php

  $borrarPedidoOtro = new ControladorPedidosOtros();
  $borrarPedidoOtro -> ctrBorrarPedidoOtro();

?>