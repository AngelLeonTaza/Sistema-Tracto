<aside class="sidebar-collapse main-sidebar sidebar-dark-primary ">
	
	<!-- Brand Logo -->
    <a href="inicio" class="brand-link">
      <img src="vistas\img\plantillas\logo_sin_fondo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><span style="color: #43A335; font-weight: 600;">TRACTO</span> <span style="color: #F6B034;font-weight: 600;">LEO</span></span>
    </a>

	<section class="sidebar">
		<!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="image">
          <?php

              if ($_SESSION["foto"] != "") {

                echo '<img src="'.$_SESSION["foto"].'"">';
                // code...
              } else{

                echo '<img src="vistas/img/usuarios/default/anonymous.png" ">';

              }

            ?>
        </div>


        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["nombre"]; ?></a>
        </div>
      </div>


      <nav class="mt-2">
      	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      		<li class="nav-item">
	            <a href="inicio" class="nav-link">
	              <i class="nav-icon fas fa-home"></i>
	              <p>
	                Inicio
	              </p>
	            </a>
	        </li> 

          <li class="nav-item">
              <a href="productos" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  Productos
                </p>
              </a>
          </li> 

          <li class="nav-item ">
              <a href="clientes" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Clientes
                </p>
              </a>
          </li>

          <li class="nav-item">
              <a href="marcas" class="nav-link">
                <i class="nav-icon fas fa-tractor"></i>
                <p>
                  Marcas
                    <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="marcas" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>  Marca </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="series" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Serie </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="partes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Partes </p>
                </a>
              </li>
            </ul>
          </li> 

          <li class="nav-item">
              <a href="pedidos-tractores" class="nav-link">
                <i class="nav-icon fas fa-tractor"></i>
                <p>
                  Pedidos
                    <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pedidos-tractores" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>  Pedido Tractores </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pedidos-implementos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Pedido de Implementos </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pedidos-piezas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Pedido de Piezas </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pedidos-otros" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Otros Pedidos </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
              <a href="piezas-encontradas" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  Piezas Encontradas
                </p>
              </a>
          </li> 

	        <li class="nav-item ">
	            <a href="usuarios" class="nav-link">
	              <i class="nav-icon fas fa-user"></i>
	              <p>
	                Usuarios
	              </p>
	            </a>
	        </li>

	        <li class="nav-item ">
            <a class="nav-link table-active">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="ventas" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Administrar Ventas </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crear-venta" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Crear Venta </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reportes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Resporte de Ventas</p>
                </a>
              </li>
            </ul>
          </li>
      	</ul>
      </nav>

	</section>

</aside>