<?php  

$puestocontrol = new MvcControllerPuestoControl();


if(isset($_GET["action"])){
	if($_GET["action"] == "i_puestocontrol"){
		$resultado = '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR PUESTO CONTROL</h1>

	<form method="post">

		<label>Ruta</label>

		<select name="rutaPtoCtrl" required>

			<option value="" disabled selected>Selecciona la ruta</option>

			<?php  
				
				$datos = $puestocontrol -> cargarSelectController("ruta", "rut_origen_destino");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["rut_origen_destino"];
					echo "</option>";
				}
				
			?>
		</select>

		<label>Municipio</label>

		<select name="municipioPtoCtrl" required>

			<option value="" disabled selected>Selecciona el municipio</option>

			<?php  
				
				$datos = $puestocontrol -> cargarSelectController("municipio", "nom_mun");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo utf8_encode($item["nom_mun"]);
					echo "</option>";
				}
				
			?>
		</select>

		<label>Celular</label>

		<input type="text" name="celularPtoCtrl" required>

		<label>Correo electrónico</label>

		<input type="email" name="emailPtoCtrl" required>

		<input type="submit" value="Enviar">

	</form>

	<?php  

	$puestocontrol -> ingresoPtoCtrlController();

	echo $resultado;

	?>

</div>