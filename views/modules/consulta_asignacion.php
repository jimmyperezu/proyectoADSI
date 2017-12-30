<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$asignacion = new MvcControllerAsignacion();
$asignacion -> borrarAsignacionController();

?>

<div class="tabla">

	<h1>ASIGNACIÓN</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Id.</th>
				<th>Cliente</th>
				<th>Mercancía</th>
				<th>Agencia</th>
				<th>Fecha registro</th>
				<th>Fecha entrega</th>
				<th>Estado</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			
			$asignacion -> vistaAsignacionesController();

			?>

		</tbody>
	</table>

	

</div>