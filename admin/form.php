


<div class="container-errores">
    <?php if (!empty($errores)) {
        foreach ($errores as $error) { ?>
            <p><?php echo $error ?></p>
    <?php }
    }
    ?>

</div>

<fieldset>
    <legend>Añadir Pelicula</legend>

    <div class="form-titulo">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" placeholder="Gato con botas" value="<?php echo !isset($titulo) ? '' : $titulo; ?>">
    </div>

    <div class="form-descripcion">
        <label for="descripcion">Descripcion</label>
        <textarea type="text" name="descripcion" id="descripcion" placeholder="" value=""><?php echo !isset($descripcion)  ? '' : $descripcion; ?></textarea>
    </div>
    <div class="form-lanzamiento">
        <label for="lanzamiento">Lanzamiento</label>
        <input type="text" name="lanzamiento" id="lanzamiento" placeholder="dd DE mm DE YYYY" value="<?php echo !isset($lanzamiento)  ? '' : $lanzamiento; ?>">
    </div>

    <div class="form-imagen">
        <label for="imagen">Seleccionar imagen</label>
        <input type="file" name="imagen" id="imagen">

        <?php if (isset($imagen)) { ?>
            <?php if ($directorio = file_exists(CARPETA_IMAGENES . $imagen)) { ?>

                <img src="/imagenes/<?php echo $imagen ?>" alt="Imagen pelicula" class="imagen-small">

            <?php } ?>

            <img src="/build/img/<?php echo $imagen ?>" alt="Imagen pelicula" class="imagen-small">


        <?php } ?>

    </div>


    <div class="form-duracion">
        <label for="duracion">Duracion</label>
        <input type="text" name="duracion" id="duracion" placeholder="2h 20m" value="<?php echo !isset($duracion) ? '' : $duracion; ?>">
    </div>

</fieldset>

<fieldset>
    <legend>Director</legend>
    <div class="form-director">
        <select name="director" id="director" class="director">
            <option value="">--- Seleccione ----</option>
            <?php $sql = "SELECT * FROM directores";
            $resultado = mysqli_query($db, $sql);
            while ($directores = mysqli_fetch_assoc($resultado)) {   ?>
                <option value="<?php echo isset($directores['id']); ?>" <?php echo isset($director) === $directores['id'] ? 'selected' : ''; ?>>
                    <?php echo isset($directores['nombre_director']) . ' ' . isset($directores['apellido_director']); ?>

                </option>
            <?php } ?>

        </select>

    </div>

</fieldset>

<fieldset>
    <legend>Genero</legend>
    <div class="form-genero">
        <?php $i = 0;
        $sql = "SELECT * FROM generos";
        $resultado = mysqli_query($db, $sql);
        while ($genero = mysqli_fetch_assoc($resultado)) { ?>

            <label for="genero">
                <input class="input_genero" type="checkbox" name="generos[]" id="genero" value="<?php echo $genero['id']; ?>">
                <?php echo $genero['nombre_genero']; //MAL 
                ?>




            </label>
        <?php } ?>
    </div>

</fieldset>

<fieldset>

    <legend>Url trailer</legend>
    <div class="form-trailer">

        <label for="trailer">Añadir trailer URL</label>
        <input type="url" name="trailer" id="trailer" placeholder="https://www.youtube.com/watch?v=t433PEQGErc" required value="<?php echo !isset($urlTrailer) ? '' : $urlTrailer?>">

    </div>



</fieldset>


<?php 






?>