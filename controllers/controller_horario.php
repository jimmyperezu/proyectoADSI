<?php

class MvcControllerHorario{

	#INGRESO DE HORARIO
	#-------------------------------------

	public function ingresoHorarioController(){

		if(isset($_POST["rangoHorario"])){

			$datosController = $_POST["rangoHorario"];

			$respuesta = DatosHorario::ingresoHorarioModel($datosController, "horario");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=i_horario");
				}
				
			}else{
				header("location:index.php");
			}
		}
	}

	#VISTA DE HORARIOS
	#-------------------------------------

	public function vistaHorariosController(){

		$respuesta = DatosHorario::vistaHorariosModel("horario");

		$controlador = 'consulta_horario';

		echo '		<script>
					  	var controlador = "consulta_horario";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["hor_tpo"].'</td>
					<td><a href="index.php?action=editar_horario&id='.$item["id_hor"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id_hor"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR HORARIO
	#-------------------------------------

	public function editarHorarioController(){

		$datosController = $_GET["id"];

		$respuesta = DatosHorario::editarHorarioModel($datosController, "horario");

		echo 		'<input type="hidden" value="'.$respuesta["id_hor"].'" name="idHorarioEditar" required>

					<label>Rango</label>

					<input type="text" value="'.$respuesta["hor_tpo"].'" name="rangoHorarioEditar" required>

					<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR HORARIO
	#-------------------------------------

	public function actualizarHorarioController(){

		if(isset($_POST["rangoHorarioEditar"])){

			$datosController = array(	  "idHorario"=>$_POST["idHorarioEditar"],
						                  "rangoHorario"=>$_POST["rangoHorarioEditar"]);

			$respuesta = DatosHorario::actualizarHorarioModel($datosController, "horario");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_horario");

			}else{

				echo "Datos incorrectos";

			}

		}

	}

	#BORRAR HORARIO
	#-------------------------------------

	public function borrarHorarioController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosHorario::borrarHorarioModel($datosController, "horario");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_horario");
				}
				

			}else{

				echo "error";

			}

		}

	}
}

?>