<header >
	
	<!-- ====
		NAVBAR
	==== -->

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!--Navbar Lado Derecho -->



    <div class="navbar-nav ml-auto">
      
    </div>

    <div class="navbar-custom-menu">
        
      <ul class="nav navbar-nav" style="margin-right: 30px;">
        
        <li class="dropdown user user-menu">
          
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">

             <?php

              if ($_SESSION["foto"] != "") {

                echo '<img src="'.$_SESSION["foto"].'" style="height: 40px; padding-right: 20px;">';
                // code...
              } else{

                echo '<img src="vistas/img/usuarios/default/anonymous.png" style="height: 40px; padding-right: 20px;">';

              }

            ?>
          
            

            <span class="hidden-xs"> <?php echo $_SESSION["nombre"]; ?> </span>

          </a>

          <!-- Dropdown-toggle -->

          <ul class="dropdown-menu">
            
            <li class="user-body">
              
              <div class="pull-right">
                
                <a href="salir" class="btn btn-default btn-flat">Salir</a>

              </div>

            </li>

          </ul>

        </li>

      </ul>

    </div>

  </nav>

</header>