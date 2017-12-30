<?php

class MvcControllerMonitoreo{

	#INGRESO DE MONITOREO
	#-------------------------------------

	public function ingresoMonitoreoController(){

		if(isset($_POST["idAsigMonitoreo"])){

			$datosController = array(	"idAsigMonitoreo"=>$_POST["idAsigMonitoreo"],
										"ptoCtrlMonitoreo"=>$_POST["ptoCtrlMonitoreo"],
										"fechaMonitoreo"=>$_POST["fechaMonitoreo"],
										"horaMonitoreo"=>$_POST["horaMonitoreo"],
										"estadoMonitoreo"=>$_POST["estadoMonitoreo"]);

			$respuesta = DatosMonitoreo::ingresoMonitoreoModel($datosController, "monitoreo");

			if($respuesta == "success"){

				header("location:index.php?action=i_monitoreo");
				
			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}
		}
	}

	#VISTA DE MONITOREOS
	#-------------------------------------

	public function vistaMonitoreosController(){

		$respuesta = DatosMonitoreo::vistaMonitoreosModel("monitoreo");

		$controlador = 'consulta_monitoreo';

		echo '		<script>
					  	var controlador = "consulta_monitoreo";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["id_mon_asi"].'</td>
					<td>'.$item["mon_pto_ctrl"].'</td>
					<td>'.$item["mon_fecha"].'</td>
					<td>'.$item["mon_hora"].'</td>
					<td>'.$item["mon_estado"].'</td>
					<td><a href="index.php?action=editar_monitoreo&id='.$item["id_mon"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id_mon"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR MONITOREO
	#-------------------------------------

	public function editarMonitoreoController(){

		$datosController = $_GET["id"];

		$respuesta = DatosMonitoreo::editarMonitoreoModel($datosController, "monitoreo");

		$obj = new FuncionesController();

		$datosAsignacion = $obj -> cargarSelectController("asignacion", "id_asi");
					
		$valorAsignacion = "";

		foreach ($datosAsignacion as $row => $item) {

			if(utf8_encode($item["id_asi"]) == $respuesta["id_mon_asi"]){

				$valorAsignacion = $valorAsignacion .'<option selected="selected">'
											.utf8_encode($item["id_asi"]).
											"</option>";
			}elseif($item["id_asi"] != $respuesta["id_mon_asi"]){

				$valorAsignacion = $valorAsignacion .'<option>'
											.utf8_encode($item["id_asi"]).
											"</option>";
			}
			
		}

		$datosPtoCtrl = $obj -> cargarSelectController("puestocontrol", "pto_ctrl_mcpio");
					
		$valorPtoCtrl = "";

		foreach ($datosPtoCtrl as $row => $item) {

			if($item["pto_ctrl_mcpio"] == $respuesta["mon_pto_ctrl"]){

				$valorPtoCtrl = $valorPtoCtrl .'<option selected="selected">'
											.$item["pto_ctrl_mcpio"].
											"</option>";
			}elseif($item["pto_ctrl_mcpio"] != $respuesta["mon_pto_ctrl"]){

				$valorPtoCtrl = $valorPtoCtrl .'<option>'
											.$item["pto_ctrl_mcpio"].
											"</option>";
			}
			
		}

		$estSel;

		if($respuesta["mon_estado"] == "Sin fallas"){
			$estSel = '		<option value="Sin fallas" selected="selected">Sin fallas</option>
		                    <option value="Sin fallas pero con retraso">Sin fallas pero con retraso</option>
		                    <option value="Con fallas">Con fallas</option>';
		}elseif($respuesta["mon_estado"] == "Sin fallas pero con retraso" ){
			$estSel = '		<option value="Sin fallas">Sin fallas</option>
		                    <option value="Sin fallas pero con retraso" selected="selected">Sin fallas pero con retraso</option>
		                    <option value="Con fallas">Con fallas</option>';
		}elseif($respuesta["mon_estado"] == "Con fallas" ){
			$estSel = '		<option value="Sin fallas">Sin fallas</option>
		                    <option value="Sin fallas pero con retraso">Sin fallas pero con retraso</option>
		                    <option value="Con fallas" selected="selected">Con fallas</option>';
		}

		echo '	<input type="hidden" value="'.$respuesta["id_mon"].'" name="idMonitoreo" required>

				<label>Asignación</label>

				<select name="idAsigMonitoreo" required>
						
					'.$valorAsignacion.'

				</select>

				<label>Puesto de control</label>

				<select name="ptoCtrlMonitoreo" required>
						
					'.$valorPtoCtrl.'

				</select>

				<label>Fecha</label>

				<input type="date" value="'.$respuesta["mon_fecha"].'" name="fechaMonitoreo" required>

				<label>Hora</label>

				<input type="time" value="'.$respuesta["mon_hora"].'" name="horaMonitoreo" required>

				<label>Descripción</label>

				<select name="estadoMonitoreo" required>
						
					'.$estSel.'

				</select>

				<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR MONITOREO
	#-------------------------------------

	public function actualizarMonitoreoController(){

		if(isset($_POST["idMonitoreo"])){

			$datosController = array(	"idMonitoreo"=>$_POST["idMonitoreo"],
										"idAsigMonitoreo"=>$_POST["idAsigMonitoreo"],
										"ptoCtrlMonitoreo"=>$_POST["ptoCtrlMonitoreo"],
										"fechaMonitoreo"=>$_POST["fechaMonitoreo"],
										"horaMonitoreo"=>$_POST["horaMonitoreo"],
										"estadoMonitoreo"=>$_POST["estadoMonitoreo"]);


			$respuesta = DatosMonitoreo::actualizarMonitoreoModel($datosController, "monitoreo");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_monitoreo");

			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}

		}

	}

	#BORRAR MONITOREO
	#-------------------------------------

	public function borrarMonitoreoController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosMonitoreo::borrarMonitoreoModel($datosController, "monitoreo");

			if($respuesta == "success"){

				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_monitoreo");
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