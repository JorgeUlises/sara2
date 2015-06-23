<?php
use reportes\desagregacionDeNomina\Sql;

$conexion = "datosNomina";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

if ($_REQUEST ['funcion'] == 'consultarTipoNomina') {
		
	$cadenaSql = $this->sql->getCadenaSql ( 'tipoNomina', $_REQUEST ['valor'] );
	$datos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	
	//Ya que la consulta retorna una cadena con los diferentes id e items, se tiene que reestructurar el arreglo
	//Con el fin que se permitan cargar dichos datos al Select.
	
	$marizItems = explode ( ",", $datos [0] ['opciones'] );
	$contador = 1;
	$cont2 = 0;
	$id;
	
	foreach ( $marizItems as $a ) {
		if ($contador == 1) {
			$id = $a;
			$contador ++;
		} else if ($contador == 2) {
			$matrizFuncionario [] = array (
					'id' => $id,
					'nombre' => $a 
			);
			$matrizFuncionario [$cont2] [0] = $id;
			$matrizFuncionario [$cont2] [1] = $a;
			
			$contador = 1;
			$cont2 ++;
		}
	}
	
	//Fin de la generación de la matriz.
	
	
	$matrizFuncionario=json_encode( $matrizFuncionario );
	
	echo $matrizFuncionario;
}

if ($_REQUEST ['funcion'] == 'consultarPeriodo') {

	$cadenaSql = $this->sql->getCadenaSql ( 'periodo', $_REQUEST ['valor'] );
	$datos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );

	$marizItems = explode ( ",", $datos [0] ['opciones'] );
	$contador = 1;
	$cont2 = 0;
	$id;

	foreach ( $marizItems as $a ) {
		if ($contador == 1) {
			$id = $a;
			$contador ++;
		} else if ($contador == 2) {
			$matrizPeriodo [] = array (
					'id' => $id,
					'nombre' => $a
			);
			$matrizPeriodo [$cont2] [0] = $id;
			$matrizPeriodo [$cont2] [1] = $a;
				
			$contador = 1;
			$cont2 ++;
		}
	}


	$matrizPeriodo=json_encode( $matrizPeriodo );

	echo $matrizPeriodo;
}

?>
