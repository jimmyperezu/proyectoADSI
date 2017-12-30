<?php 

class Paginas{
	
	public function enlacesPaginasModel($enlacesModel){


		if(	$enlacesModel == "consulta_agencia" ||
			$enlacesModel == "consulta_asignacion" ||
			$enlacesModel == "consulta_cliente" ||
			$enlacesModel == "consulta_conductor" ||
			$enlacesModel == "consulta_flete" ||
			$enlacesModel == "consulta_horario" ||
			$enlacesModel == "consulta_mercancia" ||
			$enlacesModel == "consulta_monitoreo" ||
			$enlacesModel == "consulta_novedad" ||
			$enlacesModel == "consulta_presupuesto" ||
			$enlacesModel == "consulta_puestocontrol" ||
			$enlacesModel == "consulta_ruta" ||
			$enlacesModel == "ingreso_agencia" ||
			$enlacesModel == "ingreso_cliente" ||
			$enlacesModel == "ingreso_horario" ||
			$enlacesModel == "ingreso_ruta" ||
			$enlacesModel == "ingreso_conductor" ||
			$enlacesModel == "ingreso_mercancia" ||
			$enlacesModel == "ingreso_asignacion" ||
			$enlacesModel == "ingreso_puestocontrol" ||
			$enlacesModel == "ingreso_vehiculo" ||
			$enlacesModel == "ingreso_presupuesto" ||
			$enlacesModel == "ingreso_flete" ||
			$enlacesModel == "ingreso_monitoreo" ||
			$enlacesModel == "ingreso_novedad" ||
			$enlacesModel == "inicio_sesion" ||
			$enlacesModel == "registro_usuario" ||
			$enlacesModel == "consulta_usuarios" ||
			$enlacesModel == "editar_usuario" ||
			$enlacesModel == "editar_agencia" ||
			$enlacesModel == "editar_horario" ||
			$enlacesModel == "editar_cliente" ||
			$enlacesModel == "editar_ruta" ||
			$enlacesModel == "editar_conductor" ||
			$enlacesModel == "editar_mercancia" ||
			$enlacesModel == "editar_asignacion" ||
			$enlacesModel == "editar_puestocontrol" ||
			$enlacesModel == "editar_vehiculo" ||
			$enlacesModel == "editar_presupuesto" ||
			$enlacesModel == "editar_flete" ||
			$enlacesModel == "editar_monitoreo" ||
			$enlacesModel == "editar_novedad" ||
			$enlacesModel == "salir" ||
			$enlacesModel == "consulta_vehiculo"){

			$module =  "views/modules/".$enlacesModel.".php";
		
		}else if($enlacesModel == "ok"){

			$module =  "views/modules/registro_usuario.php";
		
		}else if($enlacesModel == "i_agcia"){

			$module =  "views/modules/consulta_agencia.php";
		
		}else if($enlacesModel == "i_cliente"){

			$module =  "views/modules/ingreso_cliente.php";
		
		}else if($enlacesModel == "i_horario"){

			$module =  "views/modules/ingreso_horario.php";
		
		}else if($enlacesModel == "i_ruta"){

			$module =  "views/modules/ingreso_ruta.php";
		
		}else if($enlacesModel == "i_conductor"){

			$module =  "views/modules/ingreso_conductor.php";
		
		}else if($enlacesModel == "i_mercancia"){

			$module =  "views/modules/ingreso_mercancia.php";
		
		}else if($enlacesModel == "i_asignacion"){

			$module =  "views/modules/ingreso_asignacion.php";
		
		}else if($enlacesModel == "i_puestocontrol"){

			$module =  "views/modules/ingreso_puestocontrol.php";
		
		}else if($enlacesModel == "i_vehiculo"){

			$module =  "views/modules/ingreso_vehiculo.php";
		
		}else if($enlacesModel == "i_presupuesto"){

			$module =  "views/modules/ingreso_presupuesto.php";
		
		}else if($enlacesModel == "i_flete"){

			$module =  "views/modules/ingreso_flete.php";
		
		}else if($enlacesModel == "i_monitoreo"){

			$module =  "views/modules/ingreso_monitoreo.php";
		
		}else if($enlacesModel == "i_novedad"){

			$module =  "views/modules/ingreso_novedad.php";
		
		}else if($enlacesModel == "cambio_usuario"){

			$module =  "views/modules/consulta_usuarios.php";
		
		}else if($enlacesModel == "cambio_agencia"){

			$module =  "views/modules/consulta_agencia.php";
		
		}else if($enlacesModel == "cambio_cliente"){

			$module =  "views/modules/consulta_cliente.php";
		
		}else if($enlacesModel == "cambio_horario"){

			$module =  "views/modules/consulta_horario.php";
		
		}else if($enlacesModel == "cambio_ruta"){

			$module =  "views/modules/consulta_ruta.php";
		
		}else if($enlacesModel == "cambio_conductor"){

			$module =  "views/modules/consulta_conductor.php";
		
		}else if($enlacesModel == "cambio_mercancia"){

			$module =  "views/modules/consulta_mercancia.php";
		
		}else if($enlacesModel == "cambio_asignacion"){

			$module =  "views/modules/consulta_asignacion.php";
		
		}else if($enlacesModel == "cambio_puestocontrol"){

			$module =  "views/modules/consulta_puestocontrol.php";
		
		}else if($enlacesModel == "cambio_vehiculo"){

			$module =  "views/modules/consulta_vehiculo.php";
		
		}else if($enlacesModel == "cambio_presupuesto"){

			$module =  "views/modules/consulta_presupuesto.php";
		
		}else if($enlacesModel == "cambio_flete"){

			$module =  "views/modules/consulta_flete.php";
		
		}else if($enlacesModel == "cambio_monitoreo"){

			$module =  "views/modules/consulta_monitoreo.php";
		
		}else if($enlacesModel == "cambio_novedad"){

			$module =  "views/modules/consulta_novedad.php";
		
		}else if($enlacesModel == "usuarios"){

			$module =  "views/modules/consulta_usuarios.php";
		
		}else if($enlacesModel == "fallo"){

			$module =  "views/modules/inicio_sesion.php";
		
		}else{

			$module =  "views/modules/inicio.php";

		}
		
		return $module;

	}

}

?>