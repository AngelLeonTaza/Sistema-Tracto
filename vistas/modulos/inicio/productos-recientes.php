<?php

$item = null;
$valor = null;
$orden = "id";

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

 ?>


<div class="card card-success">

  <div class="card-header border-bottom-0">

    <h3 class="card-title">Últimos productos agregados</h3>

    <div class="card-tools pull-right">

      <button type="button" class="btn btn-card-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

      <button type="button" class="btn btn-card-tool" data-widget="remove">

        <i class="fa fa-times"></i>

      </button>

    </div>

  </div>
  
  <div class="card-body">

    <ul class="products-list product-list-in-card">

    <?php

    for($i = 0; $i < 10; $i++){

      echo '<li class="item">

        <div class="product-img">

          <img src="'.$productos[$i]["imagen_producto"].'" alt="Product Image">

        </div>

        <div class="product-info">

          <a href="" class="product-title" style="color:black">

            '.$productos[$i]["nombre_producto"].'

            <span class="badge badge-warning float-right">S/.'.$productos[$i]["precio_venta"].'</span>

          </a>
    
       </div>

      </li>';

    }

    ?>

    </ul>

  </div>

  <div class="card-footer text-center">

    <a href="productos" class="uppercase">Ver todos los productos</a>
  
  </div>

</div>
