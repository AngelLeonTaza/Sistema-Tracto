<div class="content-wrapper">

	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrar Productos <span style="font-size: 20px; font-weight: 100;">Panel de Productos</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Productos</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">

      <div class="box">
        <div class="box-header with-border">

          <button class="btn btn-primary btnAgregarProductoCodigo" data-toggle="modal" data-target="#modalAgregarProducto" style="margin-bottom: 20px;">

              Agregar Producto

            </button>

        </div>

        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablaProductos" style="width:100%">
            <thead>
              
              <tr>
                
                <th style="width: 10px;">#</th>
                <th>Imagen</th>
                <th>Código</th>
                <th>Nómbre</th>
                <th>Ubicacion</th>
                <th>Marca</th>
                <th>Serie</th>
                <th>Parte</th>
                <th>Stock</th>
                <th>Código Mundial</th>
                <th>Precio de compra</th>
                <th>Precio de venta</th>
                <th>Acciones</th>
                <th>Código Alternativo</th>
                <th>Compatibilidades</th>
                <th>Descripción</th>
                
              </tr>

            </thead>

          </table>

        </div>

      </div>

    </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog" >
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card-body">            

            <!-- ENTRADA PARA SELECCIONAR SERIE -->

            <div class="form-group row">

               <!-- ENTRADA PARA SELECCIONAR MARCA -->

              <div class="col-xs-12 col-sm-6">

                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-th"></i></span> 

                    <select class="form-control input-lg" id="nuevaMarca" name="nuevaMarca" required>
                      
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

              <div class="col-xs-12 col-sm-6">
                  <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg" id="nuevaSerie" name="nuevaSerie" required>
                    
                    <option value="">Selecionar Serie</option>
    
                  </select>

                </div>
              </div>
              

            </div>

            <div class="form-group row">
              
              <!-- ENTRADA PARA SELECCIONAR PARTE -->
              <div class="col-xs-12 col-sm-6">

                  <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg" id="nuevaParte" name="nuevaParte" required>
                    
                    <option value="">Selecionar Parte</option>

                    <option value="Motor">Motor</option>
                    <option value="Hidraulica">Hidraulica</option>
                    <option value="Delantera">Delantera</option>
                    <option value="Tractor">Tractor</option>
                    <option value="Direccion">Direccion</option>
                    <option value="Frenos">Frenos</option>
                    <option value="Embrague">Embrague</option>
                    <option value="Caja">Caja</option>
                    <option value="Accesorios y Laterias">Accesorios y Laterias</option>
                    <option value="Transmisión">Transmisión</option>
                    <option value="Piernas posteriores">Piernas posteriores</option>
                    <option value="Varios">Varios</option>





                  </select>

                </div>

              </div>

              <div class="col-xs-12 col-sm-6">
                
                <!-- ENTRADA PARA EL CÓDIGO -->
                  
                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-barcode"></i></span> 

                    <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" readonly required>

                  </div>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" required>

              </div>

            </div>  

             <!-- ENTRADA PARA LAS COMPATIBILIDADES -->

            <div class="form-group">


              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCompatibilidad" placeholder="Ingresar Compatibilidades">

              </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO MUNDIAL -->

            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-product-hunt"></i></span> 

                  <input type="text" class="form-control input-lg" name="nuevoCodigoMundial" placeholder="Ingresar Código Mundial">

                </div>
              </div>
              <!-- ENTRADA PARA EL CODIGO ALTERNATIVO -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-product-hunt"></i></span> 

                  <input type="text" class="form-control input-lg" name="nuevoCodigoAlternativo" placeholder="Ingresar Código Alternativo">

                </div>
              </div>

                

            </div>

            

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-align-justify"></i></span> 

                <textarea type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" ></textarea>

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group row">
              
              <div class="col-xs-12 col-sm-6">
                  <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-check"></i></span> 

                  <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

                </div>
              </div>
              <!-- ENTRADA PARA LA UBICACION -->
              <div class="col-xs-12 col-sm-6">
                  <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-location-arrow"></i></span> 

                  <input type="text" class="form-control input-lg" name="nuevaUbicacion" placeholder="Ingresar Ubicacion" required>

                </div>
              </div>


            </div>

            

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>

                  </div>

                </div>



                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" id="nuevaImagen" class="nuevaImagen" name="nuevaImagen">

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

          $crearProducto = new ControladorProductos();
          $crearProducto -> ctrCrearProducto();

        ?>  


    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">EDITAR PRODUCTO</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card-body">


            <!-- ENTRADA PARA SELECCIONAR MARCA -->

            <div class="form-group">

              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" name="editarMarca" readonly required>
                  
                  <option id="editarMarca"></option>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SERIE -->

            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">
                  <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-th"></i></span> 

                  <input type="text" class="form-control input-lg" id="editarSerie" name="editarSerie" readonly >

                </div>
              </div>
              <!-- ENTRADA PARA SELECCIONAR PARTE -->
              <div class="col-xs-12 col-sm-6">
                  <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-th"></i></span> 

                  <input type="text" class="form-control input-lg" id="editarParte" name="editarParte">

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-barcode"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" required>

              </div>

            </div>

             <!-- ENTRADA PARA LAS COMPATIBILIDADES -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCompatibilidad" id="editarCompatibilidad" >

              </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO MUNDIAL -->

            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-product-hunt"></i></span> 

                  <input type="text" class="form-control input-lg" id="editarCodigoMundial" name="editarCodigoMundial" >

                </div>
              </div>
              <!-- ENTRADA PARA EL CODIGO ALTERNATIVO -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-product-hunt"></i></span> 

                  <input type="text" class="form-control input-lg" id="editarCodigoAlternativo" name="editarCodigoAlternativo">

                </div>
              </div>

                

            </div>

            

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-align-justify"></i></span> 

                <textarea type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" ></textarea>

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group row">
              
              <div class="col-xs-12 col-sm-6">
                  <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-check"></i></span> 

                  <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

                </div>
              </div>
              <!-- ENTRADA PARA LA UBICACION -->
              <div class="col-xs-12 col-sm-6">
                  <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-location-arrow"></i></span> 

                  <input type="text" class="form-control input-lg" id="editarUbicacion" name="editarUbicacion"required>

                </div>
              </div>


            </div>

            

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any" required>

                  </div>

                </div>



                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any" required>

                  </div>
                

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="editarImagen" name="editarImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" id="imagenActual">

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

          $editarProducto = new ControladorProductos();
          $editarProducto -> ctrEditarProducto();

        ?> 

    </div>

  </div>

