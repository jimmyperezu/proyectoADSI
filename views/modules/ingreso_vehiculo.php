<?php  

$vehiculo = new MvcControllerVehiculo();
$vehiculo -> ingresoVehiculoController();

if(isset($_GET["action"])){
	if($_GET["action"] == "i_vehiculo"){
		$resultado = '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR VEHÍCULO</h1>

	<form method="post">

		<label>Placa</label>
		
		<input type="text" name="placaVehiculo" required>

		<label>Conductor</label>

		<select name="idConductorVehiculo" required>

			<option value="" disabled selected>Selecciona el conductor</option>

			<?php  
				
				$datos = $vehiculo -> cargarSelectController("conductor", "id_ctor");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["id_ctor"];
					echo "</option>";
				}
				
			?>
		</select>

		<label>Agencia</label>

		<select name="agenciaVehiculo" required>

			<option value="" disabled selected>Selecciona la agencia</option>

			<?php  
				
				$datos = $vehiculo -> cargarSelectController("agencia", "agcia_mcpio");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["agcia_mcpio"];
					echo "</option>";
				}
				
			?>
		</select>

		<label>Tipo de contrato</label>

		<select name="tipoContratoVehiculo" required>
			<option value="" disabled selected>Selecciona el tipo de contrato</option>
		    <option value="Flota Propia">Flota Propia</option>
		    <option value="Tercero">Tercero</option>
		</select>

		<label>Modelo</label>

		<input type="text" name="modeloVehiculo" required>

		<label>Marca</label>

		<select name="marcaVehiculo" required>
			<option value="" disabled selected>Selecciona la marca</option>
		    <option value="CHEVROLET">CHEVROLET</option>
		    <option value="HINO">HINO</option>
		    <option value="KENWORTH">KENWORTH</option>
		</select>

		<input type="submit" value="Enviar">

	</form>

	<?php  

	echo $resultado;

	?>

</div>