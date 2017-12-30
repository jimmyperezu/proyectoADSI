<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$conductor = new MvcControllerConductor();
$conductor -> borrarConductorController();


?>

<div class="tabla">

	<h1>CONDUCTOR</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Identificación</th>
				<th>Tipo Id.</th>
				<th>Agencia</th>
				<th>Tipo contrato</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Dirección</th>
				<th>Celular</th>
				<th>Municipio</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			
			$conductor -> vistaConductoresController();

			?>

		</tbody>
	</table>

	

</div>