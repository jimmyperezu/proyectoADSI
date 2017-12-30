<?php

class MvcControllerPuestoControl{

	#INGRESO DE PUESTO DE CONTROL
	#-------------------------------------

	public function ingresoPtoCtrlController(){

		if(isset($_POST["rutaPtoCtrl"]) && filter_var($_POST["emailPtoCtrl"], FILTER_VALIDATE_EMAIL)){

			$datosController = array(	"rutaPtoCtrl"=>$_POST["rutaPtoCtrl"],
										"municipioPtoCtrl"=>$_POST["municipioPtoCtrl"],
										"celularPtoCtrl"=>$_POST["celularPtoCtrl"],
										"emailPtoCtrl"=>$_POST["emailPtoCtrl"]);

			$respuesta = DatosPuestoControl::ingresoPtoCtrlModel($datosController, "puestocontrol");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=i_puestocontrol");
				}
				
			}else{
				echo '<p class="fallo">Error en los datos ingresados.</p>';
			}
		}elseif(isset($_POST["rutaPtoCtrl"]) && !filter_var($_POST["emailPtoCtrl"], FILTER_VALIDATE_EMAIL)){

			echo '<p class="fallo">Correo electrónico no válido.</p>';

		}
	}

	#VISTA DE PUESTOS DE CONTROL
	#-------------------------------------

	public function vistaPuestoControlController(){

		$respuesta = DatosPuestoControl::vistaPuestoControlModel("puestocontrol");

		$controlador = 'consulta_puestocontrol';

		echo '		<script>
					  	var controlador = "consulta_puestocontrol";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["pto_ctrl_rut"].'</td>
					<td>'.$item["pto_ctrl_mcpio"].'</td>
					<td>'.$item["pto_ctrl_celular"].'</td>
					<td>'.$item["pto_ctrl_correo"].'</td>
					<td><a href="index.php?action=editar_puestocontrol&id='.$item["id_pto_ctrl"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id_pto_ctrl"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR PUESTO DE CONTROL
	#-------------------------------------

	public function editarPuestoControlController(){

		$datosController = $_GET["id"];

		$respuesta = DatosPuestoControl::editarPuestoControlModel($datosController, "puestocontrol");

		$obj = new FuncionesController();

		$datosRuta = $obj -> cargarSelectController("ruta", "rut_origen_destino");
					
		$valorRuta = "";

		foreach ($datosRuta as $row => $item) {

			if(utf8_encode($item["rut_origen_destino"]) == $respuesta["pto_ctrl_rut"]){

				$valorRuta = $valorRuta .'<option selected="selected">'
											.$item["rut_origen_destino"].
											"</option>";
			}elseif($item["rut_origen_destino"] != $respuesta["pto_ctrl_rut"]){

				$valorRuta = $valorRuta .'<option>'
											.$item["rut_origen_destino"].
											"</option>";
			}
			
		}

		$datosMunicipio = $obj -> cargarSelectController("municipio", "nom_mun");
					
		$valorMunicipio = "";

		foreach ($datosMunicipio as $row => $item) {

			if(utf8_encode($item["nom_mun"]) == $respuesta["pto_ctrl_mcpio"]){

				$valorMunicipio = $valorMunicipio .'<option selected="selected">'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}elseif($item["nom_mun"] != $respuesta["pto_ctrl_mcpio"]){

				$valorMunicipio = $valorMunicipio .'<option>'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}
			
		}

		echo '	<input type="hidden" value="'.$respuesta["id_pto_ctrl"].'" name="idPtoCtrl" required>

				<label>Ruta</label>

				<select name="rutaPtoCtrl" required>
						
					'.$valorRuta.'

				</select>

				<label>Municipio</label>

				<select name="municipioPtoCtrl" required>
						
					'.$valorMunicipio.'

				</select>

				<label>Celular</label>

				<input type="text" value="'.$respuesta["pto_ctrl_celular"].'" name="celularPtoCtrl" required>

				<label>Correo electrónico</label>

				<input type="email" value="'.$respuesta["pto_ctrl_correo"].'" name="emailPtoCtrl" required>

				<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR PUESTO DE CONTROL
	#-------------------------------------

	public function actualizarPuestoControlController(){

		if(isset($_POST["idPtoCtrl"]) && filter_var($_POST["emailPtoCtrl"], FILTER_VALIDATE_EMAIL)){

			$datosController = array(	"idPtoCtrl"=>$_POST["idPtoCtrl"],
										"rutaPtoCtrl"=>$_POST["rutaPtoCtrl"],
										"municipioPtoCtrl"=>$_POST["municipioPtoCtrl"],
										"celularPtoCtrl"=>$_POST["celularPtoCtrl"],
										"emailPtoCtrl"=>$_POST["emailPtoCtrl"]);


			$respuesta = DatosPuestoControl::actualizarPuestoControlModel($datosController, "puestocontrol");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_puestocontrol");

			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}

		}elseif(isset($_POST["idPtoCtrl"]) && !filter_var($_POST["emailPtoCtrl"], FILTER_VALIDATE_EMAIL)){

			echo '<p class="fallo">Correo electrónico no válido.</p>';

		}

	}

	#BORRAR PUESTO DE CONTROL
	#-------------------------------------

	public function borrarPuestoControlController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosPuestoControl::borrarPuestoControlModel($datosController, "puestocontrol");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_puestocontrol");
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