<?php  
	
	require_once "conexion.php";

	class FuncionesModel extends Conexion{
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