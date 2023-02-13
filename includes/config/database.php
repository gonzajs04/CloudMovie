<?php


function conectarDB() : mysqli{
    $db = mysqli_connect(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_DATABASE']
    );
    if(!$db){
        echo "no se pudo conectar";
        exit;
    }

    return $db;
}



?>