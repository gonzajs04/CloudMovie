<?php
include __DIR__ . '/includes/funciones.php';
include __DIR__ . '/includes/config/database.php';
incluirTemplate('header');
$db = conectarDB();

$pelicula = mysqli_real_escape_string($db,$_POST['search_movie']);


?>

    <div class="container-form">
        <form action="#" class="form_buscar" method="POST">
      
            <div class="container-buscar">
            <h2>Buscar Pelicula</h2>
                <input type="search" class="search_movie" name="search_movie" id="search_movie" placeholder="Buscar">
                <input type="submit" class="btnBuscar" name="btnBuscar" value="Buscar">

            </div>

        </form>

        <hr>
    </div>

<section class="contenedor peliculas">
    <div class="container-peliculas">
       <?php 
       $sql = "SELECT p.id,p.nombre,p.imagen,p.descripcion from peliculas as p where p.nombre like '%$pelicula%'";
       $resultado = mysqli_query($db,$sql);
       while($peliculas = mysqli_fetch_assoc($resultado)){   include __DIR__ . '/card.php';?>

       
        

      <?php  } ?>
    

    </div>

</section>






<?php incluirTemplate('footer');?>