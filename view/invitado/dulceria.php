<?php 
    $productos = $this->d["productos"];
?>
<div class="contenedor_general_confiteria">
    <h1 class="titulo_1">COMPRA TUS BEBIDAS Y ALIMENTOS</h1>
    <section class="contenedor_confiteria">

    <?php 
    foreach($productos as $id=>$producto){?>
        <div class="marco">
            
            <div class="confiteria_individual">
                <div class="contenedor_imagen">
                    <img class="confiteria_imagen" src="public/img/photos/<?php echo $producto->getRutaImagen(); ?>">
                </div>
                
                <div class="marco_nombre_producto">
                    <div class="marco_titulo_producto">
                        <h2 class="confiteria_titulo"><?php echo $producto->getNombre(); ?></h2>
                    </div>
                    <div class="confiteria_detalles">
                        <p class="confiteria_info"><?php echo $producto->getDescripcion(); ?></p>
                        <?php if(sizeof($producto->getPrecios())>1){?>
                        <div class="confiteria_tamano">
                            <p>tamaño</p>
                            <select class="tamano_seleccionar" class="tamano">
                            <?php  foreach($producto->getPrecios() as $tipo=>$precio){?>
                                <option value="<?php echo $precio; ?>-<?php echo $tipo; ?>"><?php echo $tipo; ?></option>
                            <?php } ?>
                            </select> 
                        </div>
                        <div class="confiteria_precio <?php echo $producto->getId(); ?>">
                            <p>S/.</p><p class="precio_subtotal"><?php echo array_values($producto->getPrecios())[0]; ?></p> 
                        </div>
                        <?php }else{ ?>
                        <div class="confiteria_precio">
                            <p>S/.</p><p class="precio_subtotal"><?php echo $producto->getPrecios()["unico"]; ?></p>
                        </div>
                        <?php } ?>   
                    </div>
                    
                </div>
                
            </div>
        </div>

    <?php }
    ?>
        
    </section>

</div>

<script>

    window.addEventListener("load",(e)=>{
        productos = [];

        $opciones_precio = document.querySelectorAll(".tamano_seleccionar");
        for(let i = 0; i < $opciones_precio.length; i++){
            $opciones_precio[i].addEventListener("change",(m)=>{
                $opcion = $opciones_precio[i];
                $precio = $opcion.parentNode.parentNode.querySelector(".precio_subtotal");
                $precio_cantidad = $opcion.parentNode.parentNode.querySelector(".cantidad_subtotal");
                $precio.innerText = $opcion.value.split("-")[0];
            })
        }
        
    });

    window.addEventListener("scroll",function(){
        var header = document.querySelector(".cabecera");
        header.classList.toggle("fixed",window.scrollY);
    });
</script>


