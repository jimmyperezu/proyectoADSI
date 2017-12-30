<?php  

require_once "conexion.php";

class DatosAsignacion extends Conexion{

	#INGRESAR ASIGNACION
	#------------------------------------
	public function ingresoAsignacionModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(asi_cli, asi_mer, asi_agcia, asi_fec_reg, asi_fec_ent, asi_estado) VALUES (:clienteAsig,:contenidoMercanciaAsig,:municipioAgenciaAsig,:fechaRegistroAsig,:fechaEntregaAsig,:estadoAsig)");

		$stmt->bindParam(":clienteAsig", $datosModel["clienteAsig"], PDO::PARAM_STR);
		$stmt->bindParam(":contenidoMercanciaAsig", $datosModel["contenidoMercanciaAsig"], PDO::PARAM_STR);
		$stmt->bindParam(":municipioAgenciaAsig", $datosModel["municipioAgenciaAsig"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaRegistroAsig", $datosModel["fechaRegistroAsig"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaEntregaAsig", $datosModel["fechaEntregaAsig"], PDO::PARAM_STR);
		$stmt->bindParam(":estadoAsig", $datosModel["estadoAsig"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE ASIGNACIONES
	#------------------------------------

	public function vistaAsignacionesModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_asi, asi_cli, asi_mer, asi_agcia, asi_fec_reg, asi_fec_ent, asi_estado FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR ASIGNACION
	#------------------------------------

	public function editarAsignacionModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_asi, asi_cli, asi_mer, asi_agcia, asi_fec_reg, asi_fec_ent, asi_estado FROM $tabla WHERE id_asi= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR ASIGNACION
	#------------------------------------

	public function actualizarAsignacionModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET asi_cli = :clienteAsig, asi_mer = :contenidoMercanciaAsig, asi_agcia = :municipioAgenciaAsig, asi_fec_reg = :fechaRegistroAsig, asi_fec_ent = :fechaEntregaAsig, asi_estado = :estadoAsig WHERE id_asi = :id");

		$stmt->bindParam(":clienteAsig", $datosModel["clienteAsig"], PDO::PARAM_STR);
		$stmt->bindParam(":contenidoMercanciaAsig", $datosModel["contenidoMercanciaAsig"], PDO::PARAM_STR);
		$stmt->bindParam(":municipioAgenciaAsig", $datosModel["municipioAgenciaAsig"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaRegistroAsig", $datosModel["fechaRegistroAsig"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaEntregaAsig", $datosModel["fechaEntregaAsig"], PDO::PARAM_STR);
		$stmt->bindParam(":estadoAsig", $datosModel["estadoAsig"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["idAsignacion"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR ASIGNACION
	#------------------------------------

	public function borrarAsignacionModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_asi = :id");

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