<?php  

$ruta = new MvcControllerRuta();

if(isset($_GET["action"])){
	if($_GET["action"] == "i_ruta"){
		$resultado = '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR RUTA</h1>

	<form method="post">

		<label>Origen</label>

		<select name="origenRuta" required>

			<option value="" disabled selected>Selecciona el Origen</option>

			<?php  
				
				$datos = $ruta -> cargarSelectController("municipio", "nom_mun");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo utf8_encode($item["nom_mun"]);
					echo "</option>";
				}
				
			?>
		</select>

		<label>Destino</label>

		<select name="destinoRuta" required>

			<option value="" disabled selected>Selecciona el Destino</option>

			<?php  
				
				$datos = $ruta -> cargarSelectController("municipio", "nom_mun");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo utf8_encode($item["nom_mun"]);
					echo "</option>";
				}
				
			?>
		</select>

		<label>Distancia</label>

		<input type="text" name="distanciaRuta" required>

		<label>Duración estimada</label>

		<input type="text" name="duracionRuta" required>

		<input type="submit" value="Enviar">

	</form>

	<?php  

	$ruta -> ingresoRutaController();

	echo $resultado;

	?>

</div>