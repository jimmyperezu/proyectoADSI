<?php

class MvcControllerRuta{

	#INGRESO DE RUTA
	#-------------------------------------

	public function ingresoRutaController(){

		if(isset($_POST["origenRuta"])){

			$origenDestino = $_POST["origenRuta"]." - ".$_POST["destinoRuta"];

			// $origenDestino = "prueba2";

			$datosController = array(	"origenDestino"=>$origenDestino,
										"distanciaRuta"=>$_POST["distanciaRuta"],
										"duracionRuta"=>$_POST["duracionRuta"]);

			$respuesta = DatosRuta::ingresoRutaModel($datosController, "ruta");

			if($respuesta == "success"){

				header("location:index.php?action=i_ruta");
				
			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}
		}
	}

	#VISTA DE RUTAS
	#-------------------------------------

	public function vistaRutasController(){

		$respuesta = DatosRuta::vistaRutasModel("ruta");

		$controlador = 'consulta_ruta';

		echo '		<script>
					  	var controlador = "consulta_ruta";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["rut_origen_destino"].'</td>
					<td>'.$item["rut_distancia"].'</td>
					<td>'.$item["rut_dur_estimada"].'</td>
					<td><a href="index.php?action=editar_ruta&id='.$item["id_rut"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id_rut"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR RUTA
	#-------------------------------------

	public function editarRutaController(){

		$datosController = $_GET["id"];

		$respuesta = DatosRuta::editarRutaModel($datosController, "ruta");

		$descripcion = $respuesta["rut_origen_destino"];

		list($a, $b) = explode(' - ', $descripcion);

		$obj = new FuncionesController();

		$datos = $obj -> cargarSelectController("municipio", "nom_mun");
					
		$valorOrigen = "";

		foreach ($datos as $row => $item) {

			if(utf8_encode($item["nom_mun"]) == $a){

				$valorOrigen = $valorOrigen .'<option selected="selected">'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}elseif($item["nom_mun"] != $a){

				$valorOrigen = $valorOrigen .'<option>'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}
			
		}

		$valorDestino = "";

		foreach ($datos as $row => $item) {

			if(utf8_encode($item["nom_mun"]) == $b){

				$valorDestino = $valorDestino .'<option selected="selected">'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}elseif($item["nom_mun"] != $b){

				$valorDestino = $valorDestino .'<option>'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}
			
		}

		echo 	'<input type="hidden" value="'.$respuesta["id_rut"].'" name="idRuta">

				<label>Origen</label>

				<select name="origenRuta" required>
						
					'.$valorOrigen.'

				</select>

				<label>Destino</label>

				<select name="destinoRuta" required>
						
					'.$valorDestino.'

				</select>

				<label>Distancia</label>

				<input type="text" value="'.$respuesta["rut_distancia"].'" name="distanciaRuta" required>

				<label>Duración estimada</label>

				<input type="text" value="'.$respuesta["rut_dur_estimada"].'" name="duracionRuta" required>

				<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR RUTA
	#-------------------------------------

	public function actualizarRutaController(){

		if(isset($_POST["idRuta"])){

			$origenDestino = $_POST["origenRuta"]." - ".$_POST["destinoRuta"];

			$datosController = array(	"idRuta"=>$_POST["idRuta"],
										"origenDestino"=>$origenDestino,
										"distanciaRuta"=>$_POST["distanciaRuta"],
										"duracionRuta"=>$_POST["duracionRuta"]);


			$respuesta = DatosRuta::actualizarRutaModel($datosController, "ruta");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_ruta");

			}else{

				echo "error";

			}

		}

	}

	#BORRAR RUTA
	#-------------------------------------

	public function borrarRutaController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosRuta::borrarRutaModel($datosController, "ruta");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_ruta");
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