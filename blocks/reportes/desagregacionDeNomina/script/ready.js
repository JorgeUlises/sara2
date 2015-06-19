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
			
			switch ($("#<?php echo $this->campoSeguro('nominaGenerar')?>").val()) {
			
			case '1':
				$("#<?php echo $this->campoSeguro('tipoNomina_div')?>").css('display','none');
				$("#<?php echo $this->campoSeguro('vigencia_div')?>").css('display','none');
				$("#<?php echo $this->campoSeguro('periodo_div')?>").css('display','none');
				break;		
			case '2':
				$("#<?php echo $this->campoSeguro('tipoNomina_div')?>").css('display','block');
				$("#<?php echo $this->campoSeguro('vigencia_div')?>").css('display','block');
				$("#<?php echo $this->campoSeguro('periodo_div')?>").css('display','block');
				break;
			}

		});