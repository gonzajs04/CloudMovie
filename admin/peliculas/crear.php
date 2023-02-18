<?php

include __DIR__ . '/../../includes/funciones.php';
include __DIR__ . '/../../includes/config/database.php';

use Intervention\Image\ImageManagerStatic as Image;
$db = conectarDB();
incluirTemplate('header');
$auth = controlarUsuario();

if(!$auth){
    echo "<script>window.location.href='/login.php'</script>";

}



$errores=[];
if($_POST != []){
  
   $titulo = mysqli_real_escape_string($db,$_POST['titulo']);
   $descripcion = mysqli_real_escape_string($db,$_POST['descripcion']);
   $lanzamiento = mysqli_real_escape_string($db,$_POST['lanzamiento']);
   $duracion = mysqli_real_escape_string($db,$_POST['duracion']);
   $director =mysqli_real_escape_string($db,$_POST['director']);
   $urlTrailer = $_POST['trailer'];

    $generos = getGenerosSeleccionados($_POST['generos']); //OBTENGO TODOS LOS GENEROS SELECCIONADOS DE CHECKBOX | FORMA PARTE DEL FORMULARIO
   
   $errores = getErrores($titulo,$descripcion,$lanzamiento,$duracion,$director,$_FILES['imagen']['tmp_name'],$trailer,$generos);


   if(empty($errores)){

    $nombreImg =md5(uniqid(rand(),true)) . ".jpg";
    if($nombreImg){
        $imagen = Image::make($_FILES['imagen']['tmp_name'])->fit(250,250);

        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }

        $sql = "INSERT into peliculas (idDirector,nombre,imagen,imagen_grande,duracion,descripcion,likes,vistas,lanzamiento) VALUES ('$director','$titulo','$nombreImg','','$duracion','$descripcion',0,0,'$lanzamiento') ";
        $resultado  = mysqli_query($db, $sql);

        $sql = "SELECT max(id) from peliculas";
        $resultado  = mysqli_query($db,$sql);
        $id = mysqli_fetch_assoc($resultado);
        $maxId = intval($id['max(id)']);


        $sql = "INSERT INTO trailers(idPelicula,urlTrailer) values('$maxId',$trailer)"; //inserto trailer
        $resultado = mysqli_query($db,$sql);

    

        foreach($generos as $genero){
            $sql = "INSERT into generos_peliculas(idGenero,idPelicula) VALUES('$genero','$maxId')";
            $resultado  = mysqli_query($db, $sql);
        }

        $imagen->save(CARPETA_IMAGENES . $nombreImg);
       

    }
  
   }
    

}




?>
</header>
<section class="contenedor crear-pelicula">

<form action="#" class="form-peliculas" method="POST" enctype="multipart/form-data">

    <?php include '../form.php';?>

    <input type="submit" value="Añadir pelicula">

</form>

</section>










<?php incluirTemplate('footer')?>