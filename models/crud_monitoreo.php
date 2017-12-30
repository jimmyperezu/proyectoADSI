<?php  

require_once "conexion.php";

class DatosMonitoreo extends Conexion{

	#INGRESO DE MONITOREO
	#------------------------------------
	public function ingresoMonitoreoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_mon_asi, mon_pto_ctrl, mon_fecha, mon_hora, mon_estado) VALUES (:idAsigMonitoreo,:ptoCtrlMonitoreo,:fechaMonitoreo,:horaMonitoreo,:estadoMonitoreo)");

		$stmt->bindParam(":idAsigMonitoreo", $datosModel["idAsigMonitoreo"], PDO::PARAM_INT);
		$stmt->bindParam(":ptoCtrlMonitoreo", $datosModel["ptoCtrlMonitoreo"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaMonitoreo", $datosModel["fechaMonitoreo"], PDO::PARAM_STR);
		$stmt->bindParam(":horaMonitoreo", $datosModel["horaMonitoreo"], PDO::PARAM_STR);
		$stmt->bindParam(":estadoMonitoreo", $datosModel["estadoMonitoreo"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE MONITOREO
	#------------------------------------

	public function vistaMonitoreosModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_mon, id_mon_asi, mon_pto_ctrl, mon_fecha, mon_hora, mon_estado FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR MONITOREO
	#------------------------------------

	public function editarMonitoreoModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_mon, id_mon_asi, mon_pto_ctrl, mon_fecha, mon_hora, mon_estado FROM $tabla WHERE id_mon= :idMonitoreo");

		$stmt->bindParam(":idMonitoreo", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR MONITOREO
	#------------------------------------

	public function actualizarMonitoreoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_mon_asi = :idAsigMonitoreo, mon_pto_ctrl = :ptoCtrlMonitoreo, mon_fecha = :fechaMonitoreo, mon_hora = :horaMonitoreo, mon_estado = :estadoMonitoreo WHERE id_mon= :idMonitoreo");

		// $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET mer_riesgo = :riesgoMercancia, id_mer_hor = :horarioMercancia, mer_contenido = :contenidoMercancia, mer_val_dec = :valorMercancia WHERE id_mer = :id");

		$stmt->bindParam(":idAsigMonitoreo", $datosModel["idAsigMonitoreo"], PDO::PARAM_INT);
		$stmt->bindParam(":ptoCtrlMonitoreo", $datosModel["ptoCtrlMonitoreo"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaMonitoreo", $datosModel["fechaMonitoreo"], PDO::PARAM_STR);
		$stmt->bindParam(":horaMonitoreo", $datosModel["horaMonitoreo"], PDO::PARAM_STR);
		$stmt->bindParam(":estadoMonitoreo", $datosModel["estadoMonitoreo"], PDO::PARAM_STR);
		$stmt->bindParam(":idMonitoreo", $datosModel["idMonitoreo"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR MONITOREO
	#------------------------------------

	public function borrarMonitoreoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_mon = :id");

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