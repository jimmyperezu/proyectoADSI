<?php  

require_once "conexion.php";

class DatosVehiculo extends Conexion{

	#INGRESO DE VEHICULO
	#------------------------------------
	public function ingresoVehiculoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_veh, id_veh_ctor, veh_agcia, veh_tpo_cto, veh_modelo, veh_marca) VALUES (:placaVehiculo,:idConductorVehiculo,:agenciaVehiculo,:tipoContratoVehiculo,:modeloVehiculo,:marcaVehiculo)");

		$stmt->bindParam(":placaVehiculo", $datosModel["placaVehiculo"], PDO::PARAM_STR);
		$stmt->bindParam(":idConductorVehiculo", $datosModel["idConductorVehiculo"], PDO::PARAM_STR);
		$stmt->bindParam(":agenciaVehiculo", $datosModel["agenciaVehiculo"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoContratoVehiculo", $datosModel["tipoContratoVehiculo"], PDO::PARAM_STR);
		$stmt->bindParam(":modeloVehiculo", $datosModel["modeloVehiculo"], PDO::PARAM_STR);
		$stmt->bindParam(":marcaVehiculo", $datosModel["marcaVehiculo"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE VEHICULOS
	#------------------------------------

	public function vistaVehiculosModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_veh, id_veh_ctor, veh_agcia, veh_tpo_cto, veh_modelo, veh_marca FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR VEHICULO
	#------------------------------------

	public function editarVehiculoModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_veh, id_veh_ctor, veh_agcia, veh_tpo_cto, veh_modelo, veh_marca FROM $tabla WHERE id_veh= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR VEHICULO
	#------------------------------------

	public function actualizarVehiculoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_veh = :placaVehiculo, id_veh_ctor = :idConductorVehiculo, veh_agcia = :agenciaVehiculo, veh_tpo_cto = :tipoContratoVehiculo, veh_modelo = :modeloVehiculo, veh_marca = :marcaVehiculo WHERE id_veh = :placaVehiculoAnterior");

		$stmt->bindParam(":idConductorVehiculo", $datosModel["idConductorVehiculo"], PDO::PARAM_STR);
		$stmt->bindParam(":agenciaVehiculo", $datosModel["agenciaVehiculo"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoContratoVehiculo", $datosModel["tipoContratoVehiculo"], PDO::PARAM_STR);
		$stmt->bindParam(":modeloVehiculo", $datosModel["modeloVehiculo"], PDO::PARAM_STR);
		$stmt->bindParam(":marcaVehiculo", $datosModel["marcaVehiculo"], PDO::PARAM_STR);
		$stmt->bindParam(":placaVehiculo", $datosModel["placaVehiculo"], PDO::PARAM_STR);
		$stmt->bindParam(":placaVehiculoAnterior", $datosModel["placaVehiculoAnterior"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR VEHICULO
	#------------------------------------

	public function borrarVehiculoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_veh = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);

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