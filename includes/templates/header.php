<?php
global $_SESSION; //DECLARO LA $_SESSION COMO GLOBAL

$auth = controlarUsuario();


$db = conectarDB();
$sql = "SELECT * FROM generos";
$resultado = mysqli_query($db,$sql);


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    <title>CloudMovie</title>
</head>
<body>

<?php incluirTemplate('loader')?>



<header class="header" id="header">
  
    <div class="boton-menu">
        <img loading = "lazy" src="/build/img/bars.png" alt="logo barras">
    </div>

    <div class="container-nav">
        <nav class="navegation">

            <a href="/">Inicio</a>
        
                <ul class="ul-peliculas"> 
                    <li class="">Peliculas <span class="arrow"></span> </li>  
                    <div class="contenedor-peliculas">
                        <?php while($genero = mysqli_fetch_assoc($resultado)) { ?>
                            <a href="/generos.php?resultado=<?php echo $genero['id'];?>"> <li><?php echo filter_var($genero['nombre_genero'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);?></li></a>
                        <?php }?>
                    </div>

                    </ul>
           
            <a href="/buscar_pelicula.php">Buscar Pelicula</a>
        

                    <h1 class="title inherit">CLOUD
            <div class="logo logo_pag">
          
                <picture>

                  
                    <source srcset="/build/img/LOGO.webp" type="image/webp">
                    <img src="/build/img/LOGO.png" alt="logo">
                </picture>
            </div>
            MOVIE</h1>

   
           <?php if(!$auth){ ?> 
            <a href="/login.php">Iniciar Sesion</a> 
            <?php }?> 

            <?php if($auth){ ?> <a href="../../cerrar-sesion.php">Cerrar Sesion</a> 
                <?php }?>
                <a href="/admin/index.php">Administrador de peliculas</a>
          

        </nav>
    </div>

    <?php if($inicio == true){?>
    <section class="menu">

            <div class="slider" data-aos="fade-right">
                    <?php $sql = "SELECT id,imagen_grande from peliculas WHERE vistas >=500 LIMIT 6";
                    $resultado = mysqli_query($db,$sql);

                    while($image = mysqli_fetch_assoc($resultado)){  ?>
                     
                      <picture>
                     
                        <source srcset="/build/img/<?php echo $image['imagen_grande'];?>"type="image/webp">
                        <a href="/pelicula.php?resultado=<?php echo $image['id'];?>">
                        <img src="/build/img/<?php echo $image['imagen_grande'];?>" alt="imagen grande ">
                        </a>
                      </picture>
                 
                    <?php }?>
                            
                    
                   
        

        </div>
    
    </section>
    </header> <!--CIERRO EL HEADER PARA QUE NO ME OCUPE TODA LA PAGINA, NO LO CIERRO EN EL TEMPLATE YA QUE NO ME SIRVE PARA TODAS LAS PAGINAS-->

<?php }?>

