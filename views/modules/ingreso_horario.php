<div class="form-inicio">

	<h1>INGRESAR HORARIO</h1>

	<form method="post">
		
		<label>Rango</label>

		<input type="text" name="rangoHorario" required>

		<input type="submit" value="Enviar">

	</form>

<?php  

$agencia = new MvcControllerHorario();
$agencia -> ingresoHorarioController();

if(isset($_GET["action"])){
	if($_GET["action"] == "i_horario"){
		echo '<br><br><p class="resultado">Ingreso exitoso</p>';
	}
}

?>

</div>