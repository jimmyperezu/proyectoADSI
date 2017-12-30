<?php  

	class FuncionesController{
		#CARGAR CONTENIDO
		#-------------------------------------

		public function cargarSelectController($tabla, $campo){
			
			$respuesta = FuncionesModel::cargarSelectModel($tabla, $campo);

			if($respuesta != "error"){
					
				return $respuesta;

			}else{

				echo "error";

			}

		}
	}

?>