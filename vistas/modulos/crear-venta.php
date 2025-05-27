<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">
  
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> CREAR VENTA </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="active">Crear venta</li>

            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">

    <div class="row">

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="card">

          <div class="card card-danger card-outline"></div>

          <div class="box-body" style="margin: 0px 10px;">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="card">
          
          <div class="card card-primary card-outline" ></div>

          <form role="form" method="post" class="formularioVenta" style="margin:0px 20px 10px 20px">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-text"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div> 

                  <!--=====================================
                  ENTRADA EL TIPO DE COMPROBANTE
                  ======================================-->

            
                  <div class="form-group">
                    
                    <div class="input-group">
                      
                      <span class="input-group-text"><i class="fa fa-users"></i></span>
                      
                      <select class="form-control" id="seleccionarComprobante" name="seleccionarComprobante" required>

                      <option value="">SELECCIONAR COMPROBANTE</option>
                      <option value="FACTURA">FACTURA</option>
                      <option value="BOLETA">BOLETA</option>
                      <option value="NOTAVENTA">NOTA DE VENTA</option>
                      <option value="COTIZACION">COTIZACION</option>

                      </select>
                      
                    
                    </div>
                  
                  </div>

                <div class="form-group">
                    
                    <div class="input-group">
                      
                      <span class="input-group-text"><i class="fa fa-users"></i></span>
                      
                      <select class="form-control" id="seleccionarTipoAnticipo" name="seleccionarTipoAnticipo" required>

                      <option value="">SELECCIONAR TIPO DE ANTICIPO</option>
                      <option value="S.A.">SIN ANTICIPO (VENTA NORMAL)</option>
                      <option value="A">  EMITIR CON ANTICIPO</option>
                      <option value="D.A."> EMITIR POR VENTA QUE DEDUCE DE ANTICIPO </option>

                      </select>
                      
                    
                    </div>
                  
                </div>

                 <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

              

                <div class="form-group">
                  
                  <div class="input-group verCodigo">
                    
                    
                    
                  </div>
                
                </div>
               

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

              <div class="form-group">
              
                  <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-map-marker"></i></span> 

                  <input type="text" class="form-control input-lg" id="buscarclientedeventa" name="buscarclientedeventa" placeholder="INGRESE DNI/RUC" required>

                  <span class="input-group-text"><button type="button" class="btnBuscarClienteSistema btn-default btn-xs" id="btnBuscarClienteSistema" data-toggle="modal"  data-dismiss="modal">BUSCAR CLIENTE</button></span>

                </div>
              </div>

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-text"><i class="fa fa-users"></i></span>
                    
                    <input type="text" class="form-control input-lg" id="clienteEncontrado" name="clienteEncontrado" placeholder="CLIENTE" readonly required>

                    <input type="text" id="seleccionarCliente" name="seleccionarCliente" readonly hidden required>
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">
                  
                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                  <div class="col">
                  <div class="card">
                      <div class="card-body">
                        <!-- Detalles de los pagos a la derecha -->
                        <div class="float-right">
                          <div class="mb-6 text-right">
                            <!-- Detalles Pago 1 -->
                            <label class="ml-2">OP. GRAVADAS: </label>
                            <input class="ml-2" type="text" class="form-control input-lg" id="nuevoSubTotalVista"   name="nuevoSubTotalVista" total="" placeholder="S/.000" 
                            total="" readonly >

                            <input class="ml-2" type="text" class="form-control input-lg" id="nuevoSubTotal"   name="nuevoSubTotal" total="" placeholder="S/.000" 
                            total="" hidden readonly>
                            <input type="hidden" name="totalVenta" id="totalVenta">
                          </div>
                          <div class="mb-6 text-right">
                            <!-- Detalles Pago 1 -->
                            <label class="ml-2">IGV 18%: </label>
                            <input class="ml-2" type="text" class="form-control input-lg" id="nuevoImpuestoVentaVista"   name="nuevoImpuestoVentaVista" placeholder="S/.000" readonly>

                            <input class="ml-2" type="text" class="form-control input-lg" id="nuevoImpuestoVenta"   name="nuevoImpuestoVenta" placeholder="S/.000" readonly hidden>

                          </div>

                          <div class="mb-6 text-right">
                            <!-- Detalles Pago 1 -->
                            <label class="ml-2">ANTICIPO: </label>
                            <input class="ml-2" type="text" class="form-control input-lg" id="nuevoAnticipo" name="nuevoAnticipo" placeholder="S/.000" onblur="sumarTotalPrecios()" required >

                          </div>

                          <div class="mb-6 text-right">
                            <!-- Detalles Pago 1 -->
                            <label class="ml-2">ISC: </label>
                            <input class="ml-2" type="text" class="form-control input-lg" id="nuevoISCVenta"   name="nuevoISCVenta" placeholder="S/.000" value="0.00" readonly required>                         
                          </div>
                          
                          <div class="mb-6 text-right">
                            <!-- Detalles Pago 1 -->
                            <label class="ml-2">OP.EXONERADAS: </label>
                            <input class="ml-2" type="text" class="form-control input-lg" id="nuevoExoneradoVenta"   name="nuevoExoneradoVenta" placeholder="S/.000" value="0.00" readonly required> 
                          </div>

                          <div class="mb-6 text-right costoTotalconAnticipo">
  
                          </div>

                          <div class="mb-3 text-right">
                            <!-- Detalles Pago 1 -->
                            <label class="ml-2" >IMPORTE TOTAL: </label>
                            <input class="ml-2" type="text" class="form-control input-lg" id="nuevoTotalFinalVenta"   name="nuevoTotalFinalVenta"placeholder="S/.000" readonly required>

                            <input type="hidden" name="nuevoTotalFinalVentaSA" id="nuevoTotalFinalVentaSA">
  
                          </div>

                          


                          <!-- Otros detalles de pagos según la factura electrónica -->
                        </div>
                      </div>

                  </div>

                  

                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  
                  <div class="col-xs-6" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value=""> Seleccione método de pago </option>
                        <option value="Efectivo"> Efectivo </option>
                        <option value="TC"> Tarjeta Crédito </option>
                        <option value="TD"> Tarjeta Débito </option>                  
                      </select>    

                    </div>

                  </div>

                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <div class="pull-right">

              <button type="text" id="btnGuardarVenta" class="btn btn-primary pull-right">Guardar venta</button>

            </div>

          </div>

        </form>

        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();
          
        ?>

        </div>
            
      </div>

    </div>
   
  </section>

