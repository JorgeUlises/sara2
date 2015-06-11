<?php

namespace tools\links\funcion;

if (! isset ( $GLOBALS ['autorizado'] )) {
	include ('index.php');
	exit ();
}
class getLink {
	public static function obtener($opcion) {
		$miConfigurador = \Configurador::singleton ();
		$miPaginaActual = $miConfigurador->getVariableConfiguracion ( 'pagina' );
		$variable = 'pagina=' . $opcion;		
		$url = $miConfigurador->configuracion ['host'] . $miConfigurador->configuracion ['site'] . '/index.php?';
		$enlace = $miConfigurador->configuracion ['enlace'];
		$variable = $miConfigurador->fabricaConexiones->crypto->codificar ( $variable );
		$_REQUEST [$enlace] = $enlace . '=' . $variable;
		$direccion = $url . $_REQUEST [$enlace];
		
		return $direccion;
	}
}

?>