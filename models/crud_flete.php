<?php  

require_once "conexion.php";

class DatosFlete extends Conexion{

	#INGRESO DE FLETE
	#------------------------------------
	public function ingresoFleteModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_fle_pre, fle_val) VALUES (:idPreFlete,:valorFlete)");

		$stmt->bindParam(":idPreFlete", $datosModel["idPreFlete"], PDO::PARAM_INT);
		$stmt->bindParam(":valorFlete", $datosModel["valorFlete"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE FLETES
	#------------------------------------

	public function vistaFletesModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_fle, id_fle_pre, fle_val FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR FLETE
	#------------------------------------

	public function editarFleteModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_fle, id_fle_pre, fle_val FROM $tabla WHERE id_fle= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR FLETE
	#------------------------------------

	public function actualizarFleteModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_fle_pre = :idPreFlete, fle_val = :valorFlete WHERE id_fle = :idFlete");

		$stmt->bindParam(":idPreFlete", $datosModel["idPreFlete"], PDO::PARAM_INT);
		$stmt->bindParam(":valorFlete", $datosModel["valorFlete"], PDO::PARAM_STR);
		$stmt->bindParam(":idFlete", $datosModel["idFlete"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR FLETE
	#------------------------------------

	public function borrarFleteModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_fle = :id");

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