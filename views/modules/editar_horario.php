<div class="form-inicio">

	<h1>EDITAR HORARIO</h1>

	<form method="post">
		
		<?php  

		$editarHorario = new MvcControllerHorario();
		$editarHorario -> editarHorarioController();
		$editarHorario -> actualizarHorarioController();

		?>

	</form>

</div>