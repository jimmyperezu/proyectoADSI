<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$novedad = new MvcControllerNovedad();
$novedad -> borrarNovedadController();

?>

<div class="tabla">

	<h1>NOVEDAD</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Asignación</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Lugar</th>
				<th>Tipo</th>
				<th>Descripción</th>
				<th>Costo</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			
			$novedad -> vistaNovedadesController();

			?>

		</tbody>
	</table>

	

</div>