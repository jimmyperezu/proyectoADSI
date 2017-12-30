<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$flete = new MvcControllerFlete();
$flete -> borrarFleteController();

?>

<div class="tabla">

	<h1>FLETE</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Id.</th>
				<th>Presupuesto</th>
				<th>Valor</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			$flete -> vistaFletesController();

			?>

		</tbody>
	</table>

	

</div>