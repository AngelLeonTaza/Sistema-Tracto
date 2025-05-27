<?php
require_once "../../controladores/ventas.controlador.php";
require_once "../../controladores/productos.controlador.php";
require_once "../../controladores/clientes.controlador.php";
require_once "../../controladores/usuarios.controlador.php";

require_once "../../modelos/usuarios.modelo.php";
require_once "../../modelos/ventas.modelo.php";
require_once "../../modelos/productos.modelo.php";
require_once "../../modelos/clientes.modelo.php";

$item = "id";
$valor = $_GET["idVenta"];
$valorSerieComprobante = $_GET["idVenta"];

$venta = ControladorVentas::ctrMostrarVentas($item, $valor);

$ventaActual = $venta["codigo"];

$itemUsuario = "id";
$valorUsuario = $venta["id_vendedor"];

$vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

$itemCliente = "id";
$valorCliente = $venta["id_cliente"];

$cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

$serieComprobante = mostrarSerieComprobante($valorSerieComprobante);

?>

<div class="form-group">
                  
        <div class="input-group">
            
        <span class="input-group-text"><i class="fa fa-users"></i></span>

        <input name="clienteAnticipo" class="form-control" value="<?php echo $serieComprobante.'-'.$venta["codigo"] ?>"  placeholder="Nombre del cliente" readonly>
        
            
    </div>
</div>

<div class="input-group mb-3">

            <span class="input-group-text"> <strong>CLIENTE</strong> </span>

            <input type="text" class="form-control" value="<?php echo $cliente["nombre_cliente"] ?>"  placeholder="Nombre del cliente" readonly>

            <input type="hidden" name="clienteAnticipo" class="form-control" value="<?php echo $cliente["id"] ?>"  placeholder="Nombre del cliente" readonly>            
</div>

<div class="input-group mb-3">

            <span class="input-group-text"><strong>VENDEDOR</strong></span>

            <input class="form-control" value="<?php echo $vendedor["nombre"] ?>"  placeholder="Nombre del cliente" readonly>

            <input type="hidden" name="idVendedorAnticipo" id="idVendedorAnticipo" value="<?php echo $vendedor["id"];?>">
</div>

