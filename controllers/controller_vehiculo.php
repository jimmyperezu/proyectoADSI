<?php

class MvcControllerVehiculo{

	#INGRESO DE VEHICULO
	#-------------------------------------

	public function ingresoVehiculoController(){

		if(isset($_POST["placaVehiculo"])){

			$datosController = array(	"placaVehiculo"=>$_POST["placaVehiculo"],
										"idConductorVehiculo"=>$_POST["idConductorVehiculo"],
										"agenciaVehiculo"=>$_POST["agenciaVehiculo"],
										"tipoContratoVehiculo"=>$_POST["tipoContratoVehiculo"],
										"modeloVehiculo"=>$_POST["modeloVehiculo"],
										"marcaVehiculo"=>$_POST["marcaVehiculo"]);

			$respuesta = DatosVehiculo::ingresoVehiculoModel($datosController, "vehiculo");

			if($respuesta == "success"){

				header("location:index.php?action=i_vehiculo");

				
			}else{
				echo '<p class="fallo">Error en los datos ingresados.</p>';
			}
		}
	}

	#VISTA DE VEHICULOS
	#-------------------------------------

	public function vistaVehiculosController(){

		$respuesta = DatosVehiculo::vistaVehiculosModel("vehiculo");

		$controlador = 'consulta_vehiculo';

		echo '		<script>
					  	var controlador = "consulta_vehiculo";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["id_veh"].'</td>
					<td>'.$item["id_veh_ctor"].'</td>
					<td>'.$item["veh_agcia"].'</td>
					<td>'.$item["veh_tpo_cto"].'</td>
					<td>'.$item["veh_modelo"].'</td>
					<td>'.$item["veh_marca"].'</td>
					<td><a href="index.php?action=editar_vehiculo&id='.$item["id_veh"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma(\''.$item["id_veh"].'\', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}
	}

	#EDITAR VEHICULO
	#-------------------------------------

	public function editarVehiculoController(){

		$datosController = $_GET["id"];

		$respuesta = DatosVehiculo::editarVehiculoModel($datosController, "vehiculo");

		$obj = new FuncionesController();

		$datosConductor = $obj -> cargarSelectController("conductor", "id_ctor");
					
		$valorConductor = "";

		foreach ($datosConductor as $row => $item) {

			if($item["id_ctor"] == $respuesta["id_veh_ctor"]){

				$valorConductor = $valorConductor .'<option selected="selected">'
											.utf8_encode($item["id_ctor"]).
											"</option>";
			}elseif($item["id_ctor"] != $respuesta["id_veh_ctor"]){

				$valorConductor = $valorConductor .'<option>'
											.utf8_encode($item["id_ctor"]).
											"</option>";
			}
			
		}

		$datosAgencia = $obj -> cargarSelectController("agencia", "agcia_mcpio");
					
		$valorAgencia = "";

		foreach ($datosAgencia as $row => $item) {

			if($item["agcia_mcpio"] == $respuesta["veh_agcia"]){

				$valorAgencia = $valorAgencia .'<option selected="selected">'
											.$item["agcia_mcpio"].
											"</option>";
			}elseif($item["agcia_mcpio"] != $respuesta["veh_agcia"]){

				$valorAgencia = $valorAgencia .'<option>'
											.$item["agcia_mcpio"].
											"</option>";
			}
			
		}

		$ctoSel;

		if($respuesta["veh_tpo_cto"] == "Flota Propia"){
			$ctoSel = '		<option value="Flota Propia" selected="selected">Flota Propia</option>
							<option value="Tercero">Tercero</option>';
		}elseif($respuesta["veh_tpo_cto"] == "Tercero" ){
			$ctoSel = '		<option value="Flota Propia">Flota Propia</option>
							<option value="Tercero" selected="selected">Tercero</option>';
		}

		$mcaSel;

		if($respuesta["veh_marca"] == "CHEVROLET"){
			$mcaSel = '		<option value="CHEVROLET" selected="selected">CHEVROLET</option>
							<option value="HINO">HINO</option>
							<option value="KENWORTH">KENWORTH</option>';
		}elseif($respuesta["veh_marca"] == "HINO" ){
			$mcaSel = '		<option value="CHEVROLET">CHEVROLET</option>
							<option value="HINO" selected="selected">HINO</option>
							<option value="KENWORTH">KENWORTH</option>';
		}elseif($respuesta["veh_marca"] == "KENWORTH" ){
			$mcaSel = '		<option value="CHEVROLET">CHEVROLET</option>
							<option value="HINO">HINO</option>
							<option value="KENWORTH" selected="selected">KENWORTH</option>';
		}

		echo '	<input type="hidden" value="'.$respuesta["id_veh"].'" name="placaVehiculoAnterior" required>

				<label>Placa</label>

				<input type="text" value="'.$respuesta["id_veh"].'" name="placaVehiculo" required>

				<label>Conductor</label>

				<select name="idConductorVehiculo" required>
						
					'.$valorConductor.'

				</select>

				<label>Agencia</label>

				<select name="agenciaVehiculo" required>
						
					'.$valorAgencia.'

				</select>

				<label>Tipo de contrato</label>

				<select name="tipoContratoVehiculo" required>
						
					'.$ctoSel.'

				</select>

				<label>Modelo</label>

				<input type="text" value="'.$respuesta["veh_modelo"].'" name="modeloVehiculo" required>

				<label>Marca</label>

				<select name="marcaVehiculo" required>
						
					'.$mcaSel.'

				</select>

				<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR VEHICULO
	#-------------------------------------

	public function actualizarVehiculoController(){

		if(isset($_POST["placaVehiculo"])){

			$datosController = array(	"placaVehiculoAnterior"=>$_POST["placaVehiculoAnterior"],
										"placaVehiculo"=>$_POST["placaVehiculo"],
										"idConductorVehiculo"=>$_POST["idConductorVehiculo"],
										"agenciaVehiculo"=>$_POST["agenciaVehiculo"],
										"tipoContratoVehiculo"=>$_POST["tipoContratoVehiculo"],
										"modeloVehiculo"=>$_POST["modeloVehiculo"],
										"marcaVehiculo"=>$_POST["marcaVehiculo"]);


			$respuesta = DatosVehiculo::actualizarVehiculoModel($datosController, "vehiculo");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_vehiculo");

			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}

		}

	}

	#BORRAR VEHICULO
	#-------------------------------------

	public function borrarVehiculoController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosVehiculo::borrarVehiculoModel($datosController, "vehiculo");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_vehiculo");
				}
				

			}else{

				echo "error";

			}

		}

	}

	#CARGAR CONTENIDO
	#-------------------------------------

	public function cargarSelectController($tabla, $campo){
		
		$respuesta = DatosAsignacion::cargarSelectModel($tabla, $campo);

		if($respuesta != "error"){
				
			return $respuesta;

		}else{

			echo "error";

		}

	}
}

?>