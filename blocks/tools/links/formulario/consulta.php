<?php
if (!isset($GLOBALS['autorizado'])) {
	include ('../index.php');
	exit();
}

use tools\links\funcion\getLink;

class registrarForm {

	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;

	function __construct($lenguaje, $formulario) {
		$this -> miConfigurador = \Configurador::singleton();

		$this -> miConfigurador -> fabricaConexiones -> setRecursoDB('principal');

		$this -> lenguaje = $lenguaje;

		$this -> miFormulario = $formulario;
	}

	function miForm() {

		// Rescatar los datos de este bloque
		$esteBloque = $this -> miConfigurador -> getVariableConfiguracion('esteBloque');

		// ---------------- SECCION: Parámetros Globales del Formulario ----------------------------------
		/**
		 * Atributos que deben ser aplicados a todos los controles de este formulario.
		 * Se utiliza un arreglo
		 * independiente debido a que los atributos individuales se reinician cada vez que se declara un campo.
		 *
		 * Si se utiliza esta técnica es necesario realizar un mezcla entre este arreglo y el específico en cada control:
		 * $atributos= array_merge($atributos,$atributosGlobales);
		 */
		$atributosGlobales['campoSeguro'] = 'true';

		$_REQUEST['tiempo'] = time();
		
		
		// Limpia Items Tabla temporal
		// ---------------- SECCION: Parámetros Generales del Formulario ----------------------------------
		$esteCampo = $esteBloque['nombre'];
		$atributos['id'] = $esteCampo;
		$atributos['nombre'] = $esteCampo;
		// Si no se coloca, entonces toma el valor predeterminado 'application/x-www-form-urlencoded'
		$atributos['tipoFormulario'] = 'multipart/form-data';
		// Si no se coloca, entonces toma el valor predeterminado 'POST'
		$atributos['metodo'] = 'POST';
		// Si no se coloca, entonces toma el valor predeterminado 'index.php' (Recomendado)
		$atributos['action'] = 'index.php';
		// $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo );
		// Si no se coloca, entonces toma el valor predeterminado.
		$atributos['estilo'] = '';
		$atributos['marco'] = true;
		$tab = 1;
		// ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------
		// ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
		$atributos['tipoEtiqueta'] = 'inicio';
		echo $this -> miFormulario -> formulario($atributos);
		// ---------------- SECCION: Controles del Formulario -----------------------------------------------

		$esteCampo = 'marcoDatosBasicos';
		$atributos['id'] = $esteCampo;
		$atributos['estilo'] = 'jqueryui';
		$atributos['tipoEtiqueta'] = 'inicio';
		$atributos['leyenda'] = 'Criterios de Búsqueda';
		echo $this -> miFormulario -> marcoAgrupacion('inicio', $atributos);

		$esteCampo = 'AgrupacionDisponibilidad';
		$atributos['id'] = $esteCampo;
		$atributos['leyenda'] = 'Primer Filtro';
		echo $this -> miFormulario -> agrupacion('inicio', $atributos);

			
		// ------------------Division para los botones-------------------------
		$atributos['id'] = 'botones';
		$atributos['estilo'] = 'marcoBotones';
		echo $this -> miFormulario -> division('inicio', $atributos);

 		// -----------------CONTROL: Link development ----------------------------------------------------------------
		$esteCampo = 'linkDevelopment';		
		$atributos['id'] = $esteCampo;		
		$linkPagina = 'development';
		$direccion = getLink::obtener($linkPagina);;
		$atributos['enlace'] = $direccion;
		$atributos['tabIndex'] = $tab;
		$atributos['tipo'] = 'link';
		$atributos['estilo'] = 'jqueryui';
		$atributos['enlaceTexto'] = $this -> lenguaje -> getCadena($esteCampo);
		$tab++;

		// Aplica atributos globales al control
		$atributos = array_merge($atributos, $atributosGlobales);
		echo $this -> miFormulario -> enlace($atributos);
		// -----------------FIN CONTROL: Link development -----------------------------------------------------------
		
		// -----------------CONTROL: Link ----------------------------------------------------------------
		$esteCampo = 'linkDevelopment1';		
		$atributos['id'] = $esteCampo;		
		$linkPagina = 'constructor';
		$direccion = getLink::obtener($linkPagina);;
		$atributos['enlace'] = $direccion;
		$atributos['tabIndex'] = $tab;
		$atributos['tipo'] = 'link';
		$atributos['estilo'] = 'jqueryui';
		$atributos['enlaceTexto'] = $this -> lenguaje -> getCadena($esteCampo);
		$tab++;

		// Aplica atributos globales al control
		$atributos = array_merge($atributos, $atributosGlobales);
		echo $this -> miFormulario -> enlace($atributos);
		// -----------------FIN CONTROL: Link -----------------------------------------------------------
		
		// -----------------CONTROL: Link ----------------------------------------------------------------
		$esteCampo = 'linkDevelopment2';		
		$atributos['id'] = $esteCampo;		
		$linkPagina = 'registro';
		$direccion = getLink::obtener($linkPagina);;
		$atributos['enlace'] = $direccion;
		$atributos['tabIndex'] = $tab;
		$atributos['tipo'] = 'link';
		$atributos['estilo'] = 'jqueryui';
		$atributos['enlaceTexto'] = $this -> lenguaje -> getCadena($esteCampo);
		$tab++;

		// Aplica atributos globales al control
		$atributos = array_merge($atributos, $atributosGlobales);
		echo $this -> miFormulario -> enlace($atributos);
		// -----------------FIN CONTROL: Link -----------------------------------------------------------
		
		// -----------------CONTROL: Link ----------------------------------------------------------------
		$esteCampo = 'linkDevelopment3';		
		$atributos['id'] = $esteCampo;		
		$linkPagina = 'desenlace';
		$direccion = getLink::obtener($linkPagina);;
		$atributos['enlace'] = $direccion;
		$atributos['tabIndex'] = $tab;
		$atributos['tipo'] = 'link';
		$atributos['estilo'] = 'jqueryui';
		$atributos['enlaceTexto'] = $this -> lenguaje -> getCadena($esteCampo);
		$tab++;

		// Aplica atributos globales al control
		$atributos = array_merge($atributos, $atributosGlobales);
		echo $this -> miFormulario -> enlace($atributos);
		// -----------------FIN CONTROL: Link -----------------------------------------------------------
		
		// ---------------------------------------------------------
		// ------------------Fin Division para los botones-------------------------
		echo $this -> miFormulario -> division('fin');

		echo $this -> miFormulario -> marcoAgrupacion('fin');
		
	}
		
}

$miSeleccionador = new registrarForm($this -> lenguaje, $this -> miFormulario);

$miSeleccionador -> miForm();
?>