<div class="form-group">

            <label>LISTA DE PAGOS:</label>

            <?php

                echo '<div class="row">
                    <input type="text" class="form-control col-sm-8" value="'.$serieComprobante." - ".$ventaActual.'" placeholder="Nombre del cliente" readonly>
                    <input type="text" class="form-control col-sm-2" value="S/.'.$venta["anticipo"].'.00" readonly>

                    <div class="btn-group col-sm-1">
                            <a class="btn btn-success" href="index.php?ruta=ventas&xml='.$venta["codigo"].'">xml</a>

                            <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$venta["codigo"].'">
                                <i class="fa fa-print"></i>
                            </button>
                        </div>
                    </div>';

                $item = null;
                $valor = null;  
                $contadorPagosAnticipos = 0;
                $contadorPagoInicial = $venta["anticipo"];
                $contadorPagoUnico = 0;
                
               

                $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                foreach ($ventas as $key => $value) {

                if($value["pagos"] == $_GET["idVenta"]){
                    if($value["codigo"] == $ventaActual){

                        if($value["tipo_anticipo"] === 'S.A.'){

                            echo'<div class="row">

                                <input type="text" class="form-control col-sm-8" value="'.$serieComprobante." - ".$value["codigo"].'" readonly>
                                
                                <input type="text" class="form-control col-sm-2" value="S/.'.$value["total"].'.00" readonly>
    
                                <div class="btn-group col-sm-1">
                                    <a class="btn btn-success" href="index.php?ruta=ventas&xml='.$value["codigo"].'">xml</a>
            
                                    <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">
                                        <i class="fa fa-print"></i>
                                    </button>
                                </div>
                            </div>';
    
                            $contadorPagoUnico += $venta["total"];
                          } else {

    
                            echo'<div class="row">
                            <input type="text" class="form-control col-sm-8" value="'.$serieComprobante." - ".$value["codigo"].'" placeholder="Nombre del cliente" readonly>
                            <input type="text" class="form-control col-sm-2" value="S/.'.$value["anticipo"].'.00" readonly>
                            <div class="btn-group col-sm-1">
                                <a class="btn btn-success" href="index.php?ruta=ventas&xml='.$value["codigo"].'">xml</a>
        
                                <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">
                                    <i class="fa fa-print"></i>
                                </button>
                            </div>
                        </div>';
    
                        $contadorPagoInicial += $venta["anticipo"];
                      }
                    

                    } else{

                    $contadorPagosAnticipos += $value["total"];

                        echo '<div class="row">
                        <input type="text" class="form-control col-sm-8" value="'.$serieComprobante." - ".$value["codigo"].'" placeholder="Nombre del cliente" readonly>
                        <input type="text" class="form-control col-sm-2" value="S/.'.$value["total"].'.00" readonly>
                        <div class="btn-group col-sm-1">
                            <a class="btn btn-success" href="index.php?ruta=ventas&xml='.$value["codigo"].'">xml</a>

                            <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">
                                <i class="fa fa-print"></i>
                            </button>
                        </div>
                    </div>';}
                    }
            }

            $contadorPagos = $contadorPagoInicial + $contadorPagosAnticipos + $contadorPagoUnico;
            ?>          

</div>

<div class="form-group">

            <label>PRODUCTOS:</label>
            <?php

                $listaProducto = json_decode($venta["productos"], true);


                foreach ($listaProducto as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  echo '<div class="row"> <input type="text" class="form-control col-sm-10" value="'.$value["nombre_producto"].'" placeholder="Nombre del cliente" readonly> <input type="text" class="form-control col-sm-2" value="'.$value["precio"].'" readonly> 
                  </div>';
                
                }

            ?>
             
            <textarea name="listaProductosAnticipo"  id="listaProductosAnticipo" style="display: none;">
                <?php echo $venta["productos"]; ?>
            </textarea>
  
</div>



<div class="form-group d-flex justify-content-center align-items-center">
    
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="float-right">
                    <div class="mb-6 text-right">
                    <!-- Detalles Pago 1 -->
                    <label class="ml-2">COSTE NETO DE LA VENTA: </label>

                    <input class="ml-2" type="text" value="S/.<?php echo $venta["neto"] ?>.00" readonly>

                    </div>
                    
                    <div class="mb-6 text-right">
                    <!-- Detalles Pago 1 -->
                    <label class="ml-2">IMPUESTO VENTA: </label>

                    <input class="ml-2" type="text" value="S/.<?php echo $venta["impuesto"] ?>.00" readonly>

                    </div>

                    <div class="mb-6 text-right">
                    <!-- Detalles Pago 1 -->
                    <label class="ml-2">COSTE TOTAL DE LA VENTA: </label>

                    <input class="ml-2" type="text" value="S/.<?php echo $venta["total"] ?>.00" readonly>

                    </div>


                    <div class="mb-6 text-right">
                    <!-- Detalles Pago 1 -->
                    <label class="ml-2">PAGADO INICIAL (ANTICIPO): </label>

                    <input class="ml-2" type="text" value="S/.<?php echo $venta["anticipo"] ?>.00" readonly>

                    </div>

                    <div class="mb-6 text-right">
                    <!-- Detalles Pago 1 -->
                    <label class="ml-2">TOTAL PAGADO: </label>

                    <input class="ml-2" type="text" pattern="[0-9]*" class="form-control input-lg" value="S/.<?php echo $contadorPagos?>.00" readonly >

                    </div>

                    <div class="mb-6 text-right">
                    <!-- Detalles Pago 1 -->
                    <label class="ml-2">DEUDA: </label>

                    <input class="ml-2" type="text" value="S/.<?php $deuda = $venta["total"] - $contadorPagos; echo $deuda ?>.00" readonly>

                    </div>

                    <!-- Otros detalles de pagos según la factura electrónica -->
                </div>
            </div>
        </div>
    </div>

</div>

