<div class="form-inicio">

	<h1>EDITAR FLETE</h1>

	<form method="post">
		
		<?php  

		$editarFlete = new MvcControllerFlete();
		$editarFlete -> editarFleteController();
		$editarFlete -> actualizarFleteController();

		?>

	</form>



</div>