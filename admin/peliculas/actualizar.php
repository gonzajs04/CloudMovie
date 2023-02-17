<?php

include __DIR__ . '/../../includes/funciones.php';
include __DIR__ . '/../../includes/config/database.php';
use Intervention\Image\ImageManagerStatic as Image;


incluirTemplate('header');
$db = conectarDB();

$auth = controlarUsuario();
if(!$auth){
    header('Location: /login.php');
}


$id = filter_var(intval($_GET['pelicula']),FILTER_SANITIZE_NUMBER_INT);

if(!$id){
    header('Location: /admin');
}
$generos = [];
$sql ="SELECT p.nombre,p.descripcion,p.lanzamiento,p.imagen,p.duracion,p.idDirector FROM peliculas as p, directores as d where p.idDirector = d.id AND p.id=$id";

$resultado = mysqli_query($db,$sql);
$pelicula = mysqli_fetch_assoc($resultado);


/////////////////////////////////////////

$titulo = $pelicula['nombre'];
$descripcion = $pelicula['descripcion'];
$lanzamiento = $pelicula['lanzamiento'];
$duracion = $pelicula['duracion'];
$director = $pelicula['idDirector'];
$imagenSql = $pelicula['imagen'];

////////////////////////////////////////////////

$trailer = consultarTrailers($db,$id);

$urlTrailer = $trailer['urlTrailer'];



if($_POST != []){

     
   $titulo = mysqli_real_escape_string($db,$_POST['titulo']);
   $descripcion = mysqli_real_escape_string($db,$_POST['descripcion']);
   $lanzamiento = mysqli_real_escape_string($db,$_POST['lanzamiento']);
   $duracion = mysqli_real_escape_string($db,$_POST['duracion']);
   $director =mysqli_real_escape_string($db,$_POST['director']);
   $urlTrailer = filter_var($_POST['trailer'],FILTER_SANITIZE_URL);
  
   $generos = getGenerosSeleccionados($_POST['generos']);
 
   $errores = getErrores($titulo,$descripcion,$lanzamiento,$duracion,$director,$_FILES['imagen']['tmp_name'],$trailer,$generos);

   if(empty($errores)){
   
    
        $nombreImg = md5(uniqid(rand(),true)) . ".jpg";

        $imagen = Image::make($_FILES['imagen']['tmp_name'])->fit(250,250);
        
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }
      
        if(file_exists(CARPETA_IMAGENES . $imagenSql)){

             unlink(CARPETA_IMAGENES . $imagenSql);

             $sql = "UPDATE peliculas as p, directores as d SET p.nombre = '$titulo', p.descripcion='$descripcion', p.lanzamiento='$lanzamiento',p.duracion='$duracion',p.idDirector='$director', p.imagen='$nombreImg' WHERE p.idDirector = d.id and p.id=$id and d.id=$director";

             $resultado=mysqli_query($db,$sql);
            
             borrarGeneros($id,$db,$generos);
            

        }else{
            $sql = "UPDATE peliculas as p, directores as d SET p.nombre = '$titulo', p.descripcion='$descripcion', p.lanzamiento='$lanzamiento',p.duracion='$duracion',p.idDirector='$director', p.imagen='$nombreImg' WHERE p.idDirector = d.id and p.id=$id and d.id=$director";

            $resultado=mysqli_query($db,$sql);

            borrarGeneros($id,$db,$generos); //BORRO LOS GENEROS SELECCIONADOS PARA LA PELICULA A ACTUALIZAR

        }

        $imagen->save(CARPETA_IMAGENES . $nombreImg);
        header("Location: /admin");

   }


}

function borrarGeneros($id,$db,$generos){


    $sql="DELETE gp.* from generos_peliculas as gp, generos as g, peliculas as p WHERE gp.idPelicula = p.id AND g.id=gp.idGenero AND p.id=$id";
  

    $resultado = mysqli_query($db,$sql);

    insertGP($db,$id,$generos); //INSERTO LOS GENEROS SELECCIONADOS PARA LA PELICULA A ACTUALIZAR

}




?>


</header>

<section class="contenedor actualizar-pelicula" style=" background-color:#02040c;">
<h2 style=" text-align:center;">Actualizar Pelicula</h2>



<form action="#" class="form-peliculas" method="POST" enctype="multipart/form-data">

    <?php include '../form.php';?>

    <input type="submit" value="Actualizar pelicula">

</form>

</section>

<?php incluirTemplate('footer')?>