<?php  

$agencia = new MvcControllerAgencia();


if(isset($_GET["action"])){
	if($_GET["action"] == "i_agcia"){
		echo '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR AGENCIA</h1>

	<form method="post">
		
		<label>Municipio</label>

		<select name="municipioAgencia" required>

			<option value="" disabled selected>Selecciona el municipio</option>

			<?php  
				
				$datos = $agencia -> cargarSelectController("municipio", "nom_mun");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo utf8_encode($item["nom_mun"]);
					echo "</option>";
				}
				
			?>
		</select>

		<label>Celular</label>

		<input type="text" name="celularAgencia" required>

		<label>Correo electrónico</label>

		<input type="email" name="emailAgencia" required>

		<input type="submit" value="Enviar">

	</form>

	<?php  

	$agencia -> ingresoAgenciaController();

	echo $resultado;

	?>

</div>