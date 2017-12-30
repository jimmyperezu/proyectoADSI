<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$vistaAgencia = new MvcControllerAgencia();
$vistaAgencia -> borrarAgenciaController();

?>

<div class="tabla">

	<h1>AGENCIA</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Municipio</th>
				<th>Celular</th>
				<th>Email</th>
				<th></th>
				<th></th>
				
				
			</tr>
		</thead>

		<tbody>
			
			<?php  

			$vistaAgencia -> vistaAgenciasController();

			?>
		</tbody>
	</table>

</div>