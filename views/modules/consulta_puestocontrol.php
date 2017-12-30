<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$puestocontrol = new MvcControllerPuestoControl();
$puestocontrol -> borrarPuestoControlController();

?>

<div class="tabla">

	<h1>PUESTO CONTROL</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Ruta</th>
				<th>Municipio</th>
				<th>Celular</th>
				<th>Email</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			$puestocontrol -> vistaPuestoControlController();

			?>

		</tbody>
	</table>

	

</div>