</div>

<!-- Ventana Modal Dedude de anticipo-->
<div class="modal fade" id="modalDeduccionAnticipo" tabindex="-1" role="dialog" aria-labelledby="modalDeduccionAnticipo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    <form role="form" method="post">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel" >PAGO DE UNA VENTA CON ANTICIPO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
                  
             <div class="input-group">
                    
                <span class="input-group-text"><i class="fa fa-users"></i></span>
                    
                <select class="form-control seleccionarBoleta" id="seleccionarBoleta" name="seleccionarBoleta" required>

                <option value="">SELECCIONAR BOLETA VENTA</option>

                <?php
                  $item = null;
                  $valor = null;  

                  $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                  foreach ($ventas as $key => $value) {

                    if($value["tipo_anticipo"] == "A"){

                      if($value["tipo_comprobante"] == "FACTURA"){
                        echo '<option value="'.$value["id"].'"><td><strong>F001 - </strong>'.$value["codigo"].'</option>
                        ';
                      } else {
                        echo '<option value="'.$value["id"].'"><td><strong>B001 - </strong>'.$value["codigo"].'</option>
                        ';
                      }
                    }
                    
                  }
                ?>                  
                </select>

                <input type="hidden" id="idVenta" name="idVenta" value="">

                
                  
             </div>

        </div>

        

        <div class="form-group" id="idVentaContainer">

        </div>

      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Venta</button>

      </div>

    </form>
    <?php

        $pagarAnticipo = new ControladorVentas();
        $pagarAnticipo -> ctrPagarAnticipo();

      ?>

    </div>
  </div>
</div>



<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <button type="buttons" id="btnBuscarCliente"><i class="fa fa-search"></i></button>


      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" id="nuevoDNI" name="nuevoDNI"  placeholder="Ingresar DNI" required>

                </div>
              </div>

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                    


                </div>

              </div>
              
              

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoCliente" name="nuevoCliente"  placeholder="Ingresar nombre">

              </div>

            </div>

            

            <!-- ENTRADA PARA EL TELEFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(51) 999-999-999'" data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA EL PROCEDENCIA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-envelope"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaProcedencia" placeholder="Ingresa lugar de Procedencia">

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE CUMPLE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCumpleaños" placeholder="Ingresar fecha de nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask >

              </div>

            </div>

          </div>

          <!-- ENTRADA PARA EL TIPO DE CLIENTE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTipoCliente" placeholder="Ingresar el Tipo de Cliente">

              </div>

            </div>

          <!-- ENTRADA PARA LA DESCRIPCION L CLIENTE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-map-marker"></i></span> 

                <textarea type="text" class="form-control input-lg" name="nuevaDescripcionCliente" placeholder="Ingresar una corta descripcion del cliente"></textarea>
              </div>

            </div>


        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>