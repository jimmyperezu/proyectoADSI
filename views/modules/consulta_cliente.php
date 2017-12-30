<?php  

if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$cliente = new MvcControllerCliente();
$cliente -> borrarClienteController();

?>

<div class="tabla">

	<h1>CLIENTE</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Identificación</th>
				<th>Tipo Id.</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Dirección</th>
				<th>Teléfono</th>
				<th>Municipio</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php  

			
			$cliente -> vistaClientesController();

			?>

		</tbody>
	</table>

	

</div>