<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="views/images/ADSI.png">
	<title>Administración</title>
</head>

<body class="cuerpo">

	<?php  

	if(!isset($_SESSION)){
		session_start();
	}

	$estado = false;

	if(isset($_SESSION["validar"])){
		$estado = true;
	}

	if($estado){ ?>
		
		<div class="superior">

			<?php include "modules/navegacion_superior.php"; ?>

		</div>

		<div class="lateral">

			<?php include "modules/navegacion_lateral.php"; ?>
	
		</div>

		<section class="contenido-cc">
			
			<?php

			$mvc = new MvcController();
			$mvc -> enlacesPaginasController();
			
			?>

		</section>

	<?php }else{ ?>

		<div class="superior">

			<?php include "modules/navegacion_superior.php"; ?>

		</div>

		<div class="lateral">

			<?php //include "modules/navegacion_lateral.php"; ?>
	
		</div>

		<section class="contenido-sc">
			
			<?php

			$mvc = new MvcController();
			$mvc -> enlacesPaginasController();
			
			?>
			
		</section>
		
	<?php } ?>

</body>
</html>