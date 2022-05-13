<?php 
    $peliculas = $this->d["peliculas"];
?>
<h1>Lista de Peliculas</h1>

<?php foreach($peliculas as $pelicula){
?>
    <h2><?php echo $pelicula->getNombre() ?></h2>
    <img src="public/img/photos/<?php echo $pelicula->getFoto(); ?>" width="400" height="300"><br>
    <b>Duracion: </b><span><?php echo $pelicula->getDuracion(); ?> minutos</span>
    <b>| Clasificación: </b><span><?php echo $pelicula->getClasificacion(); ?></span>
    <?php if($pelicula->getModo() == "estreno"){?>
    <span>| <?php echo $pelicula->getModo(); ?></span>
    <?php } ?>
    <br>
    <b>Director: </b><span><?php echo $pelicula->getDirector(); ?></span><br>
    <b>Descripcion</b><p><?php echo $pelicula->getDescripcion(); ?></p>
    <b>Trailer</b><br>
    <iframe width="560" height="315" src="<?php echo $pelicula->getLink_trailer(); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <br><br><br>

<?php
} ?>
