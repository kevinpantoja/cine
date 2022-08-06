<?php 
    $peliculas = $this->d["peliculas"];
?>
<nav class="cabecera_pelicula">
    <div class="pelicula_fondo"> <span>PELÍCULAS</span> </div>
    <div class="pelicula_link_activo link_primero"><a href=""><span>En cartelera</span></a></div>
    <div class="pelicula_link"><a href=""><span>Próximamente</span></a></div>
</nav>

<section class="contenedor_peliculas">
<?php foreach($peliculas as $pelicula){
?>
    <div class="pelicula_individual">
        <div class="contenedor_imagen">
            <?php if($pelicula->getModo()=="estreno"){?>
            <img class="pelicula_imagen_estreno" src="public/img/photos/<?php echo $pelicula->getFoto(); ?>">
            <span class="cinta_estreno">Estreno</span>
            <?php }else{?>
            <img class="pelicula_imagen" src="public/img/photos/<?php echo $pelicula->getFoto(); ?>">
            <?php }?>
            <i class="fa-solid fa-circle-plus circulo_mas"></i>
        </div>
        
        <h2 class="pelicula_titulo"><?php echo $pelicula->getNombre() ?></h2>
        <!-- <br>
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
        <br><br><br> -->
    </div>
<?php
} ?>    
</section>


<script>
    window.addEventListener("scroll",function(){
        var header = document.querySelector(".cabecera");
        header.classList.toggle("fixed",window.scrollY);
    });
</script>
