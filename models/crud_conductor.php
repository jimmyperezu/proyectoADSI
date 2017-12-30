<?php  

require_once "conexion.php";

class DatosConductor extends Conexion{

	#INGRESO DE CONDUCTOR
	#------------------------------------
	public function ingresoConductorModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_ctor, ctor_tpo_id, ctor_agcia, ctor_tpo_cto, ctor_nom, ctor_ape, ctor_dir, ctor_cel, ctor_mun) VALUES (:idConductor,:tipoConductor,:agenciaConductor,:tipoContrato,:nombreConductor,:apellidoConductor,:direccionConductor,:celularConductor,:municipioConductor)");

		$stmt->bindParam(":idConductor", $datosModel["idConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoConductor", $datosModel["tipoConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":agenciaConductor", $datosModel["agenciaConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoContrato", $datosModel["tipoContrato"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreConductor", $datosModel["nombreConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoConductor", $datosModel["apellidoConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":direccionConductor", $datosModel["direccionConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":celularConductor", $datosModel["celularConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":municipioConductor", $datosModel["municipioConductor"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE CONDUCTORES
	#------------------------------------

	public function vistaConductoresModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_ctor, ctor_tpo_id, ctor_agcia, ctor_tpo_cto, ctor_nom, ctor_ape, ctor_dir, ctor_cel, ctor_mun FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR CONDUCTOR
	#------------------------------------

	public function editarConductorModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_ctor, ctor_tpo_id, ctor_agcia, ctor_tpo_cto, ctor_nom, ctor_ape, ctor_dir, ctor_cel, ctor_mun FROM $tabla WHERE id_ctor= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR CONDUCTOR
	#------------------------------------

	public function actualizarConductorModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_ctor = :idConductor, ctor_tpo_id = :tipoIdConductor, ctor_agcia = :agenciaConductor, ctor_tpo_cto = :tipoCtoConductor, ctor_nom = :nombreConductor, ctor_ape = :apellidoConductor, ctor_dir = :direccionConductor, ctor_cel = :celularConductor, ctor_mun = :municipioConductor WHERE id_ctor = :idConductorAnterior");

		$stmt->bindParam(":idConductor", $datosModel["idConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoIdConductor", $datosModel["tipoIdConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":agenciaConductor", $datosModel["agenciaConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoCtoConductor", $datosModel["tipoCtoConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreConductor", $datosModel["nombreConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoConductor", $datosModel["apellidoConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":direccionConductor", $datosModel["direccionConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":celularConductor", $datosModel["celularConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":municipioConductor", $datosModel["municipioConductor"], PDO::PARAM_STR);
		$stmt->bindParam(":idConductorAnterior", $datosModel["idConductorAnterior"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR CONDUCTOR
	#------------------------------------

	public function borrarConductorModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_ctor = :idConductor");

		$stmt->bindParam(":idConductor", $datosModel, PDO::PARAM_STR);

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