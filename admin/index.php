<?php
include __DIR__ . '/../includes/funciones.php';
include __DIR__ . '/../includes/config/database.php';
incluirTemplate('header');
$db = conectarDB();


$auth = controlarUsuario();


if(!$auth){
    echo "<script>window.location.href='/login.php'</script>";
}




// $sql = "SELECT p.id,p.nombre, d.nombre_director, d.apellido_director, g.nombre_genero, p.duracion, p.descripcion, p.imagen, p.vistas, p.likes, p.lanzamiento FROM peliculas as p, directores as d, generos as g, generos_peliculas as gp WHERE p.idDirector = d.id AND gp.idPelicula = p.id AND gp.idGenero = g.id GROUP BY p.nombre";

$sql = "SELECT p.id,p.nombre, d.nombre_director, d.apellido_director, p.duracion, p.descripcion, p.imagen, p.vistas, p.likes, p.lanzamiento FROM peliculas as p, directores as d WHERE p.idDirector = d.id ";
$resultado = mysqli_query($db,$sql);


//SEGUIR INTERVENTION IMAGE PARA SUBIR IMAGENES || MEJORAR

//BUSCAR LA FORMA DE QUE SE MUESTREN TODOS LOS GENEROS SIN REPETIR PELICULA

//INSERTAR GENEROS


//SUBIR PAGINA A HOST DE PRUEBA

if($_POST!=[]){ //CONTROLO QUE SE HAYA DADO LA INDICACION DE ELIMINAR UNA PELICULA

$id = filter_var($_POST['pelicula'],FILTER_VALIDATE_INT);
if($id || $id != ''){
    $sql = "DELETE FROM peliculas where id=$id";
    $resultado2 = mysqli_query($db,$sql);
 
}}

?>


<section class="administracion-peliculas">
    <h2>Administrador de peliculas</h2>
   
    <div class="containerg-adminpeli">

        <div class="contenedor container-adminpeli">

                <div class="grid-encabezado">
                <p>Nombre de la pelicula</p>
                <p>Director</p>
                <p>Genero</p>
                <p>Duracion</p>
                <p>Descripcion</p>
                <p>Imagen</p>
                <p>Likes</p>
                <p>Vistas</p>
                <p>Lanzamiento</p>
                <p>Acciones</p>
                </div>
                <?php while($pelicula = mysqli_fetch_assoc($resultado)){?>
                <div class="grid-adminpeli">
                        <p><?php echo sanitizar($pelicula['nombre'] === '' ? '' : $pelicula['nombre']);?></p>
                        <p><?php echo sanitizar ($pelicula['nombre_director'] . $pelicula['apellido_director'] === '' ? '' : $pelicula['nombre_director'] . $pelicula['apellido_director']);?></p>
                        <p><?php echo sanitizar (isset($pelicula['nombre_genero']) ? $pelicula['nombre_genero']: '' );?></p>
                        <p><?php echo sanitizar ($pelicula['duracion'] === '' ? '' : $pelicula['duracion']);?></p>
                        <p class="p_descripcion-scroll"><?php echo($pelicula['descripcion'] === '' ? '' : $pelicula['descripcion']);?></p>


                        <!--PONER IMAGEN DEPENDIENDO DE SU RUTA-->
                        <?php 
                        $directorio = __DIR__ .'/../build/img/' . $pelicula['imagen']; //CONTROLO SI EXISTE LA IMAGEN EN BUILD Y SI NO EXISTE QUE ME PONGA LA IMAGEN DE LA CARPETA IMAGENES
                        if(file_exists($directorio)){?>
                            <p class="admin_imgpeli"><img src="/build/img/<?php echo $pelicula['imagen']; ?>" alt=""></p>
                       <?php }?>   
                        <?php if(!file_exists($directorio)){?>

                            <p class="admin_imgpeli"> <img src="/imagenes/<?php echo $pelicula['imagen']; ?>" alt=""></p>

                        <?php }   ?>
                     
                        
                    
                        
                        <p><?php echo sanitizar($pelicula['likes'] === '' ? '' : $pelicula['likes']);?></p>
                        <p><?php echo sanitizar($pelicula['vistas'] === '' ? '' : $pelicula['vistas']);?></p>
                        <p><?php echo sanitizar($pelicula['lanzamiento'] === '' ? '' : $pelicula['lanzamiento']);?></p>
                        
                        <div class="container-buttons">
                            <a class="btn-actualizar" href="/admin/peliculas/actualizar.php?pelicula=<?php echo $pelicula['id'];?>">Actualizar</a>
                            <form action="#" method="POST">
                                <input class="btn-borrar" type="submit" value="Eliminar">
                                <input type="hidden" name="pelicula" value="<?php echo sanitizar($pelicula['id']);?>">
                            </form>
                        </div>
                </div>
                <hr>
                <?php }?>

        
        </div>
        <a class="btn-crearprop" href="/admin/peliculas/crear.php">Añadir nueva pelicula</a>
    </div>


</section>
</header>

<?php incluirTemplate('footer');?>