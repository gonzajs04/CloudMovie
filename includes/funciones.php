<?php

require  __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); //CARGAMOS LA SUPERGLOBAL CON LOS DATOS OTORGADOS EN ARCHIVO .ENV
$dotenv->safeLoad(); //EN CASO DE QUE FALLE, QUE NO NOS ARROJE ERROR




function incluirTemplate(string $nombre, $inicio = false){

    include __DIR__ . '/templates/' . $nombre . ".php";

}

function isLogueado(){ //CONTROLA SI INICIO SESSION ALGUIEN
 
    if(!isset($_SESSION)){
        session_start();
        return true;
    }
  
    return false;
}   

function controlarUsuario(){ //CONTROLA SI HAY UN USUARIO LOGUEADO
  session_start();
    if(!isset($_SESSION['login'])){
        return false;
    }
    return true;
}




function debuguear($array){
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}


function getErrores($titulo,$descripcion,$lanzamiento,$duracion,$director,$imagen,$trailer,$generos) :array{

 
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

    if(!$trailer){
        $errores[]="Debes ingresar un trailer para la pelicula";
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


    function consultarTrailers($db,$id){
        $sql = "SELECT urlTrailer from trailers as t, peliculas as p where p.id = t.idPelicula AND p.id = $id";
        $resultado = mysqli_query($db,$sql);
        $trailer = mysqli_fetch_assoc($resultado);
        return $trailer;
    
    }

    function insertGP($db,$id,$generos){ //inserta en generos_peliculas

        foreach ($generos as $genero) {
          
            $sql = "INSERT INTO generos_peliculas(idGenero,idPelicula) VALUES('$genero','$id')";
            $resultado = mysqli_query($db,$sql);
    
        }
    
    }


    function buscarPelicula($db,$pelicula){ //BUSCA LAS PELICULAS RELACIONADAS A LO QUE PONGAMOS EN EL FORM

        $sql = "SELECT p.id,p.nombre,p.imagen,p.descripcion from peliculas as p where p.nombre like '%$pelicula%'";
        $resultado = mysqli_query($db,$sql);
        return $resultado;
    }
    


    define('CARPETA_IMAGENES',__DIR__ . '/../imagenes/');
    define('CARPETA_BUILD', __DIR__ . '/../build/img/' );

    
 
?>