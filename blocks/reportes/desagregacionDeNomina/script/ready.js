// Asociar el widget de validación al formulario
$("#desagregacionDeNomina").validationEngine({
	promptPosition : "centerRight",
	scroll : false
});

$('#tablaReporte').dataTable({
	"sPaginationType" : "full_numbers"
});