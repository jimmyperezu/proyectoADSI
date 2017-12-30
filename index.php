<!-- Enlaces a archivos CSS -->
<!--<meta charset="utf-8">-->
<link rel="stylesheet" href="views/css/inicio_sesion.css">
<link rel="stylesheet" href="views/css/tabla.css">
<link rel="stylesheet" href="views/css/template.css">
<link rel="stylesheet" href="views/css/navegacion_lateral.css">
<link rel="stylesheet" href="views/css/navegacion_superior.css">
<link rel="stylesheet" href="views/css/inicio.css">
<link rel="shortcut icon" href="views/images/ADSI.png">

<!-- Enlaces a archivos JAVASCRIPT -->
<script type="text/javascript" src="views/js/funciones.js"></script>

<?php

require_once "controllers/controller.php";
require_once "controllers/controller_usuario.php";
require_once "controllers/controller_agencia.php";
require_once "controllers/controller_cliente.php";
require_once "controllers/controller_horario.php";
require_once "controllers/controller_ruta.php";
require_once "controllers/controller_conductor.php";
require_once "controllers/controller_mercancia.php";
require_once "controllers/controller_asignacion.php";
require_once "controllers/controller_puestocontrol.php";
require_once "controllers/controller_vehiculo.php";
require_once "controllers/controller_presupuesto.php";
require_once "controllers/controller_flete.php";
require_once "controllers/controller_monitoreo.php";
require_once "controllers/controller_novedad.php";
require_once "controllers/funciones_controller.php";
require_once "models/enlaces.php";
require_once "models/crud_usuario.php";
require_once "models/crud_agencia.php";
require_once "models/crud_cliente.php";
require_once "models/crud_horario.php";
require_once "models/crud_ruta.php";
require_once "models/crud_conductor.php";
require_once "models/crud_mercancia.php";
require_once "models/crud_asignacion.php";
require_once "models/crud_puestocontrol.php";
require_once "models/crud_vehiculo.php";
require_once "models/crud_presupuesto.php";
require_once "models/crud_flete.php";
require_once "models/crud_monitoreo.php";
require_once "models/crud_novedad.php";
require_once "models/funciones_model.php";

$mvc = new MvcController();
$mvc -> plantilla();

?>