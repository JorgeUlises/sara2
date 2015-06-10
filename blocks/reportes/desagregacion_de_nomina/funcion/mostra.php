<?php

namespace reportes\desagregacion_de_nomina\funcion;


include_once('Redireccionador.php');

class mostrar {
    
    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miSql;
    var $conexion;
    
    function __construct($lenguaje, $sql) {
        
        $this->miConfigurador = \Configurador::singleton ();
        $this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
        $this->lenguaje = $lenguaje;
        $this->miSql = $sql;
    
    }
    
    function procesarFormulario() {    

        //Aquí va la lógica de procesamiento
    
       echo $_REQUEST['saludo']. "Usted digitó en el formulario ".$_REQUEST['nombreBloque'];
       
    	$conexion = "estructura";
    	$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
    	
    	$parametros=array(
    		'nombre'=>$_REQUEST['nombreBloque'],
    	);
    	
//     	 $cadenaSql = $this->miSql->getCadenaSql('solicitarPagina', $parametros);
//     	$resultado= $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
    	
//     	var_dump($resultado);
    	
//     	exit;
        //Al final se ejecuta la redirección la cual pasará el control a otra página
        $variable=array(
        	'digitado'=>$_REQUEST['nombreBloque'],
        		'hora'=>date('Y-m-d'),
        );
        echo 'Aqui estamos';
        exit;
        
        Redireccionador::redireccionar('opcion1',$variable);
    	        
    }
    
    function resetForm(){
        foreach($_REQUEST as $clave=>$valor){
             
            if($clave !='pagina' && $clave!='development' && $clave !='jquery' &&$clave !='tiempo'){
                unset($_REQUEST[$clave]);
            }
        }
    }
    
}

$miProcesador = new mostrar ( $this->lenguaje, $this->sql );

$resultado= $miProcesador->procesarFormulario ();

