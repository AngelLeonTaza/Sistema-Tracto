<div class="content-wrapper">

  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrar Series</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Series</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">

        <div class="box">
          
          <div class="box-header with-border">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSerie" style="margin-bottom: 20px;">

              Agregar Serie

            </button>

          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablas tablaSeries" style="width:100%">
              
              <thead>
                
                <tr>
                  
                  <th style="width:10px">#</th>
                  <th>Series</th>
                  <th>Marcas</th>
                  <th>Acciones</th>

                </tr>

              </thead>

              <tbody>
                
                <?php

                  $item = null;
                  $valor = null;

                  $series = ControladorSeries::ctrMostrarSeries($item, $valor);

                  foreach ($series as $key => $value) {
                   
                    echo ' <tr>

                            <td>'.($key+1).'</td>

                            <td class="text-uppercase">'.$value["serie"].'</td>';

                            $item = "id";
                            $valor = $value["marca"];

                            $marca = ControladorMarcas::ctrMostrarMarcas($item, $valor);

                            echo '<td>'.$marca["marca"].'</td>


                            <td>

                              <div class="btn-group">
                                  
                                <button class="btn btn-warning btnEditarSerie" idSerie="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarSerie"><i class="fa fa-pen"></i></button>';

                                if($_SESSION["perfil"] == "Administrador"){

                                  echo '<button class="btn btn-danger btnEliminarSerie" idSerie="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
MODAL AGREGAR SERIE
======================================-->

<div id="modalAgregarSerie" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Agregar Serie</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group" style="margin-bottom: 20px;">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaSerie" placeholder="Ingresar Serie" required>

              </div>
            </div>


            <div class="form-group">
            
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-users"></i></span> 

                <select class="js-example-basic-single" name="marcaSerie" style="width: 90%;">

                  <option value="">Selecionar Marca</option>

                  <?php

                    $item = null;
                    $valor  = null;

                    $marcas = ControladorMarcas::ctrMostrarMarcas($item, $valor);

                    foreach ($marcas as $key => $value) {
                      
                      echo '<option value="'.$value["id"].'">'.$value["marca"].'</option>';

                    }

                  ?>
                </select>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Marca</button>

        </div>

       <?php

          $crearSerie = new ControladorSeries();
          $crearSerie -> ctrCrearSerie();

      ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarSerie" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Editar Serie</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarSerie" id="editarSerie" required>

                <input type="hidden"  name="idSerie" id="idSerie" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="editarMarcaSerie" name="editarMarcaSerie" value="" readonly>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      <?php

          $editarSerie = new ControladorSeries();
          $editarSerie -> ctrEditarSerie();

        ?> 

      </form>

      

    </div>

  </div>

</div>

<?php

  $borrarSerie = new ControladorSeries();
  $borrarSerie -> ctrBorrarSerie();

?>