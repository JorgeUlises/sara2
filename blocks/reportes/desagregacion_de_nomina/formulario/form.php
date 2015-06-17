<?php

namespace reportes\desagregacion_de_nomina\formulario;

if (! isset ( $GLOBALS ['autorizado'] )) {
	include ('../index.php');
	exit ();
}
class Formulario {
	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;
	function __construct($lenguaje, $formulario, $sql) {
		$this->miConfigurador = \Configurador::singleton ();
		
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		
		$this->lenguaje = $lenguaje;
		
		$this->miFormulario = $formulario;
		
		$this->miSql = $sql;
	}
	function formulario() {
		
		/**
		 * IMPORTANTE: Este formulario está utilizando jquery.
		 * Por tanto en el archivo ready.php se delaran algunas funciones js
		 * que lo complementan.
		 */
		
		// Rescatar los datos de este bloque
		$esteBloque = $this->miConfigurador->getVariableConfiguracion ( 'esteBloque' );
		
		// ---------------- SECCION: Parámetros Globales del Formulario ----------------------------------
		/**
		 * Atributos que deben ser aplicados a todos los controles de este formulario.
		 * Se utiliza un arreglo
		 * independiente debido a que los atributos individuales se reinician cada vez que se declara un campo.
		 *
		 * Si se utiliza esta técnica es necesario realizar un mezcla entre este arreglo y el específico en cada control:
		 * $atributos= array_merge($atributos,$atributosGlobales);
		 */
		$atributosGlobales ['campoSeguro'] = 'true';
		$_REQUEST ['tiempo'] = time ();
		
		// -------------------------------------------------------------------------------------------------
		
		$conexion = 'datosNomina';
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		// ---------------- SECCION: Parámetros Generales del Formulario ----------------------------------
		$esteCampo = $esteBloque ['nombre'];
		$atributos ['id'] = $esteCampo;
		$atributos ['nombre'] = $esteCampo;
		// Si no se coloca, entonces toma el valor predeterminado 'application/x-www-form-urlencoded'
		$atributos ['tipoFormulario'] = 'multipart/form-data';
		// Si no se coloca, entonces toma el valor predeterminado 'POST'
		$atributos ['metodo'] = 'POST';
		// Si no se coloca, entonces toma el valor predeterminado 'index.php' (Recomendado)
		$atributos ['action'] = 'index.php';
		// $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo );
		// Si no se coloca, entonces toma el valor predeterminado.
		$atributos ['estilo'] = '';
		$atributos ['marco'] = true;
		$tab = 1;
		// ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------
		// ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
		$atributos ['tipoEtiqueta'] = 'inicio';
		echo $this->miFormulario->formulario ( $atributos );
		
		// ---------------- SECCION: Controles del Formulario -----------------------------------------------
		$esteCampo = "formularioDesagregacionNomina";
		$atributos ['id'] = $esteCampo;
		$atributos ["estilo"] = "jqueryui";
		$atributos ['tipoEtiqueta'] = 'inicio';
		$atributos ["leyenda"] = "Parametros de Consulta";
		echo $this->miFormulario->marcoAgrupacion ( 'inicio', $atributos );
		
		
		$seleccion = 4; //Modificando esta variable se pueden ver los cambios en las listas <select>
		
		// -----------------CONTROL: Lista Vigencia Nómina ----------------------------------------------------------------
		$esteCampo = "vigencia";
		$atributos ['nombre'] = $esteCampo;
		$atributos ['id'] = $esteCampo;
		$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['tipo'] = 'select';
		$atributos ['tab'] = $tab;
		$atributos ['evento'] = null;
		$atributos ['deshabilitado'] = false;
		$atributos ['anchoEtiqueta'] = 150;
		$atributos ['anchoCaja'] = 49;
		$atributos ['etiquetaObligatorio'] = true;
		
		$vigencia = array ();
		$contador = 0;
		for($i = 2000; $i <= date ( 'Y' ); $i ++) {
			$vigencia [] = array (
					$contador,
					$i 
			);
			$contador ++;
		}
		$matrizItems = $vigencia;
		$atributos ['matrizItems'] = $matrizItems;
		
		$atributos ['estilo'] = 'jqueryui';
		$atributos ['validar'] = 'required';
		$atributos ['columnas'] = '';
		$atributos ['tamanno'] = 1;
		$atributos ['limitar'] = '';
		$atributos ['valor'] = $this->lenguaje->getCadena ( $esteCampo );
		// $atributos ['nombreFormulario'] = $esteBloque ['nombre'];
		$tab ++;
		
		// Aplica atributos globales al control
		$atributos = array_merge ( $atributos, $atributosGlobales );
		echo $this->miFormulario->campoCuadroLista ( $atributos );
		
		unset ( $atributos ); // Función que borra los datos almacenados en el array atributos.
		                      // -----------------FIN CONTROL: Lista Vigencia Nómina -----------------------------------------------------------
		                      
		// -----------------CONTROL: Lista Nómina Generar ----------------------------------------------------------------
		$esteCampo = "nominaGenerar";
		$atributos ['nombre'] = $esteCampo;
		$atributos ['id'] = $esteCampo;
		$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['etiquetaObligatorio'] = true;
		$atributos ['tab'] = $tab ++;
		$atributos ['seleccion'] = - 1;
		$atributos ['anchoEtiqueta'] = 150;
		$atributos ['evento'] = '';
		if (isset ( $_REQUEST [$esteCampo] )) {
			$atributos ['valor'] = $_REQUEST [$esteCampo];
		} else {
			$atributos ['valor'] = '';
		}
		$atributos ['deshabilitado'] = false;
		$atributos ['columnas'] = 1;
		$atributos ['tamanno'] = 1;
		$atributos ['ajax_function'] = '';
		$atributos ['ajax_control'] = $esteCampo;
		$atributos ['estilo'] = 'jqueryui';
		$atributos ['validar'] = 'required';
		$atributos ['limitar'] = 1;
		$atributos ['anchoCaja'] = 49;
		$atributos ['miEvento'] = '';
		$cadena_sql = $this->miSql->getCadenaSql ( 'nominaGenerar' );
		$matrizItems = array (
				array (
						0,
						' ' 
				) 
		);
		$matrizItems = $esteRecursoDB->ejecutarAcceso ( $cadena_sql, 'busqueda' );		
		$atributos ['matrizItems'] = $matrizItems;
		// Aplica atributos globales al control
		$atributos = array_merge ( $atributos, $atributosGlobales );
		echo $this->miFormulario->campoCuadroLista ( $atributos );
		unset ( $atributos );
		// -----------------FIN CONTROL: Lista Nómina Generar -----------------------------------------------------------
		
		// -----------------CONTROL: Lista Tipo Nómina ----------------------------------------------------------
		$esteCampo = "tipoNomina";
		$atributos ['nombre'] = $esteCampo;
		$atributos ['id'] = $esteCampo;
		$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['etiquetaObligatorio'] = true;
		$atributos ['tab'] = $tab ++;
		$atributos ['seleccion'] = - 1;
		$atributos ['anchoEtiqueta'] = 150;
		$atributos ['evento'] = '';
		if (isset ( $_REQUEST [$esteCampo] )) {
			$atributos ['valor'] = $_REQUEST [$esteCampo];
		} else {
			$atributos ['valor'] = '';
		}
		$atributos ['deshabilitado'] = false;
		$atributos ['columnas'] = 1;
		$atributos ['tamanno'] = 1;
		$atributos ['ajax_function'] = '';
		$atributos ['ajax_control'] = $esteCampo;
		$atributos ['estilo'] = 'jqueryui';
		$atributos ['validar'] = 'required';
		$atributos ['limitar'] = 1;
		$atributos ['anchoCaja'] = 49;
		$atributos ['miEvento'] = '';
		$cadena_sql = $this->miSql->getCadenaSql ( 'tipoNomina', $seleccion );
		$matrizItems = array (
				array (
						0,
						' ' 
				) 
		);
		
		//Código para generar los datos que se incorporaran en los select
		$matrizCadena = $esteRecursoDB->ejecutarAcceso ( $cadena_sql, 'busqueda' );		
        $marizItems = explode(",", $matrizCadena[0]['opciones']);
		$contador = 1;
		$cont2 = 0;		
		$id;
		if(count($matrizCadena)>0){
			foreach ($marizItems as $a){
				if($contador==1){
					$id = $a;				
					$contador++;
				}else if($contador==2){
					$matrizFuncionario[] = array('id'=>$id,'nombre' => $a);
					$matrizFuncionario[$cont2][0] = $id;
					$matrizFuncionario[$cont2][1] = $a;
				
					$contador=1;
					$cont2++;
				}				
			}	
		}
		//Fin Código para generar los datos que se incorporan en el select	
		
		$atributos ['matrizItems'] = $matrizFuncionario;
		// Aplica atributos globales al control
		$atributos = array_merge ( $atributos, $atributosGlobales );
		echo $this->miFormulario->campoCuadroLista ( $atributos );
		unset ( $atributos );
		unset ( $matrizFuncionario );
		// -----------------FIN CONTROL: Tipo Nómina-----------------------------------------------------------
		
		// -----------------CONTROL: Lista Periodo ----------------------------------------------------------
		$esteCampo = "periodo";
		$atributos ['nombre'] = $esteCampo;
		$atributos ['id'] = $esteCampo;
		$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['etiquetaObligatorio'] = true;
		$atributos ['tab'] = $tab ++;
		$atributos ['seleccion'] = - 1;
		$atributos ['anchoEtiqueta'] = 150;
		$atributos ['evento'] = '';
		if (isset ( $_REQUEST [$esteCampo] )) {
			$atributos ['valor'] = $_REQUEST [$esteCampo];
		} else {
			$atributos ['valor'] = '';
		}
		$atributos ['deshabilitado'] = false;
		$atributos ['columnas'] = 1;
		$atributos ['tamanno'] = 1;
		$atributos ['ajax_function'] = '';
		$atributos ['ajax_control'] = $esteCampo;
		$atributos ['estilo'] = 'jqueryui';
		$atributos ['validar'] = 'required';
		$atributos ['limitar'] = 1;
		$atributos ['anchoCaja'] = 49;
		$atributos ['miEvento'] = '';
		$cadena_sql = $this->miSql->getCadenaSql ( 'periodo', $seleccion );
		$matrizItems = array (
				array (
						0,
						' '
				)
		);
		
		//Código para generar los datos que se incorporaran en los select
		$matrizCadena = $esteRecursoDB->ejecutarAcceso ( $cadena_sql, 'busqueda' );
		$marizItems = explode(",", $matrizCadena[0]['opciones']);
		$contador = 1;
		$cont2 = 0;
		$id;
		foreach ($marizItems as $a){
			if($contador==1){
				$id = $a;
				$contador++;
			}else if($contador==2){
				$matrizPeriodo[] = array('id'=>$id,'nombre' => $a);
				$matrizPeriodo[$cont2][0] = $id;
				$matrizPeriodo[$cont2][1] = $a;
		
				$contador=1;
				$cont2++;
			}
		}
		
		
		//Fin Código para generar los datos que se incorporan en el select
		
		$atributos ['matrizItems'] = $matrizPeriodo;
		// Aplica atributos globales al control
		$atributos = array_merge ( $atributos, $atributosGlobales );
		echo $this->miFormulario->campoCuadroLista ( $atributos );
		unset ( $atributos );
		unset ( $matrizPeriodo );
		// -----------------FIN CONTROL: Nómina a Generar -----------------------------------------------------------
		
		
		// ------------------Division para los botones-------------------------
		$atributos ["id"] = "botones";
		$atributos ["estilo"] = "marcoBotones";
		echo $this->miFormulario->division ( "inicio", $atributos );
		
		// -----------------CONTROL: Botón Consultar----------------------------------------------------------------
		$esteCampo = 'botonConsultar';
		$atributos ['id'] = $esteCampo;
		$atributos ['tabIndex'] = $tab;
		$atributos ['tipo'] = 'boton';
		// submit: no se coloca si se desea un tipo button genérico
		$atributos ['submit'] = true;
		$atributos ['estiloMarco'] = '';
		$atributos ['estiloBoton'] = 'jqueryui';
		$atributos ['marco'] = true;
		$atributos ['columnas'] = 1;
		// verificar: true para verificar el formulario antes de pasarlo al servidor.
		$atributos ['verificar'] = '';
		$atributos ['tipoSubmit'] = 'jquery'; // Dejar vacio para un submit normal, en este caso se ejecuta la función submit declarada en ready.js
		$atributos ['valor'] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['nombreFormulario'] = $esteBloque ['nombre'];
		$tab ++;
		
		// Aplica atributos globales al control
		$atributos = array_merge ( $atributos, $atributosGlobales );
		echo $this->miFormulario->campoBoton ( $atributos );
		unset ( $atributos );
		// -----------------FIN CONTROL: Botón Consultar -----------------------------------------------------------
		// ------------------Fin Division para los botones-------------------------
		
		echo $this->miFormulario->division ( 'fin' );
		
		// ------------------- SECCION: Paso de variables ------------------------------------------------
		
		/**
		 * En algunas ocasiones es útil pasar variables entre las diferentes páginas.
		 * SARA permite realizar esto a través de tres
		 * mecanismos:
		 * (a). Registrando las variables como variables de sesión. Estarán disponibles durante toda la sesión de usuario. Requiere acceso a
		 * la base de datos.
		 * (b). Incluirlas de manera codificada como campos de los formularios. Para ello se utiliza un campo especial denominado
		 * formsara, cuyo valor será una cadena codificada que contiene las variables.
		 * (c) a través de campos ocultos en los formularios. (deprecated)
		 */
		
		// En este formulario se utiliza el mecanismo (b) para pasar las siguientes variables:
		
		// Paso 1: crear el listado de variables
		
		$valorCodificado = 'actionBloque=' . $esteBloque ['nombre'];
		$valorCodificado .= '&pagina=' . $this->miConfigurador->getVariableConfiguracion ( 'pagina' );
		$valorCodificado .= '&bloque=' . $esteBloque ['nombre'];
		$valorCodificado .= '&bloqueGrupo=' . $esteBloque ['grupo'];
		$valorCodificado .= '&opcion=mostrarIngreso'; // Aqui se pone la opción a la cual se dirige la funcion
		$valorCodificado .= '&saludo=vamosAtrabajar';
		/**
		 * SARA permite que los nombres de los campos sean dinámicos.
		 * Para ello utiliza la hora en que es creado el formulario para
		 * codificar el nombre de cada campo.
		 */
		$valorCodificado .= '&campoSeguro=' . $_REQUEST ['tiempo'];
		// Paso 2: codificar la cadena resultante
		$valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar ( $valorCodificado );
		
		$atributos ['id'] = 'formSaraData'; // No cambiar este nombre
		$atributos ['tipo'] = 'hidden';
		$atributos ['estilo'] = '';
		$atributos ['obligatorio'] = false;
		$atributos ['marco'] = true;
		$atributos ['etiqueta'] = '';
		$atributos ['valor'] = $valorCodificado;
		echo $this->miFormulario->campoCuadroTexto ( $atributos );
		unset ( $atributos );
		
		// ----------------FIN SECCION: Paso de variables -------------------------------------------------
		
		// ---------------- FIN SECCION: Controles del Formulario -------------------------------------------
		
		// ----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
		// Se debe declarar el mismo atributo de marco con que se inició el formulario.
		$atributos ['marco'] = true;
		$atributos ['tipoEtiqueta'] = 'fin';
		echo $this->miFormulario->formulario ( $atributos );
		
		// Parametros Necesarios para una Url en SARA
		$directorio = $this->miConfigurador->getVariableConfiguracion ( "host" );
		$directorio .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/index.php?";
		$directorio .= $this->miConfigurador->getVariableConfiguracion ( "enlace" );
		
		$variable = "pagina=development";
		// $variable.="&opcion= estiloMarco";
		$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable, $directorio );
		// ******************************************************************************
		
