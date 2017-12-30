<?php  

$monitoreo = new MvcControllerMonitoreo();
$monitoreo -> ingresoMonitoreoController();

date_default_timezone_set('America/Lima');

if(isset($_GET["action"])){
	if($_GET["action"] == "i_monitoreo"){
		$resultado = '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR MONITOREO</h1>

	<form method="post">

		<label>Asignación</label>

		<select name="idAsigMonitoreo" required>

			<option value="" disabled selected>Selecciona la asignación</option>

			<?php  
				
				$datos = $monitoreo -> cargarSelectController("asignacion", "id_asi");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["id_asi"];
					echo "</option>";
				}
				
			?>
			
		</select>

		<label>Puesto de control</label>

		<select name="ptoCtrlMonitoreo" required>

			<option value="" disabled selected>Selecciona el puesto de control</option>

			<?php  
				
				$datos = $monitoreo -> cargarSelectController("puestocontrol", "pto_ctrl_mcpio");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["pto_ctrl_mcpio"];
					echo "</option>";
				}
				
			?>
		</select>

		<label>Fecha</label>

		<input type="date" name="fechaMonitoreo" value="<?php echo date("Y-m-d"); ?>" required/> 

		<label>Hora</label>

		<input type="time" name="horaMonitoreo" value="<?php echo date("H:i"); ?>" required>

		<label>Descripción</label>

		<select name="estadoMonitoreo" required>
		  <option value="Sin fallas">Sin fallas</option>
		  <option value="Sin fallas pero con retraso">Sin fallas pero con retraso</option>
		  <option value="Con fallas">Con fallas</option>
		</select>

		<input type="submit" value="Enviar">

	</form>

	<?php  

	echo $resultado;

	?>

</div>