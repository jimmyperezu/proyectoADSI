<?php  

require_once "conexion.php";

class DatosHorario extends Conexion{

	#INGRESO DE HORARIO
	#------------------------------------
	public function ingresoHorarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(hor_tpo) VALUES (:rango)");

		$stmt->bindParam(":rango", $datosModel, PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE HORARIOS
	#------------------------------------

	public function vistaHorariosModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_hor, hor_tpo FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR HORARIO
	#------------------------------------

	public function editarHorarioModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_hor, hor_tpo FROM $tabla WHERE id_hor= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR HORARIO
	#------------------------------------

	public function actualizarHorarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET hor_tpo = :rangoHorario WHERE id_hor = :idHorario");

		$stmt->bindParam(":rangoHorario", $datosModel["rangoHorario"], PDO::PARAM_STR);
		$stmt->bindParam(":idHorario", $datosModel["idHorario"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR HORARIO
	#------------------------------------

	public function borrarHorarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_hor = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

}


?>