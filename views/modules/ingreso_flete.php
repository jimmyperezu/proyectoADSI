<?php  

$flete = new MvcControllerFlete();
$flete -> ingresoFleteController();

if(isset($_GET["action"])){
	if($_GET["action"] == "i_flete"){
		$resultado = '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR FLETE</h1>

	<form method="post">
		
		<label>Presupuesto</label>

		<select name="idPreFlete" required>

			<option value="" disabled selected>Selecciona el presupuesto</option>

			<?php  
				
				$datos = $flete -> cargarSelectController("presupuesto", "id_pre");

				foreach ($datos as $row => $item) {
					echo "<option>";
					echo $item["id_pre"];
					echo "</option>";
				}
				
			?>
		</select>

		<label>Valor flete</label>

		<input type="text" name="valorFlete" required>

		<input type="submit" value="Enviar">

	</form>

	<?php  

	echo $resultado;

	?>

</div>