<?php  

if(!isset($_SESSION)){
	session_start();
}

$estado = false;

if(isset($_SESSION["validar"])){
	$estado = true;
}

if($estado){
	$textoEnlace = "Cerrar sesión";
	$referencia = "index.php?action=salir";

	$saludo = "Bienvenido ".$_SESSION["validar"];

	echo '	<div class="salir">
				<span class="saludo">'.$saludo.'</span>
				<a href="'.$referencia.'">'.$textoEnlace.'</a>
			</div>';

}else{

	$textoEnlace = "Iniciar sesión";
	$referencia = "index.php?action=inicio_sesion";

	$saludo = "";

	echo '	<div class="salir">
				<a href="'.$referencia.'">'.$textoEnlace.'</a>
				<a href="index.php?action=registro_usuario">Registrarse</a>
			</div>';
	
}


?>