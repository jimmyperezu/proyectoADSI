<?php  

$novedad = new MvcControllerNovedad();
$novedad -> ingresoNovedadController();

date_default_timezone_set('America/Lima');

if(isset($_GET["action"])){
	if($_GET["action"] == "i_novedad"){
		$resultado = '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR NOVEDAD</h1>

	<form method="post">

		<label>Asignación</label>

		<select name="idAsigNovedad" required>

			<option value="" disabled selected>Selecciona la asignación</option>

			<?php  
				
				$datos = $novedad -> cargarSelectController("asignacion", "id_asi");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["id_asi"];
					echo "</option>";
				}
				
			?>
			
		</select>

		<label>Fecha</label>

		<input type="date" name="fechaNovedad" value="<?php echo date("Y-m-d"); ?>" required/>

		<label>Hora</label>

		<input type="time" name="horaNovedad" value="<?php echo date("H:i"); ?>" required>

		<label>Municipio</label>

		<select name="lugarNovedad" required>

			<option value="" disabled selected>Selecciona el lugar de la novedad</option>

			<?php  
				
				$datos = $novedad -> cargarSelectController("municipio", "nom_mun");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo utf8_encode($item["nom_mun"]);
					echo "</option>";
				}
				
			?>
			
		</select>

		<label>Tipo de novedad</label>

		<select name="tipoNovedad" required>
			<option value="" disabled selected>Selecciona el tipo de novedad</option>
		    <option value="Información">Información</option>
		    <option value="Requerimiento">Requerimiento</option>
		</select>

		<label>Descripción</label>

		<input type="text" name="descripcionNovedad" required>

		<label>Valor estimado</label>

		<input type="text" name="valorNovedad" required>

		<input type="submit" value="Enviar">

	</form>

	<?php  

	echo $resultado;

	?>

</div>