		// -----------------CONTROL: Link development ----------------------------------------------------------------
		$esteCampo = 'linkDevelopment';
		$atributos ['id'] = $esteCampo;
		$atributos ['enlace'] = $variable;
		$atributos ['tabIndex'] = $tab;
		$atributos ['tipo'] = 'link';
		$atributos ['estilo'] = ' ';
		$atributos ['enlaceTexto'] = $this->lenguaje->getCadena ( $esteCampo );
		$tab ++;
		
		// Aplica atributos globales al control
		$atributos = array_merge ( $atributos, $atributosGlobales );
		echo $this->miFormulario->enlace ( $atributos );
		unset ( $atributos );
		
		// -----------------FIN CONTROL: Link development -----------------------------------------------------------
		
		return true;
	}
	function mensaje() {
		
		// Si existe algun tipo de error en el login aparece el siguiente mensaje
		$mensaje = $this->miConfigurador->getVariableConfiguracion ( 'mostrarMensaje' );
		$this->miConfigurador->setVariableConfiguracion ( 'mostrarMensaje', null );
		
		if ($mensaje) {
			
			$tipoMensaje = $this->miConfigurador->getVariableConfiguracion ( 'tipoMensaje' );
			
			if ($tipoMensaje == 'json') {
				$atributos ['mensaje'] = $mensaje;
				$atributos ['json'] = true;
			} else {
				$atributos ['mensaje'] = $this->lenguaje->getCadena ( $mensaje );
			}
			// -------------Control texto-----------------------
			$esteCampo = 'divMensaje';
			$atributos ['id'] = $esteCampo;
			$atributos ['tamanno'] = '';
			$atributos ['estilo'] = 'information';
			$atributos ['etiqueta'] = '';
			$atributos ['columnas'] = ''; // El control ocupa 47% del tamaño del formulario
			echo $this->miFormulario->campoMensaje ( $atributos );
			unset ( $atributos );
		}
		
		return true;
	}
}

$miFormulario = new Formulario ( $this->lenguaje, $this->miFormulario, $this->sql );

$miFormulario->formulario ();
$miFormulario->mensaje ();

?>