<?php  

$asignacion = new MvcControllerAsignacion();

date_default_timezone_set('America/Lima');

if(isset($_GET["action"])){
	if($_GET["action"] == "i_asignacion"){
		$resultado = '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR ASIGNACIÓN</h1>

	<form method="post">
		
		<label>Cliente</label>

		<select name="clienteAsig" required>

			<option value="" disabled selected>Selecciona el cliente</option>

			<?php  
				
				$datos = $asignacion -> cargarSelectController("cliente", "id_cli");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["id_cli"];
					echo "</option>";
				}
				
			?>
		</select>

		<label>Contenido mercancía</label>

		<select name="contenidoMercanciaAsig" required>

			<option value="" disabled selected>Selecciona el contenido de la mercancía</option>

			<?php  
				
				$datos = $asignacion -> cargarSelectController("mercancia", "mer_contenido");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo utf8_decode($item["mer_contenido"]);
					echo "</option>";
				}
				
			?>
		</select>

		<label>Agencia</label>

		<select name="municipioAgenciaAsig" required>

			<option value="" disabled selected>Selecciona la agencia</option>

			<?php  
				
				$datos = $asignacion -> cargarSelectController("agencia", "agcia_mcpio");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["agcia_mcpio"];
					echo "</option>";
				}
				
			?>
		</select>

		<label>Fecha registro</label>

		<input type="date" name="fechaRegistroAsig" value="<?php echo date("Y-m-d"); ?>" required/> 

		<label>Fecha entrega</label>

		<input type="date" name="fechaEntregaAsig" value="<?php echo date("Y-m-d"); ?>" required/> 

		<label>Estado</label>

		<select name="estadoAsig" required>
			<option value="" disabled selected>Selecciona el estado actual</option>
		    <option value="Entregado">Entregado</option>
		    <option value="En Proceso">En Proceso</option>
		</select>

		<input type="submit" value="Enviar">

	</form>

	<?php  

	$asignacion -> ingresoAsignacionController();

	echo $resultado;

	?>

</div>