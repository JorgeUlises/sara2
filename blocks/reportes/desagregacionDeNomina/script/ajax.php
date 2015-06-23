<?php
/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */

// URL base
$url = $this->miConfigurador->getVariableConfiguracion ( "host" );
$url .= $this->miConfigurador->getVariableConfiguracion ( "site" );
$url .= "/index.php?";

// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar .= "&procesarAjax=true";
$cadenaACodificar .= "&action=index.php";
$cadenaACodificar .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar .= "&funcion=consultarTipoNomina";
$cadenaACodificar .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar, $enlace );

// URL definitiva
$urlFinal = $url . $cadena;


/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */

// URL base
$url_1 = $this->miConfigurador->getVariableConfiguracion ( "host" );
$url_1 .= $this->miConfigurador->getVariableConfiguracion ( "site" );
$url_1 .= "/index.php?";

// Variables
$cadenaACodificar_1 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar_1 .= "&procesarAjax=true";
$cadenaACodificar_1 .= "&action=index.php";
$cadenaACodificar_1 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar_1 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar_1 .= "&funcion=consultarPeriodo";
$cadenaACodificar_1 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace_1 = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena_1 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar_1, $enlace_1 );

// URL definitiva
$urlFinal_1 = $url_1 . $cadena_1;

?>

<script type='text/javascript'>


function consultarTipoNomina(elem, request, response){	
		  $.ajax({
		    url: "<?php echo $urlFinal?>",
		    dataType: "json",
		    data: { valor:$("#<?php echo $this->campoSeguro('nominaGenerar')?>").val()},
		    success: function(data){ 
			    
		        if(data[0]!=" "){

		            $("#<?php echo $this->campoSeguro('tipoNomina')?>").html('');
		            $("<option value=''>Seleccione  .....</option>").appendTo("#<?php echo $this->campoSeguro('tipoNomina')?>");
		            $.each(data , function(indice,valor){
		            	$("<option value='"+data[ indice ].id+"'>"+data[ indice ].nombre+"</option>").appendTo("#<?php echo $this->campoSeguro('tipoNomina')?>");		            	
		            });          
			        }
		    }
			                    
		   });
		};

function consultarPeriodo(elem, request, response){	
		  $.ajax({
		    url: "<?php echo $urlFinal_1?>",
		    dataType: "json",
		    data: { valor:$("#<?php echo $this->campoSeguro('nominaGenerar')?>").val()},
		    success: function(data){ 
				    
		        if(data[0]!=" "){

		            $("#<?php echo $this->campoSeguro('periodo')?>").html('');
		            $("<option value=''>Seleccione  .....</option>").appendTo("#<?php echo $this->campoSeguro('periodo')?>");
		            $.each(data , function(indice,valor){
		            	$("<option value='"+data[ indice ].id+"'>"+data[ indice ].nombre+"</option>").appendTo("#<?php echo $this->campoSeguro('periodo')?>");		            	
		            });          
			        }
		    }
			                    
		   });
		};
	
   $(function () {

   	  $("#<?php echo $this->campoSeguro('nominaGenerar')?>").change(function(){
   		 if($("#<?php echo $this->campoSeguro('nominaGenerar')?>").val()!= ""){
   	   		 
   			$("#<?php echo $this->campoSeguro('tipoNomina_div')?>").css('display','block');
   			$("#<?php echo $this->campoSeguro('vigencia_div')?>").css('display','block');
   			$("#<?php echo $this->campoSeguro('periodo_div')?>").css('display','block');
   			   			    		  
   		  	consultarTipoNomina();
   		 	consultarPeriodo();
   		  	
       	}else{
           	
       		$("#<?php echo $this->campoSeguro('tipoNomina_div')?>").css('display','none'); 
       		$("#<?php echo $this->campoSeguro('vigencia_div')?>").css('display','none'); 
       		$("#<?php echo $this->campoSeguro('periodo_div')?>").css('display','none'); 
	    }
    		          	 
    		  
   	  });	
   });

</script>

