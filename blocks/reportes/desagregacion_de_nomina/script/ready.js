
// Asociar el widget de validación al formulario
$("#desagregacion_de_nomina").validationEngine({
	promptPosition : "centerRight",
	scroll : false
});

$('#tablaReporte').dataTable( {
	"sPaginationType": "full_numbers"
	} );