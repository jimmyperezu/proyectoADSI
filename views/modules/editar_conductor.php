<div class="form-inicio">

	<h1>EDITAR CONDUCTOR</h1>

	<form method="post">
		
		<?php  

		$editarConductor = new MvcControllerConductor();
		$editarConductor -> editarConductorController();
		$editarConductor -> actualizarConductorController();

		?>

	</form>



</div>