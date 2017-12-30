<?php  

require_once "conexion.php";

class DatosPresupuesto extends Conexion{

	#INGRESO DE PRESUPUESTO
	#------------------------------------
	public function ingresoPresupuestoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_pre_asi, id_pre_veh, pre_rut, pre_val) VALUES (:idAsigPresupuesto,:placaVehPresupuesto,:rutaPresupuesto,:valorPresupuesto)");

		$stmt->bindParam(":idAsigPresupuesto", $datosModel["idAsigPresupuesto"], PDO::PARAM_INT);
		$stmt->bindParam(":placaVehPresupuesto", $datosModel["placaVehPresupuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":rutaPresupuesto", $datosModel["rutaPresupuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":valorPresupuesto", $datosModel["valorPresupuesto"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE PRESUPUESTOS
	#------------------------------------

	public function vistaPresupuestosModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_pre, id_pre_asi, id_pre_veh, pre_rut, pre_val FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR PRESUPUESTO
	#------------------------------------

	public function editarPresupuestoModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_pre, id_pre_asi, id_pre_veh, pre_rut, pre_val FROM $tabla WHERE id_pre= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR PRESUPUESTO
	#------------------------------------

	public function actualizarPresupuestoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_pre_asi = :idAsigPresupuesto, id_pre_veh = :placaVehPresupuesto, pre_rut = :rutaPresupuesto, pre_val = :valorPresupuesto WHERE id_pre = :id");

		$stmt->bindParam(":idAsigPresupuesto", $datosModel["idAsigPresupuesto"], PDO::PARAM_INT);
		$stmt->bindParam(":placaVehPresupuesto", $datosModel["placaVehPresupuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":rutaPresupuesto", $datosModel["rutaPresupuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":valorPresupuesto", $datosModel["valorPresupuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["idPresupuesto"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR PRESUPUESTO
	#------------------------------------

	public function borrarPresupuestoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_pre = :id");

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