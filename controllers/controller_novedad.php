<?php

class MvcControllerNovedad{

	#INGRESO DE NOVEDAD
	#-------------------------------------

	public function ingresoNovedadController(){

		if(isset($_POST["idAsigNovedad"])){

			$datosController = array(	"idAsigNovedad"=>$_POST["idAsigNovedad"],
										"fechaNovedad"=>$_POST["fechaNovedad"],
										"horaNovedad"=>$_POST["horaNovedad"],
										"lugarNovedad"=>$_POST["lugarNovedad"],
										"tipoNovedad"=>$_POST["tipoNovedad"],
										"descripcionNovedad"=>$_POST["descripcionNovedad"],
										"valorNovedad"=>$_POST["valorNovedad"]);

			$respuesta = DatosNovedad::ingresoNovedadModel($datosController, "novedad");

			if($respuesta == "success"){

				header("location:index.php?action=i_novedad");

			}else{
				echo '<p class="fallo">Error en los datos ingresados.</p>';
			}
		}
	}

	#VISTA DE NOVEDADES
	#-------------------------------------

	public function vistaNovedadesController(){

		$respuesta = DatosNovedad::vistaNovedadesModel("novedad");

		$controlador = 'consulta_novedad';

		echo '		<script>
					  	var controlador = "consulta_novedad";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["id_nov_asi"].'</td>
					<td>'.$item["nov_fecha"].'</td>
					<td>'.$item["nov_hora"].'</td>
					<td>'.$item["nov_lugar"].'</td>
					<td>'.$item["nov_tipo"].'</td>
					<td>'.$item["nov_desc"].'</td>
					<td>'.$item["nov_costo"].'</td>
					<td><a href="index.php?action=editar_novedad&id='.$item["id_nov"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id_nov"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR NOVEDAD
	#-------------------------------------

	public function editarNovedadController(){

		$datosController = $_GET["id"];

		$respuesta = DatosNovedad::editarNovedadModel($datosController, "novedad");

		$obj = new FuncionesController();

		$datosAsignacion = $obj -> cargarSelectController("asignacion", "id_asi");
					
		$valorAsignacion = "";

		foreach ($datosAsignacion as $row => $item) {

			if(utf8_encode($item["id_asi"]) == $respuesta["id_nov_asi"]){

				$valorAsignacion = $valorAsignacion .'<option selected="selected">'
											.utf8_encode($item["id_asi"]).
											"</option>";
			}elseif($item["id_asi"] != $respuesta["id_nov_asi"]){

				$valorAsignacion = $valorAsignacion .'<option>'
											.utf8_encode($item["id_asi"]).
											"</option>";
			}
			
		}

		$datosLugar = $obj -> cargarSelectController("municipio", "nom_mun");
					
		$valorLugar = "";

		foreach ($datosLugar as $row => $item) {

			if(utf8_encode($item["nom_mun"]) == $respuesta["nov_lugar"]){

				$valorLugar = $valorLugar .'<option selected="selected">'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}elseif($item["nom_mun"] != $respuesta["nov_lugar"]){

				$valorLugar = $valorLugar .'<option>'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}
			
		}

		$tpoNov;

		if($respuesta["nov_tipo"] == "Información"){
			$tpoNov = '		<option value="Información" selected="selected">Información</option>
		                    <option value="Requerimiento">Requerimiento</option>';
		}elseif($respuesta["nov_tipo"] == "Requerimiento" ){
			$tpoNov = '		<option value="Información">Información</option>
		                    <option value="Requerimiento" selected="selected">Requerimiento</option>';
		}

		echo '	<input type="hidden" value="'.$respuesta["id_nov"].'" name="idNovedad" required>

				<label>Asignación</label>

				<select name="idAsigNovedad" required>
						
					'.$valorAsignacion.'

				</select>

				<label>Fecha</label>

				<input type="date" value="'.$respuesta["nov_fecha"].'" name="fechaNovedad" required>

				<label>Hora</label>

				<input type="time" value="'.$respuesta["nov_hora"].'" name="horaNovedad" required>

				<label>Municipio</label>

				<select name="lugarNovedad" required>
						
					'.$valorLugar.'

				</select>

				<label>Tipo de novedad</label>

				<select name="tipoNovedad" required>
						
					'.$tpoNov.'

				</select>

				<label>Descripción</label>

				<input type="text" value="'.$respuesta["nov_desc"].'" name="descripcionNovedad" required>

				<label>Valor estimado</label>

				<input type="text" value="'.$respuesta["nov_costo"].'" name="valorNovedad" required>

				<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR NOVEDAD
	#-------------------------------------

	public function actualizarNovedadController(){

		if(isset($_POST["idNovedad"])){

			$datosController = array(	"idNovedad"=>$_POST["idNovedad"],
										"idAsigNovedad"=>$_POST["idAsigNovedad"],
										"fechaNovedad"=>$_POST["fechaNovedad"],
										"horaNovedad"=>$_POST["horaNovedad"],
										"lugarNovedad"=>$_POST["lugarNovedad"],
										"tipoNovedad"=>$_POST["tipoNovedad"],
										"descripcionNovedad"=>$_POST["descripcionNovedad"],
										"valorNovedad"=>$_POST["valorNovedad"]);


			$respuesta = DatosNovedad::actualizarNovedadModel($datosController, "novedad");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_novedad");

			}else{

				echo "error";

			}

		}

	}

	#BORRAR NOVEDAD
	#-------------------------------------

	public function borrarNovedadController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosNovedad::borrarNovedadModel($datosController, "novedad");

			if($respuesta == "success"){

				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_novedad");
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