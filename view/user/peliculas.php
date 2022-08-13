<?php 
    $peliculas = $this->d["peliculas"];
?>
<nav class="cabecera_pelicula">
    <div class="pelicula_fondo"> <span>PELÍCULAS</span> </div>
    <div class="pelicula_link_activo link_primero"><a href="user/barraRedirect/peliculas"><span>En cartelera</span></a></div>
    <div class="pelicula_link"><a href="user/barraRedirect/proximamente"><span>Próximamente</span></a></div>
</nav>

<section class="contenedor_peliculas">
<?php foreach($peliculas as $pelicula){
    if($pelicula->getModo() == "normal" || $pelicula->getModo() == "estreno"){
?>
    <div class="pelicula_individual">
        <div class="contenedor_imagen">
            <?php if($pelicula->getModo()=="estreno"){?>
            <img class="pelicula_imagen_estreno" src="public/img/photos/<?php echo $pelicula->getFoto(); ?>">
            <span class="cinta_estreno">Estreno</span>
            <?php }else{?>
            <img class="pelicula_imagen" src="public/img/photos/<?php echo $pelicula->getFoto(); ?>">
            <?php }?>
            <a href="user/barraRedirect/pelicula_detalle/<?php echo $pelicula->getId(); ?>"><i class="fa-solid fa-circle-plus circulo_mas"></i></a>
        </div>    
        
        
        <h2 class="pelicula_titulo"><?php echo $pelicula->getNombre() ?></h2>
    </div>
<?php
    }
} ?>    
</section>


<script>
    window.addEventListener("scroll",function(){
        var header = document.querySelector(".cabecera");
        header.classList.toggle("fixed",window.scrollY);
    });
</script>
