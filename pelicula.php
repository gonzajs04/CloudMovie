<?php
include __DIR__ . '/includes/funciones.php';
include __DIR__ . '/includes/config/database.php';

$db = conectarDB();
incluirTemplate('header');


$idPelicula = filter_var(intval($_GET['resultado']),FILTER_SANITIZE_NUMBER_INT);
if($idPelicula){

$sql = "SELECT   p.nombre, p.descripcion, p.imagen, d.nombre_director, d.apellido_director,p.likes,p.duracion FROM  peliculas as p, directores as d
 WHERE  d.id = p.idDirector AND p.id = $idPelicula ";

$resultado = mysqli_query($db,$sql);

while($pelicula = mysqli_fetch_assoc($resultado)){


    $titulo = filter_var($pelicula['nombre']) ? $pelicula['nombre'] : '';
    $descripcion =  filter_var($pelicula['descripcion']) ? $pelicula['descripcion'] : '';
    $director =  filter_var($pelicula['nombre_director'] . ' '. $pelicula['apellido_director']) ? $pelicula['nombre_director'] . ' '. $pelicula['apellido_director'] : ''; //CREAR FUNCION PARA ESTO
    $imagenPelicula = $pelicula['imagen'];
    $likes = filter_var($pelicula['likes'],FILTER_SANITIZE_NUMBER_INT) ? $pelicula['likes'] : '';
    $duracion = filter_var($pelicula['duracion'],FILTER_SANITIZE_FULL_SPECIAL_CHARS) ? $pelicula['duracion'] : '';
    
//PARA GENEROS HACER UN WHILE EXCLUSIVO YA QUE PUEDE TENER MAS DE UN GENERO LO MISMO PARA ACTORES Y ACTRICES Y PERSONAJES

}

$trailer = consultarTrailers($db,$idPelicula);

}else{
    header('Location: /');
}


?>
  
<section class="content">

    <div class="content_play">
        <div class="content_img">
            <picture class="img_movie">
              <?php
              $directorio = file_exists(CARPETA_IMAGENES . $imagenPelicula);
              if(!$directorio){?>
                <source srcset="build/img/<?php echo $imagenPelicula;?>" type="image/webp">
               <img loading ="lazy" src="build/img/ <?php echo $imagenPelicula;?> " alt="imagen de pelicula"> 
                <?php }if($directorio){?>
                    <source srcset="imagenes/<?php echo $imagenPelicula;?>" type="image/webp">
                <img loading ="lazy" src="imagenes/ <?php echo $imagenPelicula;?> " alt="imagen de pelicula"> 
                <?php }?>  
            </picture>

            <div class="content_stream">
                <img src="" alt="">
                <p>Ya esta al aire</p>
                <a href="<?php echo $trailer['urlTrailer']?>">
                    <strong>Ver ahora</strong>
                </a>
            </div>
        </div>

        <div class="content_data">
            <h1><?php echo $titulo;?></h1>
            <ul>
                
                <?php
                $sql = "SELECT g.nombre_genero from generos as g, generos_peliculas as gp where g.id = gp.idGenero AND gp.idPelicula = $idPelicula";
                $resultado = mysqli_query($db,$sql);
                

                while($genero = mysqli_fetch_assoc($resultado)){?>

                    <li class="li_while"><?php echo $genero['nombre_genero'] != '' ? $genero['nombre_genero'] : '';?></li>

                <?php } ?>
                <div class="container-likes">
                     <img class="logo logo_like" src="/build/img/like.webp" alt="">
                     <li class="verde content_caracs" ><?php echo $likes;?></li>
                </div>
               <div class="container-duracion">
                    <img class= "logo logo_clock" src="/build/img/clock.webp" alt="">
                    <li class="content_caracs"><?php echo $duracion;?></li>
               </div>
          
           </ul>  

            <a href="" class="a_trailer">Ver trailer</a>

            <h2>Descripcion</h2>
            <p><?php echo $descripcion;?>
            </p>
            <h2>Director</h2>
            <p><?php echo $director;?></p>
        </div>


    </div>

    <div class="background">
        <picture>
       
            <source srcset="build/img/<?php echo $imagenPelicula;?>" type="image/webp">
            <img loading ="lazy" src="build/img/<?php echo $imagenPelicula;?>.jpg" alt="">
        </picture>
            
    </div>

</section>
</header> <!--CIERRO EL HEADER PARA QUE NO ME OCUPE TODA LA PAGINA, NO LO CIERRO EN EL TEMPLATE YA QUE NO ME SIRVE PARA TODAS LAS PAGINAS. COMO LA NAVEGACION EN RESPONSIVE, OCUPA EL HEIGHT DEL 100% DE LA PRIMERA SECCION, EL HEADER SE ABRE ANTES DE LA PRIMERA SECCION Y SE CIERRA DESPUES DE LA PRIMERA SECCION-->


    <section class="actors-media">
        <div class="contenedor container-actor-media">
        <div class="container_actors">
            <h2>Reparto</h2>
            <ol class="actors-scroll">
                <?php 
                $sql = "SELECT pe.nombre_personaje, a.nombre_actor,a.apellido_actor,a.imagen_actor from personajes as pe, actores as a , personajes_peliculas as pp where pe.id = pp.idPersonaje AND pp.idPelicula = $idPelicula AND a.id = pe.idActor";

                $resultado = mysqli_query($db, $sql);
            
                ?>
                <?php while($actor = mysqli_fetch_assoc($resultado)){?>
                <li class="card"> 
                    <a href="">  
                        <img src="build/img/<?php echo $actor['imagen_actor']?>" alt="Imagen del actor"><!--imagen del actor-->
                        <p  class="card-actor"><?php echo $actor['nombre_actor'] . ' '. $actor['apellido_actor']; ?></p> <!--NOMBRE DE LA ACTRIZ-->
                    </a>
                    <p class="card-personaje" ><?php echo $actor['nombre_personaje'];?></p> <!---->

                </li>
                 
             <?php } ?>
            </ol>

        </div> <!--Termina container de actores-->



        <div class="container-media">

            <div class="media-facebook">
               <picture>
   
                    <source srcset="build/img/facebook.webp" type="image/webp">
                    <img loading ="lazy" src="build/img/facebook.png" alt="Logo facebook">
               </picture>
               <p>Facebook</p>
            </div>
            <div class="media-insta">
                <picture>
                    <source srcset="build/img/instagram.webp" type="image/webp">
                    <img loading ="lazy" src="build/img/instagram.png" alt="Logo instagram">
                </picture>
                <p>Instagram</p>

            </div>

            <div class="media-twitter">
                <picture>
                    <source srcset="build/img/twitter.webp" type="image/webp">
                    <img loading ="lazy" src="build/img/twitter.png" alt="Logo Twitter">
                </picture>
                <p>Twitter</p>

            </div>
            

        </div>

    </div>

    </section>

    <footer class="footer" >

        <div class="footer-contenido">
            <p>const page = new Page("<span>CloudMovie</span> &copy , Developed by Gonzalo Hernandez")</p>
        </div>
        
        
        </footer>

 <script src="build/js/bundle.min.js"></script> 
    
</body>
</html>