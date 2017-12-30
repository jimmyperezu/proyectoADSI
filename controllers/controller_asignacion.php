<?php

class MvcControllerAsignacion{

	#INGRESO DE ASIGNACION
	#-------------------------------------

	public function ingresoAsignacionController(){

		if(isset($_POST["clienteAsig"]) && ($_POST["fechaRegistroAsig"] <= $_POST["fechaEntregaAsig"])){

			$datosController = array(	"clienteAsig"=>$_POST["clienteAsig"],
										"contenidoMercanciaAsig"=>$_POST["contenidoMercanciaAsig"],
										"municipioAgenciaAsig"=>$_POST["municipioAgenciaAsig"],
										"fechaRegistroAsig"=>$_POST["fechaRegistroAsig"],
										"fechaEntregaAsig"=>$_POST["fechaEntregaAsig"],
										"estadoAsig"=>$_POST["estadoAsig"]);


			$respuesta = DatosAsignacion::ingresoAsignacionModel($datosController, "asignacion");

			/*Si el valor obtenido enn $respuesta es "success" */
			if($respuesta == "success"){

				header("location:index.php?action=i_asignacion");

			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}
		}
	}


	#VISTA DE ASIGNACIONES
	#-------------------------------------

	public function vistaAsignacionesController(){

		$respuesta = DatosAsignacion::vistaAsignacionesModel("asignacion");

		$controlador = 'consulta_asignacion';

		echo '		<script>
					  	var controlador = "consulta_asignacion";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["id_asi"].'</td>
					<td>'.$item["asi_cli"].'</td>
					<td>'.$item["asi_mer"].'</td>
					<td>'.$item["asi_agcia"].'</td>
					<td>'.$item["asi_fec_reg"].'</td>
					<td>'.$item["asi_fec_ent"].'</td>
					<td>'.$item["asi_estado"].'</td>
					<td><a href="index.php?action=editar_asignacion&id='.$item["id_asi"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id_asi"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR ASIGNACION
	#-------------------------------------

	public function editarAsignacionController(){

		$datosController = $_GET["id"];

		$respuesta = DatosAsignacion::editarAsignacionModel($datosController, "asignacion");

		$obj = new FuncionesController();

		$datosCliente = $obj -> cargarSelectController("cliente", "id_cli");
					
		$valorCliente = "";

		foreach ($datosCliente as $row => $item) {

			if(utf8_encode($item["id_cli"]) == $respuesta["asi_cli"]){

				$valorCliente = $valorCliente .'<option selected="selected">'
											.utf8_encode($item["id_cli"]).
											"</option>";
			}elseif($item["id_cli"] != $respuesta["asi_cli"]){

				$valorCliente = $valorCliente .'<option>'
											.utf8_encode($item["id_cli"]).
											"</option>";
			}
			
		}

		$datosMercancia = $obj -> cargarSelectController("mercancia", "mer_contenido");
					
		$valorMercancia = "";

		foreach ($datosMercancia as $row => $item) {

			if($item["mer_contenido"] == $respuesta["asi_mer"]){ 

				$valorMercancia = $valorMercancia .'<option selected="selected">'
											.$item["mer_contenido"].
											"</option>";

			}elseif($item["mer_contenido"] != $respuesta["asi_mer"]){ 

				$valorMercancia = $valorMercancia .'<option>'
											.$item["mer_contenido"].
											"</option>";

			}
			
		}

		$datosAgencia = $obj -> cargarSelectController("agencia", "agcia_mcpio");
					
		$valorAgencia = "";

		foreach ($datosAgencia as $row => $item) {

			if($item["agcia_mcpio"] == $respuesta["asi_agcia"]){ 

				$valorAgencia = $valorAgencia .'<option selected="selected">'
											.$item["agcia_mcpio"].
											"</option>";

			}elseif($item["agcia_mcpio"] != $respuesta["asi_agcia"]){ 

				$valorAgencia = $valorAgencia .'<option>'
											.$item["agcia_mcpio"].
											"</option>";

			}
			
		}

		$estSel;

		if($respuesta["asi_estado"] == "Entregado"){
			$estSel = '		<option value="Entregado" selected="selected">Entregado</option>
		                    <option value="En Proceso">En Proceso</option>';
		}elseif($respuesta["asi_estado"] == "En Proceso" ){
			$estSel = '		<option value="Entregado">Entregado</option>
		                    <option value="En Proceso" selected="selected">En Proceso</option>';
		}

		echo '	<input type="hidden" value="'.$respuesta["id_asi"].'" name="idAsignacion" required>

				<label>Cliente</label>

				<select name="clienteAsig" required>
						
					'.$valorCliente.'

				</select>

				<label>Contenido mercancía</label>

				<select name="contenidoMercanciaAsig" required>
						
					'.$valorMercancia.'

				</select>

				<label>Agencia</label>

				<select name="municipioAgenciaAsig" required>
						
					'.$valorAgencia.'

				</select>

				<label>Fecha registro</label>

				<input type="date" value="'.$respuesta["asi_fec_reg"].'" name="fechaRegistroAsig" required>

				<label>Fecha entrega</label>

				<input type="date" value="'.$respuesta["asi_fec_ent"].'" name="fechaEntregaAsig" required>

				<label>Estado</label>

				<select name="estadoAsig" required>
						
					'.$estSel.'

				</select>

				<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR ASIGNACION
	#-------------------------------------

	public function actualizarAsignacionController(){

		if(isset($_POST["idAsignacion"])){

			$datosController = array(	"idAsignacion"=>$_POST["idAsignacion"],
										"clienteAsig"=>$_POST["clienteAsig"],
										"contenidoMercanciaAsig"=>$_POST["contenidoMercanciaAsig"],
										"municipioAgenciaAsig"=>$_POST["municipioAgenciaAsig"],
										"fechaRegistroAsig"=>$_POST["fechaRegistroAsig"],
										"fechaEntregaAsig"=>$_POST["fechaEntregaAsig"],
										"estadoAsig"=>$_POST["estadoAsig"]);


			$respuesta = DatosAsignacion::actualizarAsignacionModel($datosController, "asignacion");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_asignacion");

			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}

		}

	}

	#BORRAR ASIGNACION
	#-------------------------------------

	public function borrarAsignacionController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosAsignacion::borrarAsignacionModel($datosController, "asignacion");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_asignacion");
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