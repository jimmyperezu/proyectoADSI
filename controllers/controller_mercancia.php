<?php

class MvcControllerMercancia{

	#INGRESO DE MERCANCIA
	#-------------------------------------

	public function ingresoMercanciaController(){

		if(isset($_POST["riesgoMerRegistro"])){

			$datosController = array(	"riesgoMer"=>$_POST["riesgoMerRegistro"],
										"horarioMer"=>$_POST["horarioMerRegistro"],
										"contenidoMer"=>$_POST["contenidoMerRegistro"]);

			$respuesta = DatosMercancia::ingresoMercanciaModel($datosController, "mercancia");

			if($respuesta == "success"){

				header("location:index.php?action=i_mercancia");

			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}
		}
	}

	#VISTA DE MERCANCIAS
	#-------------------------------------

	public function vistaMercanciasController(){

		$respuesta = DatosMercancia::vistaMercanciasModel("mercancia");

		$controlador = 'consulta_mercancia';

		echo '		<script>
					  	var controlador = "consulta_mercancia";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["mer_contenido"].'</td>
					<td>'.$item["mer_riesgo"].'</td>
					<td>'.$item["mer_hor"].'</td>
					<td><a href="index.php?action=editar_mercancia&id='.$item["id_mer"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id_mer"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR MERCANCIA
	#-------------------------------------

	public function editarMercanciaController(){

		$datosController = $_GET["id"];

		$respuesta = DatosMercancia::editarMercanciaModel($datosController, "mercancia");

		$nivSel;

		if($respuesta["mer_riesgo"] == "Nivel I"){
			$nivSel = '		<option value="Nivel I" selected="selected">Nivel I</option>
		                    <option value="Nivel II">Nivel II</option>
		                    <option value="Nivel III">Nivel III</option>
		                    <option value="Nivel IV">Nivel IV</option>';
		}elseif($respuesta["mer_riesgo"] == "Nivel II" ){
			$nivSel = '		<option value="Nivel I">Nivel I</option>
		                    <option value="Nivel II" selected="selected">Nivel II</option>
		                    <option value="Nivel III">Nivel III</option>
		                    <option value="Nivel IV">Nivel IV</option>';
		}elseif($respuesta["mer_riesgo"] == "Nivel III"){
			$nivSel = '		<option value="Nivel I">Nivel I</option>
		                    <option value="Nivel II">Nivel II</option>
		                    <option value="Nivel III" selected="selected">Nivel III</option>
		                    <option value="Nivel IV">Nivel IV</option>';
		}elseif($respuesta["mer_riesgo"] == "Nivel IV"){
			$nivSel = '		<option value="Nivel I">Nivel I</option>
		                    <option value="Nivel II">Nivel II</option>
		                    <option value="Nivel III">Nivel III</option>
		                    <option value="Nivel IV" selected="selected">Nivel IV</option>';
		}

		$obj = new FuncionesController();

		$datosHorario = $obj -> cargarSelectController("horario", "hor_tpo");
					
		$valorHorario = "";

		foreach ($datosHorario as $row => $item) {

			if($item["hor_tpo"] == $respuesta["mer_hor"]){

				$valorHorario = $valorHorario .'<option selected="selected">'
											.$item["hor_tpo"].
											"</option>";
			}elseif($item["hor_tpo"] != $respuesta["mer_hor"]){

				$valorHorario = $valorHorario .'<option>'
											.$item["hor_tpo"].
											"</option>";
			}
			
		}

		echo '	<input type="hidden" value="'.$respuesta["id_mer"].'" name="idMercancia" required>

				<label>Descripción contenido</label>

				<input type="text" value="'.$respuesta["mer_contenido"].'" name="contenidoMercancia" required>

				<label>Nivel de riesgo</label>

				<select name="riesgoMercancia" required>
						
					'.$nivSel.'
				  
				</select>

				<label>Horario autorizado</label>

				<select name="horarioMercancia" required>
						
					'.$valorHorario.'
				  
				</select>

				<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR MERCANCIA
	#-------------------------------------

	public function actualizarMercanciaController(){

		if(isset($_POST["idMercancia"])){

			$datosController = array(	"idMercancia"=>$_POST["idMercancia"],
										"riesgoMercancia"=>$_POST["riesgoMercancia"],
										"horarioMercancia"=>$_POST["horarioMercancia"],
										"contenidoMercancia"=>$_POST["contenidoMercancia"]);


			$respuesta = DatosMercancia::actualizarMercanciaModel($datosController, "mercancia");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_mercancia");

			}else{

				echo "error";

			}

		}

	}

	#BORRAR MERCANCIA
	#-------------------------------------

	public function borrarMercanciaController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosMercancia::borrarMercanciaModel($datosController, "mercancia");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_mercancia");
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