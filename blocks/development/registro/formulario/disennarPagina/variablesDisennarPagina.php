<?php
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

$valorCodificado = "actionBloque=" . $this->esteBloque ["nombre"];
$valorCodificado .= "&pagina=" . $this->miConfigurador->getVariableConfiguracion ( 'pagina' );
$valorCodificado .= "&bloque=" . $this->esteBloque ['nombre'];
$valorCodificado .= "&bloqueGrupo=" . $this->esteBloque ["grupo"];
$valorCodificado .= "&opcion=registrarPagina";
/**
 * SARA permite que los nombres de los campos sean dinámicos.
 * Para ello utiliza la hora en que es creado el formulario para
 * codificar el nombre de cada campo. Si se utiliza esta técnica es necesario pasar dicho tiempo como una variable:
 * (a) invocando a la variable $this->atributosGlobales ['tiempo'] que se ha declarado en ready.php o
 * (b) asociando el tiempo en que se está creando el formulario
 */
$valorCodificado .= "&campoSeguro=" . $this->atributosGlobales ['tiempo'];
// Paso 2: codificar la cadena resultante
$valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar ( $valorCodificado );

$atributos ["id"] = "formSaraData"; // No cambiar este nombre
$atributos ["tipo"] = "hidden";
$atributos ['estilo'] = '';
$atributos ["obligatorio"] = false;
$atributos ['marco'] = true;
$atributos ["etiqueta"] = "";
$atributos ["valor"] = $valorCodificado;
echo $this->miFormulario->campoCuadroTexto ( $atributos );
unset ( $atributos );

// ----------------FIN SECCION: Paso de variables -------------------------------------------------

// ----------------FINALIZAR EL FORMULARIO ----------------------------------------------------------
// Se debe declarar el mismo atributo de marco con que se inició el formulario.
$atributos ['marco'] = true;
$atributos ['tipoEtiqueta'] = 'fin';
echo $this->miFormulario->formulario ( $atributos );
?>