<?php 

 //CONTROLO SI EXISTE LA IMAGEN EN BUILD Y SI NO EXISTE QUE ME PONGA LA IMAGEN DE LA CARPETA IMAGENES

?>


        <div class="destacado""> <!--pelicula 1-->
                        <a href="/pelicula.php?resultado=<?php echo $peliculas['id'];?>" target="_blank">
                        
                        <picture>
                           
                            <?php 
                        $directorio = CARPETA_BUILD . $peliculas['imagen']; //CONTROLO SI EXISTE LA IMAGEN EN BUILD Y SI NO EXISTE QUE ME PONGA LA IMAGEN DE LA CARPETA IMAGENES
                        if(file_exists($directorio)){?>

                         <source srcset="/build/img/<?php echo $peliculas['imagen'];?>" type="image/webp">
                        <img src="/build/img/<?php echo $peliculas['imagen']; ?>" alt="">

                       <?php }?>   

                        <?php if(!file_exists($directorio)){?>
                            <source srcset="/imagenes/<?php echo $peliculas['imagen'];?>" type="image/webp">
                             <img src="/imagenes/<?php echo $peliculas['imagen']; ?>" alt="">

                        <?php }   ?>
                        
                        </picture>
                      

                        <div class="container-texto">
                             <h3 class=""><?php echo $peliculas['nombre'] ?></h3>
                                 <hr class="hr_pelis">
              
                   
                                <div class="container-descripcion">
                                    <p><?php echo $peliculas['descripcion'];?></p>
                            
                                 
                               </div>
                        </div>
                  

                        </a>
                        <button class="btn-mas">Ver mas</button>
        </div>