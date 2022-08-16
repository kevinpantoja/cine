<h1>Agregar Nueva Pelicula</h1>
<form action="<?php echo constant("URL"); ?>admin/newMovie" method="POST" enctype="multipart/form-data">
    <p>
        <label for="id">Id</label>
        <input type="text" name="id" autocomplete="off" id="id">
    </p>
    <p>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" autocomplete="off" id="nombre">
    </p>
    <p>
        <span>Clasificación</span>
        <label for="clasificacion1">A</label>
        <input type="radio" name="clasificacion" autocomplete="off" checked id="clasificacion1" value="a">
        <label for="clasificacion2">B</label>
        <input type="radio" name="clasificacion" autocomplete="off" id="clasificacion2" value="b">
        <label for="clasificacion3">B14</label>
        <input type="radio" name="clasificacion" autocomplete="off" id="clasificacion3" value="b14">
        <label for="clasificacion4">C</label>
        <input type="radio" name="clasificacion" autocomplete="off" id="clasificacion4" value="c">
    </p>
    <p>
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" autocomplete="off" id="descripcion" placeholder="parrafo breve"></textarea>
    </p>
    <p>
        <label for="director">Director</label>
        <input type="text" name="director" autocomplete="off" id="director">
    </p>    
    <p>
        <label for="duracion">Duración (en minutos) </label>
        <input type="number" name="duracion" autocomplete="off" id="duracion">
    </p>
    <p>
        <label for="modo1">estreno</label>
        <input type="radio" name="modo" autocomplete="off" value="estreno" checked>
        <label for="modo2">normal</label>
        <input type="radio" name="modo" autocomplete="off" value="normal">
        <label for="modo2">proximamente</label>
        <input type="radio" name="modo" autocomplete="off" value="proximamente">
    </p>
    <p>
        <label for="foto">Imagen</label>
        <input type="file" name="foto" autocomplete="off" id="foto">
    </p>   
    <p>
        <label for="link_trailer">Link de trailer</label>
        <input type="url" name="link_trailer" autocomplete="off" id="link_trailer">
    </p>         
    <p>
        <input type="submit" value="Registrar Pelicula"/>
    </p>
</form>