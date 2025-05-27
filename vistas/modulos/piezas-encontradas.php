<div class="content-wrapper">

  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrar Piezas Encontradas</h1>
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

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPiezaEncontrada" style="margin-bottom: 20px;">

              Agregar Pieza Encontrada

            </button>

          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablas tablaSeries" style="width:100%">
              
              <thead>
                
                <tr>
                  <th style="width:10px"> # </th>
                  <th> Nombre Encargado </th>
                  <th> Nombre del Producto </th>
                  <th> Precio </th>
                  <th> Foto del Producto </th>
                  <th> Direccion </th>
                  <th> Numero de Telefono </th>
                  <th> Fecha Encontrada </th>             
                  <th> Acciones </th>
                </tr>

              </thead>

              <tbody>

                <?php

                $item = null;
                $valor = null;

                $piezasEncontradas = ControladorPiezasEncontradas::ctrMostrarPiezasEncontradas($item, $valor);

                foreach ($piezasEncontradas as $key => $value) {
           
                echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nombre_encargado"].'</td>

                    <td class="text-uppercase">'.$value["nombre_pieza"].'</td>

                    <td class="text-uppercase">'.$value["precio"].'</td>

                     <td class="text-uppercase">'.$value["foto"].'</td> 

                    <td class="text-uppercase">'.$value["direccion"].'</td>

                    <td class="text-uppercase">'.$value["telefono"].'</td>

                   
                    

                    

                    <td class="text-uppercase">'.$value["fecha_encontrada"].'</td>


                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarMarca" idMarca="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPiezaEncontrada"><i class="fa fa-pen"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarPiezaEncontrada" idMarca="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
MODAL AGREGAR PIEZA ENCONTRADA
======================================-->

<div id="modalAgregarPiezaEncontrada" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Agregar Pieza Encontrada</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE ENCARGADO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombreEncargado" id="nuevoNombreEncargado" placeholder="Ingrese el nombre del encargado" required>
              </div>

            </div>
            <!--Nombre Producto-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoNombrePieza" name="nuevoNombrePieza" value="" placeholder="Ingrese el nombre del Producto">

              </div>

            </div>

            <!-- Precio -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoPrecioPieza" name="nuevoPrecioPieza" value="" placeholder="Ingerse el precio de la pieza">

              </div>
            </div>
            <!--Foto Producto-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevaFotoPieza" name="nuevaFotoPieza" value="" placeholder="Foto del Producto">

              </div>

            </div>

            <!-- Direccion -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevaDireccionPieza" name="nuevaDireccionPieza" value="" placeholder="Direccion de la pieza">

              </div>
              
            </div>

            <!-- Telefono -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoTelefonoPieza" name="nuevoTelefonoPieza" value="" placeholder="Ingerse el telefono del encargado">

              </div>
              
            </div>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Pieza</button>

        </div>

      </form>

      <?php

        $crearPiezaEncontrada = new ControladorPiezasEncontradas();
        $crearPiezaEncontrada -> ctrCrearPiezaEncontrada();

      ?>

    </div>

  </div>

</div>
