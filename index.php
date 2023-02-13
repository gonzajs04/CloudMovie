<?php
include 'includes/funciones.php';
include 'includes/config/database.php';
incluirTemplate('header',true);

$db = conectarDB(); //CONECTO EXITOSAMENTE

//REFORZAR Y AP´RENDER POR CUENTA PROPIA ACTIVE RECORD Y MVC(MODEL VIEW CONTROLLER)
//aprender a buscar peliculas sin necesidad de apretar enter con un form a traves de POST PARA ESTO APRENDER AJAX PARA COMUNICAR JS CON PHP


//TOCAR EL LOGO DE LA BARRA DE NAVEGACION Y DESPLEGAR FRANQUICIAS DISPONIBLES COMO DISNEY +, PIXAR, MARVEL, natiol geographics,  dcCARTOON NETWOORK

//HACER PANEL ADMINISTRATIVO DE AGREGAR PELICULAS O EDITARLAS
$query = "SELECT * FROM peliculas WHERE vistas >
(SELECT min(vistas) from peliculas) LIMIT 6";
$resultadoPeliculas  = mysqli_query($db,$query);
?>

  <!--Seguir con seccionde lo mas recientre ES DECIR PELICULAS QUE TIENEN FGECHA DE MENOS DE 5 MESES DE ANTIGUEDAD
    EN PREGUNTAS FRECUENTES COLOCAR UN BOTON QUE REDIRIJA A UNA NUEVA PAGINA QUE TENGA TODAS LAS RESPUESTAS A LAS PREGUNTAS.    


-->
  



<section class="destacados" id="contenido">

    <div class="title-destacados">
        <span class="neon">cloud</span>
       <img src="build/img/nube.webp" alt="logo nube" class="logo">
       <h2 class="destacados-subtitle">Lo más destacado</h2>

    </div>

    <hr class="line-divisor">

    <div class="containerg-destacados"> <!--ME SUPORTEA EL GRID QUE VA A TENER 6 PELICULAS DESTACADAS-->

        <div class="grid-destacados"> <!-- 6 COLUMNAS-->

        <?php
    while($peliculas = mysqli_fetch_assoc($resultadoPeliculas)){  
        include __DIR__ . '/card.php';?>

                   

    <?php } ?>
                

                 
        </div>

    </div>

</section>


<?php incluirTemplate('separador'); ?>
    


<section class="recientes" id="recientes"> <!--Peliculas que tienen fecha recientes de hace 2 meses-->

    <div class="container-recientes">
   
        <img src="build/img/new.webp" alt="logo nube" class="logo">
        <h2>Lo mas reciente</h2>
      
    </div>

   
    <hr class="line-divisor">

    <div class="recientes-grid">

        <div class="peliculas-recientes">
        <a href="pelicula.php" target="_blank">
            <picture>
                <source srcset="/build/img/SIMULADORES.webp" type="image/webp">
                <img loading ="lazy" src="/build/img/SIMULADORES.jpg" alt="Imagen LOS SIMULADORES">
            </picture>
            <h3 class="">Los Simuladores</h3>
            <hr class="hr_pelis">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate blanditiis iste sed quibusdam impedit magnam, veritatis, earum omnis perferendis nisi ipsa dolorem quas non fuga mollitia animi! Veritatis, modi tenetur.</p>
            </a>
        </div>

    </div>

 


</section>

<?php incluirTemplate('separador'); ?>

<section class="contenido" data-aos = "fade-down" id="contenido">

    <h2>¿Que deseas ver hoy?</h2>
    <div class="contenido-botones" >
        <?php 
        $sql = "SELECT * FROM generos";
        $resultado = mysqli_query($db,$sql);
        while($genero = mysqli_fetch_assoc($resultado)){
 
            if($genero['nombre_genero'] === 'Anime' || $genero['nombre_genero'] === 'Animacion'){?>
            <a href="/generos.php?resultado=<?php echo $genero['id']?>" class="btn-rojo">Ver <?php echo $genero['nombre_genero'];?></a>

           
        <?php }}?>
    </div>

</section>




<section class="contacto" id="contacto">
    <div class="container-contacto" data-aos="fade-up">
    <div class="contacto-titulo">
        <h2>¿Tenes algun problema?</h2>
        <h3>Contactanos!</h3>
    </div>
   
    <div class="container-form">
        <form action="submit" class="form" >
            <div class="container-nombre">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre" class="form-nombre">
            </div>
            <div class="container-apellido">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" placeholder="Apellido" class="form-apellido">
            </div>
            <div class="container-form-descripcion">
                <label for="textarea">Mensaje</label>
                <textarea name="textarea" id="form-descripcion" cols="30" rows="10" placeholder="Escriba su mensaje aqui"></textarea>
            </div>
            
            <div class="container-mail">
                <label for="mail">Mail</label>
                    <input type="email" name="email" id="email" placeholder="mail@mail.com" class="form-email">
            </div>
               
            
            <input type="submit" value="Enviar" class="btn-rojo" id="enviar-correo">
        </form>
    </div>
    </div>


</section>

    
<div class="volver-inicio">
    <picture>
       
        <source srcset="/build/img/flecha.webp" type="image/webp">
     
        <img class = "logo flecha" loading ="lazy" src="/build/img/flecha.png" alt="flecha volver |io">
   
    </picture>
    <p>Volver al inicio</p>
</div>



<?php

incluirTemplate('footer');
?>


