<?php
include  './includes/funciones.php';
include './includes/config/database.php';
incluirTemplate('header');
$db = conectarDB();

if($_POST != []){
$pelicula = mysqli_real_escape_string($db,$_POST['search_movie']);
}

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
      if(isset($pelicula)){


        $resultado = buscarPelicula($db,$pelicula);
       while($peliculas = mysqli_fetch_assoc($resultado)){   include './card.php';?>

       
        

      <?php  }}else{

                $resultado = buscarPelicula($db,'');
                while($peliculas = mysqli_fetch_assoc($resultado)){   include './card.php';

            }} ?>

     
    

    </div>

</section>






<?php incluirTemplate('footer');?>