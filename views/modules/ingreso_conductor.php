<?php  

$conductor = new MvcControllerConductor();
$conductor -> ingresoConductorController();

if(isset($_GET["action"])){
	if($_GET["action"] == "i_conductor"){
		$resultado = '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR CONDUCTOR</h1>

	<form method="post">
		
		<label>Identificación</label>

		<input type="text" name="idConductorRegistro" required>

		<label>Tipo de documento</label>

		<select name="tipoConductorRegistro" required>
			<option value="" disabled selected>Selecciona el tipo de documento</option>
		    <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
		    <option value="Cédula de extranjería">Cédula de extranjería</option>
		    <option value="NIT">NIT</option>
		</select>

		<label>Agencia</label>

		<select name="agenciaConductorRegistro" required>

			<option value="" disabled selected>Selecciona la agencia</option>

			<?php  
				
				$datos = $conductor -> cargarSelectController("agencia", "agcia_mcpio");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["agcia_mcpio"];
					echo "</option>";
				}
				
			?>
		</select>

		<label>Tipo de contrato</label>

		<select name="tipoContratoRegistro" required>
			<option value="" disabled selected>Selecciona el tipo de contrato</option>
			<option value="Vinculado">Vinculado</option>
			<option value="Servicios">Servicios</option>
		</select>

		<label>Nombres</label>

		<input type="text" name="nombreConductorRegistro" required>

		<label>Apellidos</label>

		<input type="text" name="apellidoConductorRegistro" required>

		<label>Dirección</label>

		<input type="text" name="direccionConductorRegistro" required>

		<label>Celular</label>

		<input type="text" name="celularConductorRegistro" required>

		<label>Municipio</label>

		<select name="municipioConductorRegistro" required>

			<option value="" disabled selected>Selecciona el municipio</option>

			<?php  
				
				$datos = $conductor -> cargarSelectController("municipio", "nom_mun");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo utf8_encode($item["nom_mun"]);
					echo "</option>";
				}
				
			?>
		</select>

		<input type="submit" value="Enviar">

	</form>

	<?php  

	echo $resultado;

	?>

</div>