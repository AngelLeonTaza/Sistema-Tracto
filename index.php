<?php


ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log",  "D:/xampp/htdocs/pos/php_error_log");

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/marcas.controlador.php";
require_once "controladores/series.controlador.php";
require_once "controladores/partes.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/piezas-encontradas.controlador.php";
require_once "controladores/pedidostractores.controlador.php";
require_once "controladores/pedidosimplementos.controlador.php";
require_once "controladores/pedidospiezas.controlador.php";
require_once "controladores/pedidosotros.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/marcas.modelo.php";
require_once "modelos/series.modelo.php";
require_once "modelos/partes.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/piezas-encontradas.modelo.php";
require_once "modelos/pedidostractores.modelo.php";
require_once "modelos/pedidosimplementos.modelo.php";
require_once "modelos/pedidospiezas.modelo.php";
require_once "modelos/pedidosotros.modelo.php";
require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
