<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$monitoreo = new MvcControllerMonitoreo();
$monitoreo -> borrarMonitoreoController();

?>

<div class="tabla">

	<h1>MONITOREO</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Asignación</th>
				<th>Puesto control</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Estado</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			
			$monitoreo -> vistaMonitoreosController();

			?>

		</tbody>
	</table>

	

</div>