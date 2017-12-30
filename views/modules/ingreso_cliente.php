<?php  

$cliente = new MvcControllerCliente();
$cliente -> ingresoClienteController();

if(isset($_GET["action"])){
	if($_GET["action"] == "i_cliente"){
		$resultado = '<br><br><p class="resultado">Ingreso exitoso</p>';
	}else{
		$resultado = "";
	}
}

?>

<div class="form-inicio">

	<h1>INGRESAR CLIENTE</h1>

	<form method="post">
		
		<label>Identificación</label>

		<input type="text" name="idClienteRegistro" selected="Cédula de extranjería" required>

		<label>Tipo de documento</label>

		<select name="tipoClienteRegistro" required>
			<option value="" disabled selected>Selecciona el tipo de documento</option>
		    <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
		    <option value="Cédula de extranjería">Cédula de extranjería</option>
		    <option value="NIT">NIT</option>
		</select>

		<label>Nombres</label>

		<input type="text" name="nombreClienteRegistro" required>

		<label>Apellidos</label>

		<input type="text" name="apellidoClienteRegistro" required>

		<label>Dirección</label>

		<input type="text" name="direccionClienteRegistro" required>

		<label>Teléfono</label>

		<input type="text" name="telefonoClienteRegistro" required>

		<label>Municipio</label>

		<select name="municipioClienteRegistro" required>

			<option value="" disabled selected>Selecciona el municipio</option>

			<?php  
				
				$datos = $cliente -> cargarSelectController("municipio", "nom_mun");

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