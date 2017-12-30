<?php  

require_once "conexion.php";

class DatosMercancia extends Conexion{

	#INGRESO DE MERCANCIA
	#------------------------------------
	public function ingresoMercanciaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(mer_riesgo, mer_hor, mer_contenido) VALUES (:riesgoMer,:horarioMer,:contenidoMer)");


		$stmt->bindParam(":riesgoMer", $datosModel["riesgoMer"], PDO::PARAM_STR);
		$stmt->bindParam(":horarioMer", $datosModel["horarioMer"], PDO::PARAM_STR);
		$stmt->bindParam(":contenidoMer", $datosModel["contenidoMer"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE MERCANCIAS
	#------------------------------------

	public function vistaMercanciasModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_mer, mer_riesgo, mer_hor, mer_contenido FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR MERCANCIA
	#------------------------------------

	public function editarMercanciaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_mer, mer_riesgo, mer_hor, mer_contenido FROM $tabla WHERE id_mer= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR MERCANCIA
	#------------------------------------

	public function actualizarMercanciaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET mer_riesgo = :riesgoMercancia, mer_hor = :horarioMercancia, mer_contenido = :contenidoMercancia WHERE id_mer = :id");

		$stmt->bindParam(":riesgoMercancia", $datosModel["riesgoMercancia"], PDO::PARAM_STR);
		$stmt->bindParam(":horarioMercancia", $datosModel["horarioMercancia"], PDO::PARAM_STR);
		$stmt->bindParam(":contenidoMercancia", $datosModel["contenidoMercancia"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["idMercancia"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR MERCANCIA
	#------------------------------------

	public function borrarMercanciaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_mer = :id");

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