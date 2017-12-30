<?php  

$presupuesto = new MvcControllerPresupuesto();
$presupuesto -> ingresoPresupuestoController();

if(isset($_GET["action"])){
	if($_GET["action"] == "i_presupuesto"){
		$resultado = '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR PRESUPUESTO</h1>

	<form method="post">
		
		<label>Asignación</label>

		<select name="idAsigPresupuesto" required>

			<option value="" disabled selected>Selecciona la asignación</option>

			<?php  
				
				$datos = $presupuesto -> cargarSelectController("asignacion", "id_asi");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["id_asi"];
					echo "</option>";
				}
				
			?>
		</select>

		<label>Vehículo</label>

		<select name="placaVehPresupuesto" required>

			<option value="" disabled selected>Selecciona el vehículo</option>

			<?php  
				
				$datos = $presupuesto -> cargarSelectController("vehiculo", "id_veh");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["id_veh"];
					echo "</option>";
				}
				
			?>
		</select>

		<label>Ruta</label>

		<select name="rutaPresupuesto" required>

			<option value="" disabled selected>Selecciona la ruta</option>

			<?php  
				
				$datos = $presupuesto -> cargarSelectController("ruta", "rut_origen_destino");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["rut_origen_destino"];
					echo "</option>";
				}
				
			?>
		</select>

		<label>Valor</label>

		<input type="text" name="valorPresupuesto" required>

		<input type="submit" value="Enviar">

	</form>

	<?php  

	echo $resultado;

	?>

</div>