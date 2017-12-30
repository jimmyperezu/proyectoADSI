<?php

class MvcControllerConductor{

	#INGRESO DE CONDUCTOR
	#-------------------------------------

	public function ingresoConductorController(){

		if(isset($_POST["idConductorRegistro"])){

			$datosController = array(	"idConductor"=>$_POST["idConductorRegistro"],
										"tipoConductor"=>$_POST["tipoConductorRegistro"],
										"agenciaConductor"=>$_POST["agenciaConductorRegistro"],
										"tipoContrato"=>$_POST["tipoContratoRegistro"],
										"nombreConductor"=>$_POST["nombreConductorRegistro"],
										"apellidoConductor"=>$_POST["apellidoConductorRegistro"],
										"direccionConductor"=>$_POST["direccionConductorRegistro"],
										"celularConductor"=>$_POST["celularConductorRegistro"],
										"municipioConductor"=>$_POST["municipioConductorRegistro"]);

			$respuesta = DatosConductor::ingresoConductorModel($datosController, "conductor");

			if($respuesta == "success"){

				header("location:index.php?action=i_conductor");

			}else{

				header("location:index.php");

			}
		}
	}

	#VISTA DE CONDUCTORES
	#-------------------------------------

	public function vistaConductoresController(){

		$respuesta = DatosConductor::vistaConductoresModel("conductor");

		$controlador = 'consulta_conductor';

		echo '		<script>
					  	var controlador = "consulta_conductor";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["id_ctor"].'</td>
					<td>'.$item["ctor_tpo_id"].'</td>
					<td>'.$item["ctor_agcia"].'</td>
					<td>'.$item["ctor_tpo_cto"].'</td>
					<td>'.$item["ctor_nom"].'</td>
					<td>'.$item["ctor_ape"].'</td>
					<td>'.$item["ctor_dir"].'</td>
					<td>'.$item["ctor_cel"].'</td>
					<td>'.$item["ctor_mun"].'</td>
					<td><a href="index.php?action=editar_conductor&id='.$item["id_ctor"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id_ctor"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR CONDUCTOR
	#-------------------------------------

	public function editarConductorController(){

		$datosController = $_GET["id"];

		$respuesta = DatosConductor::editarConductorModel($datosController, "conductor");

		$docSel;

		if($respuesta["ctor_tpo_id"] == "Cédula de ciudadanía"){
			$docSel = '		<option value="Cédula de ciudadanía" selected="selected">Cédula de ciudadanía</option>
							<option value="Cédula de extranjería">Cédula de extranjería</option>
							<option value="NIT">NIT</option>';
		}elseif($respuesta["ctor_tpo_id"] == "Cédula de extranjería" ){
			$docSel = '		<option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
							<option value="Cédula de extranjería" selected="selected">Cédula de extranjería</option>
							<option value="NIT">NIT</option>';
		}elseif($respuesta["ctor_tpo_id"] == "NIT"){
			$docSel = '		<option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
							<option value="Cédula de extranjería">Cédula de extranjería</option>
							<option value="NIT" selected="selected">NIT</option>';
		}

		$obj = new FuncionesController();

		$datosAgencia = $obj -> cargarSelectController("agencia", "agcia_mcpio");
					
		$valorAgencia = "";

		foreach ($datosAgencia as $row => $item) {

			if($item["agcia_mcpio"] == $respuesta["ctor_agcia"]){

				$valorAgencia = $valorAgencia .'<option selected="selected">'
											.$item["agcia_mcpio"].
											"</option>";
			}elseif($item["agcia_mcpio"] != $respuesta["ctor_agcia"]){

				$valorAgencia = $valorAgencia .'<option>'
											.$item["agcia_mcpio"].
											"</option>";
			}
			
		}

		$ctoSel;

		if($respuesta["ctor_tpo_cto"] == "Vinculado"){
			$ctoSel = '		<option value="Vinculado" selected="selected">Vinculado</option>
							<option value="Servicios">Servicios</option>';
		}elseif($respuesta["ctor_tpo_cto"] == "Servicios" ){
			$ctoSel = '		<option value="Vinculado">Vinculado</option>
							<option value="Servicios" selected="selected">Servicios</option>';
		}

		$datosMunicipio = $obj -> cargarSelectController("municipio", "nom_mun");
					
		$valorMunicipio = "";

		foreach ($datosMunicipio as $row => $item) {

			if(utf8_encode($item["nom_mun"]) == $respuesta["ctor_mun"]){

				$valorMunicipio = $valorMunicipio .'<option selected="selected">'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}elseif($item["nom_mun"] != $respuesta["ctor_mun"]){

				$valorMunicipio = $valorMunicipio .'<option>'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}
			
		}

		echo '	<input type="hidden" value="'.$respuesta["id_ctor"].'" name="idConductorAnterior" required>

				<label>Identificación</label>

				<input type="text" value="'.$respuesta["id_ctor"].'" name="idConductor" required>

				<label>Tipo de documento</label>

				<select name="tipoIdConductor" required>
						
					'.$docSel.'
				  
				</select>

				<label>Agencia</label>

				<select name="agenciaConductor" required>
						
					'.$valorAgencia.'

				</select>

				<label>Tipo de contrato</label>

				<select name="tipoCtoConductor" required>
						
					'.$ctoSel.'

				</select>

				<label>Nombres</label>

				<input type="text" value="'.$respuesta["ctor_nom"].'" name="nombreConductor" required>

				<label>Apellidos</label>

				<input type="text" value="'.$respuesta["ctor_ape"].'" name="apellidoConductor" required>

				<label>Dirección</label>

				<input type="text" value="'.$respuesta["ctor_dir"].'" name="direccionConductor" required>

				<label>Celular</label>

				<input type="text" value="'.$respuesta["ctor_cel"].'" name="celularConductor" required>

				<label>Municipio</label>

				<select name="municipioConductor" required>
						
					'.$valorMunicipio.'

				</select>

				<input type="submit" value="Actualizar">';
	}

	#ACTUALIZAR CONDUCTOR
	#-------------------------------------

	public function actualizarConductorController(){

		if(isset($_POST["idConductor"])){

			$datosController = array(	"idConductorAnterior"=>$_POST["idConductorAnterior"],
										"idConductor"=>$_POST["idConductor"],
										"tipoIdConductor"=>$_POST["tipoIdConductor"],
										"agenciaConductor"=>$_POST["agenciaConductor"],
										"tipoCtoConductor"=>$_POST["tipoCtoConductor"],
										"nombreConductor"=>$_POST["nombreConductor"],
										"apellidoConductor"=>$_POST["apellidoConductor"],
										"direccionConductor"=>$_POST["direccionConductor"],
										"celularConductor"=>$_POST["celularConductor"],
										"municipioConductor"=>$_POST["municipioConductor"]);


			$respuesta = DatosConductor::actualizarConductorModel($datosController, "conductor");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_conductor");

			}else{
				echo '<p class="fallo">Error en los datos ingresados.</p>';
				var_dump($datosController);
				//echo "error";

			}

		}

	}

	#BORRAR CONDUCTOR
	#-------------------------------------

	public function borrarConductorController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosConductor::borrarConductorModel($datosController, "conductor");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_conductor");
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