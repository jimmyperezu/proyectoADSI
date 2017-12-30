<div class="form-inicio">

	<h1>EDITAR RUTA</h1>

	<form method="post">
		
		<?php  

		$editarRuta = new MvcControllerRuta();
		$editarRuta -> editarRutaController();
		$editarRuta -> actualizarRutaController();

		?>

	</form>

</div>