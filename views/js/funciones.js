function confirma(id, controlador)
{
var respuesta=confirm("¿Estás seguro de eliminar este registro?");
if (respuesta==true)
{
	window.location.href ="?action=" + controlador + "&idBorrar=" + id;

	alert("El registro ha sido eliminado");
}
else
	window.location.href ="?action=" + controlador;

	alert("La operacion ha sido cancelada");
}

