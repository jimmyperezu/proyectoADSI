<?php  

require_once "conexion.php";

class DatosPuestoControl extends Conexion{

	#INGRESO DE PUESTO DE CONTROL
	#------------------------------------
	public function ingresoPtoCtrlModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(pto_ctrl_rut, pto_ctrl_mcpio, pto_ctrl_celular, pto_ctrl_correo) VALUES (:rutaPtoCtrl,:municipioPtoCtrl,:celularPtoCtrl,:emailPtoCtrl)");

		$stmt->bindParam(":rutaPtoCtrl", $datosModel["rutaPtoCtrl"], PDO::PARAM_STR);
		$stmt->bindParam(":municipioPtoCtrl", $datosModel["municipioPtoCtrl"], PDO::PARAM_STR);
		$stmt->bindParam(":celularPtoCtrl", $datosModel["celularPtoCtrl"], PDO::PARAM_STR);
		$stmt->bindParam(":emailPtoCtrl", $datosModel["emailPtoCtrl"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE PUESTOS DE CONTROL
	#------------------------------------

	public function vistaPuestoControlModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_pto_ctrl, pto_ctrl_rut, pto_ctrl_mcpio, pto_ctrl_celular, pto_ctrl_correo FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR PUESTO DE CONTROL
	#------------------------------------

	public function editarPuestoControlModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_pto_ctrl, pto_ctrl_rut, pto_ctrl_mcpio, pto_ctrl_celular, pto_ctrl_correo FROM $tabla WHERE id_pto_ctrl= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR PUESTO DE CONTROL
	#------------------------------------

	public function actualizarPuestoControlModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pto_ctrl_rut = :rutaPtoCtrl, pto_ctrl_mcpio = :municipioPtoCtrl, pto_ctrl_celular = :celularPtoCtrl, pto_ctrl_correo = :emailPtoCtrl WHERE id_pto_ctrl = :idPtoCtrl");

		$stmt->bindParam(":rutaPtoCtrl", $datosModel["rutaPtoCtrl"], PDO::PARAM_STR);
		$stmt->bindParam(":municipioPtoCtrl", $datosModel["municipioPtoCtrl"], PDO::PARAM_STR);
		$stmt->bindParam(":celularPtoCtrl", $datosModel["celularPtoCtrl"], PDO::PARAM_STR);
		$stmt->bindParam(":emailPtoCtrl", $datosModel["emailPtoCtrl"], PDO::PARAM_STR);
		$stmt->bindParam(":idPtoCtrl", $datosModel["idPtoCtrl"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR PUESTO DE CONTROOL
	#------------------------------------

	public function borrarPuestoControlModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_pto_ctrl = :id");

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