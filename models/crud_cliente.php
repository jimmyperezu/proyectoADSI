<?php  

require_once "conexion.php";

class DatosCliente extends Conexion{

	#INGRESO DE CLIENTE
	#------------------------------------
	public function ingresoClienteModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cli, cli_tpo_id, cli_nom, cli_ape, cli_dir, cli_tel, cli_mun) VALUES (:idCliente, :tipoCliente, :nombreCliente, :apellidoCliente, :direccionCliente, :telefonoCliente, :municipioCliente)");

		$stmt->bindParam(":idCliente", $datosModel["idCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoCliente", $datosModel["tipoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreCliente", $datosModel["nombreCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoCliente", $datosModel["apellidoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":direccionCliente", $datosModel["direccionCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":telefonoCliente", $datosModel["telefonoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":municipioCliente", $datosModel["municipioCliente"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();

	}

	#VISTA DE CLIENTES
	#------------------------------------

	public function vistaClientesModel($tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_cli, cli_tpo_id, cli_nom, cli_ape, cli_dir, cli_tel, cli_mun FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		
	}

	#EDITAR CLIENTE
	#------------------------------------

	public function editarClienteModel($datosModel, $tabla){


		$stmt = Conexion::conectar()->prepare("SELECT id_cli, cli_tpo_id, cli_nom, cli_ape, cli_dir, cli_tel, cli_mun FROM $tabla WHERE id_cli= :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		
	}

	#ACTUALIZAR CLIENTE
	#------------------------------------

	public function actualizarClienteModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_cli = :idCliente, cli_tpo_id = :tipoCliente, cli_nom = :nombreCliente, cli_ape = :apellidoCliente, cli_dir = :direccionCliente, cli_tel = :telefonoCliente, cli_mun = :municipioCliente WHERE id_cli = :idClienteAnterior");

		$stmt->bindParam(":idClienteAnterior", $datosModel["idClienteAnterior"], PDO::PARAM_STR);
		$stmt->bindParam(":idCliente", $datosModel["idCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoCliente", $datosModel["tipoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreCliente", $datosModel["nombreCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoCliente", $datosModel["apellidoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":direccionCliente", $datosModel["direccionCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":telefonoCliente", $datosModel["telefonoCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":municipioCliente", $datosModel["municipioCliente"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return $datosModel;
		}

		$stmt->close();
	}

	#BORRAR CLIENTE
	#------------------------------------

	public function borrarClienteModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cli = :id");

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