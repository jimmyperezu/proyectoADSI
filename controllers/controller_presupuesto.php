<?php

class MvcControllerPresupuesto{

	#INGRESO DE PRESUPUESTO
	#-------------------------------------

	public function ingresoPresupuestoController(){

		if(isset($_POST["idAsigPresupuesto"])){

			$datosController = array(	"idAsigPresupuesto"=>$_POST["idAsigPresupuesto"],
										"placaVehPresupuesto"=>$_POST["placaVehPresupuesto"],
										"rutaPresupuesto"=>$_POST["rutaPresupuesto"],
										"valorPresupuesto"=>$_POST["valorPresupuesto"]);

			$respuesta = DatosPresupuesto::ingresoPresupuestoModel($datosController, "presupuesto");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=i_presupuesto");
				}
				
			}else{
				echo '<p class="fallo">Error en los datos ingresados.</p>';
			}
		}
	}

	#VISTA DE PRESUPUESTOS
	#-------------------------------------

	public function vistaPresupuestosController(){

		$respuesta = DatosPresupuesto::vistaPresupuestosModel("presupuesto");

		$controlador = 'consulta_presupuesto';

		echo '		<script>
					  	var controlador = "consulta_presupuesto";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["id_pre"].'</td>
					<td>'.$item["id_pre_asi"].'</td>
					<td>'.$item["id_pre_veh"].'</td>
					<td>'.$item["pre_rut"].'</td>
					<td>'.$item["pre_val"].'</td>
					<td><a href="index.php?action=editar_presupuesto&id='.$item["id_pre"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id_pre"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR PRESUPUESTO
	#-------------------------------------

	public function editarPresupuestoController(){

		$datosController = $_GET["id"];

		$respuesta = DatosPresupuesto::editarPresupuestoModel($datosController, "presupuesto");

		$obj = new FuncionesController();

		$datosAsignacion = $obj -> cargarSelectController("asignacion", "id_asi");
					
		$valorAsignacion = "";

		foreach ($datosAsignacion as $row => $item) {

			if($item["id_asi"] == $respuesta["id_pre_asi"]){

				$valorAsignacion = $valorAsignacion .'<option selected="selected">'
											.$item["id_asi"].
											"</option>";
			}elseif($item["id_asi"] != $respuesta["id_pre_asi"]){

				$valorAsignacion = $valorAsignacion .'<option>'
											.$item["id_asi"].
											"</option>";
			}
			
		}

		$datosVehiculo = $obj -> cargarSelectController("vehiculo", "id_veh");
					
		$valorVehiculo = "";

		foreach ($datosVehiculo as $row => $item) {

			if($item["id_veh"] == $respuesta["id_pre_veh"]){

				$valorVehiculo = $valorVehiculo .'<option selected="selected">'
											.$item["id_veh"].
											"</option>";
			}elseif($item["id_veh"] != $respuesta["id_pre_veh"]){

				$valorVehiculo = $valorVehiculo .'<option>'
											.$item["id_veh"].
											"</option>";
			}
			
		}

		$datosRuta = $obj -> cargarSelectController("ruta", "rut_origen_destino");
					
		$valorRuta = "";

		foreach ($datosRuta as $row => $item) {

			if($item["rut_origen_destino"] == $respuesta["pre_rut"]){

				$valorRuta = $valorRuta .'<option selected="selected">'
											.$item["rut_origen_destino"].
											"</option>";
			}elseif($item["rut_origen_destino"] != $respuesta["pre_rut"]){

				$valorRuta = $valorRuta .'<option>'
											.$item["rut_origen_destino"].
											"</option>";
			}
			
		}

		echo '	<input type="hidden" value="'.$respuesta["id_pre"].'" name="idPresupuesto" required>

				<label>Asignación</label>

				<select name="idAsigPresupuesto" required>
						
					'.$valorAsignacion.'

				</select>

				<label>Vehículo</label>

				<select name="placaVehPresupuesto" required>
						
					'.$valorVehiculo.'

				</select>

				<label>Ruta</label>

				<select name="rutaPresupuesto" required>
						
					'.$valorRuta.'

				</select>

				<label>Valor</label>

				<input type="text" value="'.$respuesta["pre_val"].'" name="valorPresupuesto" required>

				<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR PRESUPUESTO
	#-------------------------------------

	public function actualizarPresupuestoController(){

		if(isset($_POST["idPresupuesto"])){

			$datosController = array(	"idPresupuesto"=>$_POST["idPresupuesto"],
										"idAsigPresupuesto"=>$_POST["idAsigPresupuesto"],
										"placaVehPresupuesto"=>$_POST["placaVehPresupuesto"],
										"rutaPresupuesto"=>$_POST["rutaPresupuesto"],
										"valorPresupuesto"=>$_POST["valorPresupuesto"]);


			$respuesta = DatosPresupuesto::actualizarPresupuestoModel($datosController, "presupuesto");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_presupuesto");

			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}

		}

	}

	#BORRAR PRESUPUESTO
	#-------------------------------------

	public function borrarPresupuestoController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosPresupuesto::borrarPresupuestoModel($datosController, "presupuesto");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_presupuesto");
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