<?php  

require_once "conexion.php";

class DatosNovedad extends Conexion{

	#INGRESAR NOVEDAD
	#------------------------------------
	public function ingresoNovedadModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_nov_asi, nov_fecha, nov_hora, nov_lugar, nov_tipo, nov_desc, nov_costo) VALUES (:idAsigNovedad,:fechaNovedad,:horaNovedad,:lugarNovedad,:tipoNovedad,:descripcionNovedad,:valorNovedad)");

		$stmt->bindParam(":idAsigNovedad", $datosModel["idAsigNovedad"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaNovedad", $datosModel["fechaNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":horaNovedad", $datosModel["horaNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":lugarNovedad", $datosModel["lugarNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoNovedad", $datosModel["tipoNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcionNovedad", $datosModel["descripcionNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":valorNovedad", $datosModel["valorNovedad"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE NOVEDAD
	#------------------------------------

	public function vistaNovedadesModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_nov, id_nov_asi, nov_fecha, nov_hora, nov_lugar, nov_tipo, nov_desc, nov_costo FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR NOVEDAD
	#------------------------------------

	public function editarNovedadModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_nov, id_nov_asi, nov_fecha, nov_hora, nov_lugar, nov_tipo, nov_desc, nov_costo FROM $tabla WHERE id_nov= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR NOVEDAD
	#------------------------------------

	public function actualizarNovedadModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_nov_asi = :idAsigNovedad, nov_fecha = :fechaNovedad, nov_hora = :horaNovedad, nov_lugar = :lugarNovedad, nov_tipo = :tipoNovedad, nov_desc = :descripcionNovedad, nov_costo = :valorNovedad WHERE id_nov = :idNovedad");

		$stmt->bindParam(":idAsigNovedad", $datosModel["idAsigNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaNovedad", $datosModel["fechaNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":horaNovedad", $datosModel["horaNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":lugarNovedad", $datosModel["lugarNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoNovedad", $datosModel["tipoNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcionNovedad", $datosModel["descripcionNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":valorNovedad", $datosModel["valorNovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":idNovedad", $datosModel["idNovedad"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}

	#BORRAR NOVEDAD
	#------------------------------------

	public function borrarNovedadModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_nov = :id");

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