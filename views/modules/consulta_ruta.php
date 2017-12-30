<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$ruta = new MvcControllerRuta();
$ruta -> borrarRutaController();

?>

<div class="tabla">

	<h1>RUTA</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Descripción</th>
				<th>Distancia (km)</th>
				<th>Duración (horas)</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			
			$ruta -> vistaRutasController();

			?>

		</tbody>
	</table>

	

</div>