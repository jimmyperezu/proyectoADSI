<div class="form-inicio">

	<h1>EDITAR VEHÍCULO</h1>

	<form method="post">
		
		<?php  

		$editarVehiculo = new MvcControllerVehiculo();
		$editarVehiculo -> editarVehiculoController();
		$editarVehiculo -> actualizarVehiculoController();

		?>

	</form>



</div>