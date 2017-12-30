<?php

class MvcControllerAgencia{

	#INGRESO DE AGENCIA
	#-------------------------------------

	public function ingresoAgenciaController(){

		if(isset($_POST["municipioAgencia"]) && filter_var($_POST["emailAgencia"], FILTER_VALIDATE_EMAIL)){

			$datosController = array(	"municipioAgencia"=>$_POST["municipioAgencia"],
										"celularAgencia"=>$_POST["celularAgencia"],
										"emailAgencia"=>$_POST["emailAgencia"]);

			$respuesta = DatosAgencia::ingresoAgenciaModel($datosController, "agencia");

			if($respuesta == "success"){

				header("location:index.php?action=i_agcia");
				
			}else{
				echo '<p class="fallo">Error en los datos ingresados.</p>';
			}
		}elseif(isset($_POST["municipioAgencia"]) && !filter_var($_POST["emailAgencia"], FILTER_VALIDATE_EMAIL)){

			echo '<p class="fallo">Correo electrónico no válido.</p>';

		}
	}

	#VISTA DE AGENCIAS
	#-------------------------------------


	public function vistaAgenciasController(){

		$respuesta = DatosAgencia::vistaAgenciasModel("agencia");

		$controlador = 'consulta_agencia';

		echo '		<script>
					  	var controlador = "consulta_agencia";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '	<tr>
						<td>'.$item["agcia_mcpio"].'</td>
						<td>'.$item["agcia_celular"].'</td>
						<td>'.$item["agcia_correo"].'</td>
						<td><a href="index.php?action=editar_agencia&id='.$item["id_agcia"].'"><button>Editar</button></a></td>
						<td><a href="#" onclick="confirma('.$item["id_agcia"].', controlador)";><button>Borrar</button></a></td>
					</tr>';
		}
	}

	#EDITAR AGENCIA
	#-------------------------------------

	public function editarAgenciaController(){

		$datosController = $_GET["id"];

		$respuesta = DatosAgencia::editarAgenciaModel($datosController, "agencia");

		$obj = new FuncionesController();

		$datos = $obj -> cargarSelectController("municipio", "nom_mun");
					
		$valorMunicipio = "";

		foreach ($datos as $row => $item) {

			if(utf8_encode($item["nom_mun"]) == $respuesta["agcia_mcpio"]){

				$valorMunicipio = $valorMunicipio .'<option selected="selected">'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}elseif($item["nom_mun"] != $respuesta["agcia_mcpio"]){

				$valorMunicipio = $valorMunicipio .'<option>'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}
			
		}

		echo 	'<input type="hidden" value ="'.$respuesta["id_agcia"].'" name="idAgenciaEditar" required>

				<label>Municipio</label>

				<select name="municipioAgenciaEditar" required>
						
					'.$valorMunicipio.'

				</select>

				<label>Celular</label>

				<input type="text" value="'.$respuesta["agcia_celular"].'" name="celularAgenciaEditar" required>

				<label>Correo electrónico</label>

				<input type="email" value="'.$respuesta["agcia_correo"].'" name="emailAgenciaEditar" required>

				<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR AGENCIA
	#-------------------------------------

	public function actualizarAgenciaController(){

		if(isset($_POST["municipioAgenciaEditar"]) && filter_var($_POST["emailAgenciaEditar"], FILTER_VALIDATE_EMAIL)){
			    
			$datosController = array(	  "idAgencia"=>$_POST["idAgenciaEditar"],
						                  "municipioAgencia"=>$_POST["municipioAgenciaEditar"],
						                  "celularAgencia"=>$_POST["celularAgenciaEditar"],
			                              "emailAgencia"=>$_POST["emailAgenciaEditar"]);


			$respuesta = DatosAgencia::actualizarAgenciaModel($datosController, "agencia");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_agencia");

			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}

		}elseif(isset($_POST["municipioAgenciaEditar"]) && !filter_var($_POST["emailAgenciaEditar"], FILTER_VALIDATE_EMAIL)){

			echo '<p class="fallo">Correo electrónico no válido.</p>';

		}

	}

	#BORRAR AGENCIA
	#-------------------------------------

	public function borrarAgenciaController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosAgencia::borrarAgenciaModel($datosController, "agencia");

			if($respuesta == "success"){

				if (headers_sent()) {
				    
				}
				else {
				    header("location:index.php?action=consulta_agencia");
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