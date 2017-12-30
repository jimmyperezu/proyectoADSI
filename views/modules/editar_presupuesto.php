<div class="form-inicio">

	<h1>EDITAR PRESUPUESTO</h1>

	<form method="post">
		
		<?php  

		$editarPresupuesto = new MvcControllerPresupuesto();
		$editarPresupuesto -> editarPresupuestoController();
		$editarPresupuesto -> actualizarPresupuestoController();

		?>

	</form>



</div>