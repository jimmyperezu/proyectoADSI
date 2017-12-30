<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$vehiculo = new MvcControllerVehiculo();
$vehiculo -> borrarVehiculoController();

?>

<div class="tabla">

	<h1>VEHÍCULO</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Placa</th>
				<th>Conductor</th>
				<th>Agencia</th>
				<th>Tipo contrato</th>
				<th>Modelo</th>
				<th>Marca</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			
			$vehiculo -> vistaVehiculosController();

			?>

		</tbody>
	</table>

	

</div>