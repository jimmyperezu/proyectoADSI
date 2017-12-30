<?php  

require_once "conexion.php";

class DatosAgencia extends Conexion{

	#INGRESO DE AGENCIA
	#------------------------------------
	public function ingresoAgenciaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(agcia_mcpio, agcia_celular, agcia_correo) VALUES (:municipio,:celular,:email)");

		$stmt->bindParam(":municipio", $datosModel["municipioAgencia"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datosModel["celularAgencia"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["emailAgencia"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE AGENCIAS
	#------------------------------------

	public function vistaAgenciasModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_agcia, agcia_mcpio, agcia_celular, agcia_correo FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR AGENCIA
	#------------------------------------

	public function editarAgenciaModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_agcia, agcia_mcpio, agcia_celular, agcia_correo FROM $tabla WHERE id_agcia= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR AGENCIA
	#------------------------------------

	public function actualizarAgenciaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET agcia_mcpio = :municipioAgencia, agcia_celular = :celularAgencia, agcia_correo = :emailAgencia WHERE id_agcia = :idAgencia");

		$stmt->bindParam(":municipioAgencia", $datosModel["municipioAgencia"], PDO::PARAM_STR);
		$stmt->bindParam(":celularAgencia", $datosModel["celularAgencia"], PDO::PARAM_STR);
		$stmt->bindParam(":emailAgencia", $datosModel["emailAgencia"], PDO::PARAM_STR);
		$stmt->bindParam(":idAgencia", $datosModel["idAgencia"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR AGENCIA
	#------------------------------------

	public function borrarAgenciaModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_agcia = :idAgencia");

		$stmt->bindParam(":idAgencia", $datosModel, PDO::PARAM_INT);

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