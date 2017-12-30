<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$horario = new MvcControllerHorario();
$horario -> borrarHorarioController();

?>

<div class="tabla">

	<h1>HORARIO</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Rango</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			
			$horario -> vistaHorariosController();

			?>

		</tbody>
	</table>

	

</div>