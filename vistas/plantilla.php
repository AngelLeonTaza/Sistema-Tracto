<?php

  session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sistema de Ventas Tractoleo</title>


  <!-- PLUGGINS DE CSS --!>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="vistas/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="vistas/plugins/summernote/summernote-bs4.min.css">

    <!-- DataTables -->

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <link rel="stylesheet" href="
  https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css
  ">


  <!--SELECT2-->
  

  <!--MORRIS-->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


  <!-- PLUGGINS DE JS --!>


  <!--CHART-->
  <script src="vistas/plugins/chart.js/Chart.min.js"></script>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="vistas/plugins/jquery/jquery.min.js"></script>

  <!-- jQuery UI 1.11.4 -->
  <script src="vistas/plugins/jquery-ui/jquery-ui.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Sparkline -->
  <script src="vistas/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="vistas/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="vistas/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="vistas/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="vistas/plugins/moment/moment.min.js"></script>
  <script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="vistas/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.js"></script>

  <!-- DataTables  & Plugins -->

  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

  

  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>


  <!-- DataTables Responsive JS -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

  <!--select2-->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <link rel="icon" href="vistas/img/plantillas/logo_sin_fondo.ico" type="image/x-icon">

  </head>

  

  <!-- Jquery Number-->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>




  <body class="hold-transition sidebar-mini sidebar-collapse">
  <!-- Site wrapper -->
  <?PHP

  

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){




  echo '<div class="wrapper">';

  //Main Nav

  include "modulos/cabezote.php";

  //Menu Sidebar

  include "modulos/menu.php";

  //Contenido

  if(isset($_GET["ruta"])){

    if($_GET["ruta"] == "inicio" ||
       $_GET["ruta"] == "usuarios" ||
       $_GET["ruta"] == "marcas" ||
       $_GET["ruta"] == "series" ||
       $_GET["ruta"] == "partes" ||
       $_GET["ruta"] == "productos" ||
       $_GET["ruta"] == "piezas-encontradas" ||
       $_GET["ruta"] == "pedidos-tractores" ||
       $_GET["ruta"] == "pedidos-implementos" ||
       $_GET["ruta"] == "pedidos-piezas" ||
       $_GET["ruta"] == "pedidos-otros" ||
       $_GET["ruta"] == "clientes" ||
       $_GET["ruta"] == "ventas" ||
       $_GET["ruta"] == "ver-venta-anticipo" ||       
       $_GET["ruta"] == "editar-venta" ||
       $_GET["ruta"] == "crear-venta" ||
       $_GET["ruta"] == "reportes" ||
       $_GET["ruta"] == "salir") {

      include "modulos/".$_GET["ruta"].".php";

    } else{

      include "modulos/404.php";

    }

  }else{
    include "modulos/inicio.php";
  }

  

  //Footer

  include "modulos/footer.php";

  echo '</div>';

 
  } else{
    include "modulos/login.php"; 
  }

  ?>

  <script src="vistas/js/productos.js"></script>
  <script src="vistas/js/plantillas.js"></script>
  <script src="vistas/js/reportes.js"></script>
  <script src="vistas/js/clientes.js"></script>
  <script src="vistas/js/usuarios.js"></script>
  <script src="vistas/js/ventas.js"></script>
  <script src="vistas/js/marcas.js"></script>
  <script src="vistas/js/series.js"></script>
  <script src="vistas/js/pedidostractores.js"></script>
  <script src="vistas/js/pedidosimplementos.js"></script>
  <script src="vistas/js/pedidospiezas.js"></script>
  <script src="vistas/js/pedidosotros.js"></script>



</body>
</html>
