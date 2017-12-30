<?php

class MvcControllerFlete{

	#INGRESO DE FLETE
	#-------------------------------------

	public function ingresoFleteController(){

		if(isset($_POST["idPreFlete"])){

			$datosController = array(	"idPreFlete"=>$_POST["idPreFlete"],
										"valorFlete"=>$_POST["valorFlete"]);

			$respuesta = DatosFlete::ingresoFleteModel($datosController, "flete");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=i_flete");
				}
				
			}else{
				echo '<p class="fallo">Error en los datos ingresados.</p>';
			}
		}
	}

	#VISTA DE FLETES
	#-------------------------------------

	public function vistaFletesController(){

		$respuesta = DatosFlete::vistaFletesModel("flete");

		$controlador = 'consulta_flete';

		echo '		<script>
					  	var controlador = "consulta_flete";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["id_fle"].'</td>
					<td>'.$item["id_fle_pre"].'</td>
					<td>'.$item["fle_val"].'</td>
					<td><a href="index.php?action=editar_flete&id='.$item["id_fle"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id_fle"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR FLETE
	#-------------------------------------

	public function editarFleteController(){

		$datosController = $_GET["id"];

		$respuesta = DatosFlete::editarFleteModel($datosController, "flete");

		$obj = new FuncionesController();

		$datosPresupuesto = $obj -> cargarSelectController("presupuesto", "id_pre");
					
		$valorPresupuesto = "";

		foreach ($datosPresupuesto as $row => $item) {

			if(utf8_encode($item["id_pre"]) == $respuesta["id_fle_pre"]){

				$valorPresupuesto = $valorPresupuesto .'<option selected="selected">'
											.utf8_encode($item["id_pre"]).
											"</option>";
			}elseif($item["id_pre"] != $respuesta["id_fle_pre"]){

				$valorPresupuesto = $valorPresupuesto .'<option>'
											.utf8_encode($item["id_pre"]).
											"</option>";
			}
			
		}

		echo '	<input type="hidden" value="'.$respuesta["id_fle"].'" name="idFlete" required>

				<label>Presupuesto</label>

				<select name="idPreFlete" required>
						
					'.$valorPresupuesto.'

				</select>


				<label>Valor flete</label>

				<input type="text" value="'.$respuesta["fle_val"].'" name="valorFlete" required>

				<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR FLETE
	#-------------------------------------

	public function actualizarFleteController(){

		if(isset($_POST["idFlete"])){

			$datosController = array(	"idFlete"=>$_POST["idFlete"],
										"idPreFlete"=>$_POST["idPreFlete"],
										"valorFlete"=>$_POST["valorFlete"]);


			$respuesta = DatosFlete::actualizarFleteModel($datosController, "flete");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_flete");

			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}

		}

	}

	#BORRAR FLETE
	#-------------------------------------

	public function borrarFleteController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosFlete::borrarFleteModel($datosController, "flete");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_flete");
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