<div class="form-inicio">

	<h1>EDITAR MERCANCÍA</h1>

	<form method="post">
		
		<?php  

		$editarMercancia = new MvcControllerMercancia();
		$editarMercancia -> editarMercanciaController();
		$editarMercancia -> actualizarMercanciaController();

		?>

	</form>



</div>