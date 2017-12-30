<div class="form-inicio">

	<h1>EDITAR PUESTO CONTROL</h1>

	<form method="post">
		
		<?php  

		$editarPtoCtrl = new MvcControllerPuestoControl();
		$editarPtoCtrl -> editarPuestoControlController();
		$editarPtoCtrl -> actualizarPuestoControlController();

		?>

	</form>



</div>