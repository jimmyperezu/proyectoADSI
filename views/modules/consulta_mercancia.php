<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$mercancia = new MvcControllerMercancia();
$mercancia -> borrarMercanciaController();

?>

<div class="tabla">

	<h1>MERCANCÍA</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Contenido</th>
				<th>Riesgo</th>
				<th>Horario</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			$mercancia -> vistaMercanciasController();

			?>

		</tbody>
	</table>

	

</div>