<?php
ob_start();
class MvcControllerUsuario{

	#REGISTRO DE USUARIOS
	#-------------------------------------

	public function registroUsuarioController(){

		if(isset($_POST["usuarioRegistro"]) && filter_var($_POST["emailRegistro"], FILTER_VALIDATE_EMAIL)){

			// $passHash = password_hash($_POST["password"], PASSWORD_BCRYPT);

			$datosController = array(	"usuario"=>$_POST["usuarioRegistro"],
										"password"=>$_POST["password"],
										"email"=>$_POST["emailRegistro"]);

			$respuesta = DatosUsuario::registroUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){
				header("location:index.php?action=ok");
			}else{
				header("location:index.php");
			}
		}elseif(isset($_POST["usuarioRegistro"]) && !filter_var($_POST["emailRegistro"], FILTER_VALIDATE_EMAIL)){

			echo '<p class="fallo">Correo electrónico no válido.</p>';

		}
	}

	#INGRESO DE USUARIOS
	#-------------------------------------

	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			$datosController = array(	"usuario"=>$_POST["usuarioIngreso"],
										"password"=>$_POST["passwordIngreso"]);

			$respuesta = DatosUsuario::ingresoUsuarioModel($datosController, "usuarios");

			if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){

				$_SESSION["validar"] = $respuesta["usuario"];

				header("location:index.php?action=usuarios");

			}else{

				header("location:index.php?action=fallo");

			}

		}

	}

	#VISTA DE USUARIOS
	#-------------------------------------

	public function vistaUsuariosController(){

		$respuesta = DatosUsuario::vistaUsuariosModel("usuarios");

		$controlador = 'consulta_usuarios';

		echo '		<script>
					  	var controlador = "consulta_usuarios";
					</script>';

		foreach ($respuesta as $row => $item) {
			echo '<tr>
					<td>'.$item["usuario"].'</td>
					<td>'.$item["password"].'</td>
					<td>'.$item["email"].'</td>
					<td><a href="index.php?action=editar_usuario&id='.$item["id"].'"><button>Editar</button></a></td>
					<td><a href="#" onclick="confirma('.$item["id"].', controlador)";><button>Borrar</button></a></td>
				</tr>';
		}

		
	}

	#EDITAR USUARIOS
	#-------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["id"];

		$respuesta = DatosUsuario::editarUsuarioModel($datosController, "usuarios");

		echo 	'<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

				<input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required>

				<input type="text" value="'.$respuesta["password"].'" name="passwordEditar" required>

				<input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>

				<input type="submit" value="Actualizar">';
	}


	#ACTUALIZAR USUARIOS
	#-------------------------------------

	public function actualizarUsuarioController(){

		if(isset($_POST["usuarioEditar"]) && filter_var($_POST["emailEditar"], FILTER_VALIDATE_EMAIL)){

			$datosController = array(	"id"=>$_POST["idEditar"],
										"usuario"=>$_POST["usuarioEditar"],
										"password"=>$_POST["passwordEditar"],
										"email"=>$_POST["emailEditar"]);


			$respuesta = DatosUsuario::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=cambio_usuario");

			}else{

				echo "Datos incorrectos";

			}

		}elseif(isset($_POST["usuarioEditar"]) && !filter_var($_POST["emailEditar"], FILTER_VALIDATE_EMAIL)){

			echo '<p class="fallo">Correo electrónico no válido.</p>';

		}

	}

	#BORRAR USUARIO
	#-------------------------------------

	public function borrarUsuarioController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = DatosUsuario::borrarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				if (headers_sent()) {
				    // las cabeceras ya se han enviado, no intentar añadir una nueva
				}
				else {
				    // es posible añadir nuevas cabeceras HTTP
				    header("location:index.php?action=consulta_usuarios");
				}
				

			}else{

				echo "error";

			}

		}

	}
}

?>