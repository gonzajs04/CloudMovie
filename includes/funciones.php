<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); //CARGAMOS LA SUPERGLOBAL CON LOS DATOS OTORGADOS EN ARCHIVO .ENV
$dotenv->safeLoad(); //EN CASO DE QUE FALLE, QUE NO NOS ARROJE ERROR




function incluirTemplate(string $nombre, $inicio = false){

    include __DIR__ . '/templates/' . $nombre . ".php";

}

function isAutenticado(){

    session_start();
    if(!$_SESSION || $_SESSION == []){
        return false;
    }
    return true;
}   


function debuguear($array){
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}


function getErrores($titulo,$descripcion,$lanzamiento,$duracion,$director,$imagen,$generos) :array{

 
    $errores = [];
    
    if($titulo === '' || !$titulo){
        $errores[] = "EL titulo no puede estar vacio";
    }
    
    if($descripcion === '' || !$descripcion){
        $errores[] = "La descripcion no puede estar vacia";
    }
    if($lanzamiento === '' || !$lanzamiento){
        $errores[] = "Tiene que haber una fecha de lanzamiento";
    }
    
    if($duracion === '' || !$duracion){
        $errores[] = "La pelicula debe tener una duracion";
    }
    if(!$director){
        $errores[] = "La pelicula debe tener al menos un director";
    }
    if(empty($generos)){
        $errores[] = "La pelicula debe tener al menos un genero";
    }
    if(!$imagen){
        $errores[] = 'Debe haber una imagen';
    }
    
    
        return $errores;
    
    }

   
    function getGenerosSeleccionados($generosPost){ //OBTENER GENERO DE FORMULARIO
        $i = 0;
        $generos=[];
        foreach($generosPost as $genero){
            $generos[$i] = $genero;
            $i++;
           }
        return $generos;
    }


    function sanitizar($elemento){
        $elementoSanitizado = htmlspecialchars($elemento);
        return $elementoSanitizado;

    }
    define('CARPETA_IMAGENES',__DIR__ . '/../imagenes/');
    define('CARPETA_BUILD', __DIR__ . './../build/img/' );

    
 
?>