<?php 
    $peliculas = $this->d["peliculas"];
    $productos = $this->d["productos"];
?>

<div class="body">
    <div class="banner_principal">
        <img src="public/img/banner_principal.jpeg" alt="">
    </div>
    <section class="contenedor_cartelera">
        <div class="titulo">Cartelera General</div>
        <div class="contenedor_elementos">
            <i class="fa-solid fa-circle-chevron-left flecha_izquierda_pelicula"></i>
            <i class="fa-solid fa-circle-chevron-right flecha_derecha_pelicula"></i>
        <?php 
        foreach($peliculas as $pelicula){?>
            <div class="pelicula_principal_individual">
                <div class="contenedor_imagen">
                    <?php if($pelicula->getModo()=="estreno"){?>
                    <img class="pelicula_imagen_estreno" src="public/img/photos/<?php echo $pelicula->getFoto(); ?>">
                    <span class="cinta_estreno">Estreno</span>
                    <?php }else{?>
                    <img class="pelicula_imagen" src="public/img/photos/<?php echo $pelicula->getFoto(); ?>">
                    <?php }?>
                    <a href="invitado/barraRedirect/pelicula_detalle/<?php echo $pelicula->getId(); ?>"><i class="fa-solid fa-circle-plus circulo_mas"></i></a>
                </div>
            </div>
        <?php }
        ?>
        </div>
    </section>
    <section class="contenedor_alimentos">
        <div class="titulo">Alimentos y Bebidas</div>
        <div class="contenedor_elementos">
            <i class="fa-solid fa-circle-chevron-left flecha_izquierda_producto"></i>
            <i class="fa-solid fa-circle-chevron-right flecha_derecha_producto"></i>
        <?php 
        foreach($productos as $producto){?>
            <div class="producto_principal_individual">
                <div class="contenedor_imagen">
                    <img class="pelicula_imagen_estreno" src="public/img/photos/<?php echo $producto->getRutaImagen(); ?>">
                    <span class="cinta_estreno"><?php echo $producto->getNombre(); ?></span>
                    <!-- <a href="invitado/barraRedirect/pelicula_detalle/<?php echo $pelicula->getId(); ?>"><i class="fa-solid fa-circle-plus circulo_mas"></i></a> -->
                </div>
            </div>
        <?php }
        ?>
        </div>
        <div></div>
    </section>
</div>


<script>
    window.addEventListener("load",e=>{
        $peliculas = document.querySelectorAll(".pelicula_principal_individual");
        $productos = document.querySelectorAll(".producto_principal_individual");
        i_pelicula = 3;
        i_producto = 3;
        i_pelicula_tope = $peliculas.length-1;
        i_producto_tope = $productos.length-1;
        cambiar_pelicula(0,1,2,3);
        cambiar_producto(0,1,2,3);
        $pelicula_izquierda = document.querySelector(".flecha_izquierda_pelicula");
        $producto_izquierda = document.querySelector(".flecha_izquierda_producto");
        $pelicula_derecha = document.querySelector(".flecha_derecha_pelicula");
        $producto_derecha = document.querySelector(".flecha_derecha_producto");
        $pelicula_derecha.addEventListener("click",e=>{
            cambiar_pelicula(i_pelicula-3,i_pelicula-2,i_pelicula-1,i_pelicula);
            if(i_pelicula != i_pelicula_tope){
                cambiar_pelicula(i_pelicula-2,i_pelicula-1,i_pelicula,i_pelicula+1);
                i_pelicula = i_pelicula + 1;
            }else{
                cambiar_pelicula(0,1,2,3);
                i_pelicula = 3;
            }
        });
        $producto_derecha.addEventListener("click",e=>{
            cambiar_producto(i_producto-3,i_producto-2,i_producto-1,i_producto);
            if(i_producto != i_producto_tope){
                cambiar_producto(i_producto-2,i_producto-1,i_producto,i_producto+1);
                i_producto = i_producto + 1;
            }else{
                cambiar_producto(0,1,2,3);
                i_producto = 3;
            }
        });
        $pelicula_izquierda.addEventListener("click",e=>{
            cambiar_pelicula(i_pelicula-3,i_pelicula-2,i_pelicula-1,i_pelicula);
            if(i_pelicula-3 != 0){
                cambiar_pelicula(i_pelicula-4,i_pelicula-3,i_pelicula-2,i_pelicula-1);
                i_pelicula = i_pelicula - 1;
            }else{
                cambiar_pelicula(i_pelicula_tope-3,i_pelicula_tope-2,i_pelicula_tope-1,i_pelicula_tope);
                i_pelicula = i_pelicula_tope;
            }
        });
        $producto_izquierda.addEventListener("click",e=>{
            cambiar_producto(i_producto-3,i_producto-2,i_producto-1,i_producto);
            if(i_producto-3 != 0){
                cambiar_producto(i_producto-4,i_producto-3,i_producto-2,i_producto-1);
                i_producto = i_producto - 1;
            }else{
                cambiar_producto(i_producto_tope-3,i_producto_tope-2,i_producto_tope-1,i_producto_tope);
                i_producto = i_producto_tope;
            }
        });
    });
    /* window.addEventListener("scroll",function(){
        var header = document.querySelector(".cabecera");
        header.classList.toggle("fixed",window.scrollY);
    }); */
    function cambiar_pelicula(i1,i2,i3,i4){
        $peliculas[i1].classList.toggle("pelicula_individual_mediano");
        $peliculas[i2].classList.toggle("pelicula_individual_grande");
        $peliculas[i3].classList.toggle("pelicula_individual_grande");
        $peliculas[i4].classList.toggle("pelicula_individual_mediano");
    }
    function cambiar_producto(i1,i2,i3,i4){
        $productos[i1].classList.toggle("pelicula_individual_mediano");
        $productos[i2].classList.toggle("pelicula_individual_grande");
        $productos[i3].classList.toggle("pelicula_individual_grande");
        $productos[i4].classList.toggle("pelicula_individual_mediano");
    }

</script>