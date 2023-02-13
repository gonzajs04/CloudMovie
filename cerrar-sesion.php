<?php
include __DIR__ . '/includes/funciones.php';
$auth = isAutenticado();

if(!$auth){
   
    header('Location: /');
}else{
    $_SESSION = [];
    header('Location: /');
}

?>