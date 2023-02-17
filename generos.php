<?php
include './includes/config/database.php';

include './includes/funciones.php';
incluirTemplate('header');
$db = conectarDB();

$idGenero = intval($_GET['resultado']);
if(!$idGenero){
   header('Location: /');

}

$sql = "SELECT g.nombre_genero from generos as g where g.id = $idGenero";
$resultado = mysqli_query($db,$sql);
$titulo = mysqli_fetch_assoc($resultado);

$sql = "SELECT p.id, g.nombre_genero,p.nombre,p.imagen,p.descripcion FROM generos as g, generos_peliculas as gp, peliculas as p WHERE g.id = gp.idGenero and p.id = gp.idPelicula AND g.id = $idGenero";
$resultado = mysqli_query($db,$sql);

?>


<section class="destacados contenedor" id="contenido">

    <div class="title-destacados">
       <img src="build/img/nube.webp" alt="logo nube" class="logo">
       <h2 class="destacados-subtitle"><?php echo $titulo['nombre_genero'];?></h2>

    </div>

    <hr class="line-divisor">

    <div class="containerg-destacados"> <!--ME SUPORTEA EL GRID QUE VA A TENER 6 PELICULAS DESTACADAS-->

        <div class="grid-destacados"> <!-- 6 COLUMNAS-->

        <?php
    while($peliculas = mysqli_fetch_assoc($resultado)){
    
        include 'card.php';
        ?>

    
               

    <?php } ?>

     

                 
        </div>

    </div>

</section>
    </header>     
 <?php incluirTemplate('footer');?>