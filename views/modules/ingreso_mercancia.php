<?php  

$mercancia = new MvcControllerMercancia();

if(isset($_GET["action"])){
	if($_GET["action"] == "i_mercancia"){
		$resultado = '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR MERCANCÍA</h1>

	<form method="post">

		<label>Descripción contenido</label>

		<input type="text" name="contenidoMerRegistro" required>

		<label>Nivel de riesgo</label>

		<select name="riesgoMerRegistro" required>
		  <option value="Nivel I">Nivel I</option>
		  <option value="Nivel II">Nivel II</option>
		  <option value="Nivel III">Nivel III</option>
		  <option value="Nivel IV">Nivel IV</option>
		</select>

		<label>Horario autorizado</label>

		<select name="horarioMerRegistro" required>

			<option value="" disabled selected>Selecciona el horario autorizado</option>

			<?php  
				
				$datos = $mercancia -> cargarSelectController("horario", "hor_tpo");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["hor_tpo"];
					echo "</option>";
				}
				
			?>
		</select>

		<input type="submit" value="Enviar">

	</form>
	
	<?php  

	$mercancia -> ingresoMercanciaController();

	echo $resultado;

	?>

</div>