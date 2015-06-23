// Asociar el widget de validación al formulario
$("#desagregacionDeNomina").validationEngine({
	promptPosition : "centerRight",
	scroll : false
});

$('#tablaReporte').dataTable({
	"sPaginationType" : "full_numbers"
});

$("#<?php echo $this->campoSeguro('nominaGenerar')?>").change(
		function() {
			
			$("#<?php echo $this->campoSeguro('actoAdministrativo')?>").val($("#<?php echo $this->campoSeguro('seleccion')?>").val());	
			
			switch ($("#<?php echo $this->campoSeguro('nominaGenerar')?>").val()) {
			
			case '1':
//				$("#<?php echo $this->campoSeguro('tipoNomina_div')?>").css('display','block');
//				$("#<?php echo $this->campoSeguro('vigencia_div')?>").css('display','block');
//				$("#<?php echo $this->campoSeguro('periodo_div')?>").css('display','block');				
				break;
			default:
//				$("#<?php echo $this->campoSeguro('tipoNomina_div')?>").css('display','none');
//				$("#<?php echo $this->campoSeguro('vigencia_div')?>").css('display','none');
//				$("#<?php echo $this->campoSeguro('periodo_div')?>").css('display','none');								
				break;		
					
			}

		});