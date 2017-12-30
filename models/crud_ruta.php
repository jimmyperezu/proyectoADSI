<?php  

require_once "conexion.php";

class DatosRuta extends Conexion{

	#INGRESO DE RUTA
	#------------------------------------
	public function ingresoRutaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(rut_origen_destino, rut_distancia, rut_dur_estimada) VALUES (:origen_destino,:distanciaRuta,:duracionRuta)");

		$stmt->bindParam(":origen_destino", $datosModel["origenDestino"], PDO::PARAM_STR);

		$stmt->bindParam(":distanciaRuta", $datosModel["distanciaRuta"], PDO::PARAM_INT);

		$stmt->bindParam(":duracionRuta", $datosModel["duracionRuta"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE RUTAS
	#------------------------------------

	public function vistaRutasModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_rut, rut_origen_destino, rut_distancia, rut_dur_estimada FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR RUTA
	#------------------------------------

	public function editarRutaModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_rut, rut_origen_destino, rut_distancia, rut_dur_estimada FROM $tabla WHERE id_rut= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR RUTA
	#------------------------------------

	public function actualizarRutaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET rut_origen_destino = :origen_destino, rut_distancia = :distanciaRuta, rut_dur_estimada = :duracionRuta WHERE id_rut = :idRuta");

		$stmt->bindParam(":origen_destino", $datosModel["origenDestino"], PDO::PARAM_STR);

		$stmt->bindParam(":distanciaRuta", $datosModel["distanciaRuta"], PDO::PARAM_STR);
		$stmt->bindParam(":duracionRuta", $datosModel["duracionRuta"], PDO::PARAM_STR);
		$stmt->bindParam(":idRuta", $datosModel["idRuta"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR RUTA
	#------------------------------------

	public function borrarRutaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_rut = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#CARGAR CONTENIDO
	#-------------------------------------

	public function cargarSelectModel($tabla, $campo){
		
		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT $campo FROM $tabla ORDER BY $campo");

		if($stmt->execute()){
			return $stmt->fetchAll();
		}else{
			return "error";
		}

		$stmt->close();

	}

}


?>