<?php

namespace reportes\desagregacion_de_nomina\funcion;

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("index.php");
	exit ();
}
class Redireccionador {
	public static function redireccionar($opcion, $valor = "") {
		
		    $miConfigurador = \Configurador::singleton ();
		  $miPagina=$miConfigurador->getVariableConfiguracion("pagina");
		
		switch ($opcion) {
			
			case "opcion1" :
	
				$variable = 'pagina='.$miPagina;
				$variable.='&opcion=mensaje';
				$variable.= '&digitado=' . $valor['digitado'];
				$variable.= '&hora=' . $valor['hora'];				
				break;
				
			default:
			    $variable='';
			
		}
		foreach ( $_REQUEST as $clave => $valor ) {
			unset ( $_REQUEST [$clave] );
		}
		
		$url = $miConfigurador->configuracion ["host"] . $miConfigurador->configuracion ["site"] . "/index.php?";
        $enlace = $miConfigurador->configuracion ['enlace'];
        $variable = $miConfigurador->fabricaConexiones->crypto->codificar($variable);
        $_REQUEST [$enlace] = $enlace . '=' . $variable;
        $redireccion = $url . $_REQUEST [$enlace];
        
        echo "<script>location.replace('" . $redireccion . "')</script>";
	}
}
?>