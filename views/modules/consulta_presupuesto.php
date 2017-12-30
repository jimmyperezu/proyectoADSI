<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$presupuesto = new MvcControllerPresupuesto();
$presupuesto -> borrarPresupuestoController();

?>

<div class="tabla">

	<h1>PRESUPUESTO</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Id.</th>
				<th>Asignación</th>
				<th>Vehículo</th>
				<th>Ruta</th>
				<th>Valor</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			$presupuesto -> vistaPresupuestosController();

			?>

		</tbody>
	</table>

	

</div>