</div>

<!--VER PRODUCTO-->

<div id="modalVerProducto" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->
            <div class="modal-header" style="background: #3c8dbc; color: white">
                <h4 class="modal-title"> VER PRODUCTO</h4>
            </div>

            <!-- CUERPO DEL MODAL -->
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="row">
                        <!-- FOTO DEL PRODUCTO -->
                        <div class="col-md-4 text-center">
                            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100%">
                        </div>

                        <!-- DATOS DEL PRODUCTO -->
                        <div class="col">
                              
                          <h2 class="text-center mb-3" id="verNombre"></h2>

                          <div class="row container">
                            
                            <div class="col" >
                              
                              <h6 id="verMarca"></h6>

                            </div>
                            
                            <div class="col text-left" style="text-transform: uppercase;">
                              
                              <h6 id="verSerie"></h6>

                            </div>
                          

                          </div>

                          <div class="row container">
                            
                            <div class="col" style="text-transform: uppercase;">
                              
                              <h6 id="verParte"></h6>

                            </div>

                            <div class="col text-left" style="text-transform: uppercase;">
                              
                              <h6 id="verCompatibilidad"></h6>

                            </div>

                          </div>

                          <div class="row container">
                            
                            <div class="col">

                              <h6 id="verCodigoMundial" >  </h6>

                            </div>

                            <div class="col text-left">

                              <h6 id="verCodigoAlternativo"></h6>
                            </div>

                          </div>

                          <div class="row container">
                            
                            <div class="col" >

                              <h6 id="verCodigoTienda"></h6>
                            </div>

                            <div class="col text-left" >

                              <h6 id="verUbicacion"></h6>
                            </div>

                          </div>

                          <div class="row container">
                            
                            <div class="col" >

                              <h6 id="verCodigoTienda"></h6>
                            </div>

                            <div class="col" >

                              <h6 id="verUbicacion"></h6>
                            </div>

                          </div>

                          <div class="row container">
                            
                            <div class="col" >

                              <h6 id="verPrecioVenta"></h6>
                            </div>

                            <div class="col" >

                              <h6 id="verStock"></h6>
                            </div>

                          </div>

                          <div class="row container">
                            
                            <div class="col" >
                              
                              <h6 id="verDescripcion"></h6>

                            </div>

                          </div>
                          

                        </div>

                    </div>

                </div>
            </div>

            <!-- PIE DEL MODAL -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>

        </div>
    </div>
</div>


<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

?>      