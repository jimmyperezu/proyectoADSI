<?php

class MvcControllerCliente{

	#INGRESO DE CLIENTE
	#-------------------------------------

	public function ingresoClienteController(){

		if(isset($_POST["idClienteRegistro"])){

			$datosController = array(	"idCliente"=>$_POST["idClienteRegistro"],
										"tipoCliente"=>$_POST["tipoClienteRegistro"],
										"nombreCliente"=>$_POST["nombreClienteRegistro"],
										"apellidoCliente"=>$_POST["apellidoClienteRegistro"],
										"direccionCliente"=>$_POST["direccionClienteRegistro"],
										"telefonoCliente"=>$_POST["telefonoClienteRegistro"],
										"municipioCliente"=>$_POST["municipioClienteRegistro"]);

			$respuesta = DatosCliente::ingresoClienteModel($datosController, "cliente");

			if($respuesta == "success"){

				header("location:index.php?action=i_cliente");

			}else{

				echo '<p class="fallo">Error en los datos ingresados.</p>';

			}
		}
	}

	#VISTA DE CLIENTES
	#-------------------------------------

	public function vistaClientesController(){

		$respuesta = DatosCliente::vistaClientesModel("cliente");

		$controlador = 'consulta_cliente';

		echo '		<script>
					  	var controlador = "consulta_cliente";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["id_cli"].'</td>
					<td>'.$item["cli_tpo_id"].'</td>
					<td>'.$item["cli_nom"].'</td>
					<td>'.$item["cli_ape"].'</td>
					<td>'.$item["cli_dir"].'</td>
					<td>'.$item["cli_tel"].'</td>
					<td>'.$item["cli_mun"].'</td>
					<td><a href="index.php?action=editar_cliente&id='.$item["id_cli"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id_cli"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR CLIENTES
	#-------------------------------------

	public function editarClienteController(){

		$datosController = $_GET["id"];

		$respuesta = DatosCliente::editarClienteModel($datosController, "cliente");

		$docSel;

		if($respuesta["cli_tpo_id"] == "Cédula de ciudadanía"){
			$docSel = '		<option value="Cédula de ciudadanía" selected="selected">Cédula de ciudadanía</option>
							<option value="Cédula de extranjería">Cédula de extranjería</option>
							<option value="NIT">NIT</option>';
		}elseif($respuesta["cli_tpo_id"] == "Cédula de extranjería" ){
			$docSel = '		<option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
							<option value="Cédula de extranjería" selected="selected">Cédula de extranjería</option>
							<option value="NIT">NIT</option>';
		}elseif($respuesta["cli_tpo_id"] == "NIT"){
			$docSel = '		<option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
							<option value="Cédula de extranjería">Cédula de extranjería</option>
							<option value="NIT" selected="selected">NIT</option>';
		}

		$obj = new FuncionesController();

		$datos = $obj -> cargarSelectController("municipio", "nom_mun");
					
		$valorMunicipio = "";

		foreach ($datos as $row => $item) {

			if(utf8_encode($item["nom_mun"]) == $respuesta["cli_mun"]){

				$valorMunicipio = $valorMunicipio .'<option selected="selected">'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}elseif($item["nom_mun"] != $respuesta["cli_mun"]){

				$valorMunicipio = $valorMunicipio .'<option>'
											.utf8_encode($item["nom_mun"]).
											"</option>";
			}
			
		}

		echo 		'<input type="hidden" value="'.$respuesta["id_cli"].'" name="idClienteAnterior" required>

					<label>Identificación</label>

					<input type="text" value="'.$respuesta["id_cli"].'" name="idClienteEditar" required>

					<label>Tipo de documento</label>

					<select name="tipoClienteEditar" required>
						
						'.$docSel.'
					  
					</select>

					<label>Nombres</label>

					<input type="text" value="'.$respuesta["cli_nom"].'" name="nombreClienteEditar" required>

					<label>Apellidos</label>

					<input type="text" value="'.$respuesta["cli_ape"].'" name="apellidoClienteEditar" required>

					<label>Dirección</label>

					<input type="text" value="'.$respuesta["cli_dir"].'" name="direccionClienteEditar" required>

					<label>Teléfono</label>

					<input type="text" value="'.$respuesta["cli_tel"].'" name="telefonoClienteEditar" required>

					<label>Municipio</label>

					<select name="municipioClienteEditar" required>
						
						'.$valorMunicipio.'

					</select>

					<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR CLIENTES
	#-------------------------------------

	public function actualizarClienteController(){

		if(isset($_POST["idClienteEditar"])){

			$datosController = array(	"idClienteAnterior"=>$_POST["idClienteAnterior"],
										"idCliente"=>$_POST["idClienteEditar"],
										"tipoCliente"=>$_POST["tipoClienteEditar"],
										"nombreCliente"=>$_POST["nombreClienteEditar"],
										"apellidoCliente"=>$_POST["apellidoClienteEditar"],
										"direccionCliente"=>$_POST["direccionClienteEditar"],
										"telefonoCliente"=>$_POST["telefonoClienteEditar"],
										"municipioCliente"=>$_POST["municipioClienteEditar"]);

			$respuesta = DatosCliente::actualizarClienteModel($datosController, "cliente");

			if($respuesta == "success"){
				header("location:index.php?action=cambio_cliente");
			}else{
				echo '<p class="fallo">Error en los datos ingresados.</p>';
			}
		}

	}

	#BORRAR CLIENTES
	#-------------------------------------

	public function borrarClienteController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosCliente::borrarClienteModel($datosController, "cliente");

			if($respuesta == "success"){
				if (headers_sent()) {

				}else{
					header("location:index.php?action=consulta_cliente");
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