<?php 
    $productos = $this->d["productos"];/* 
    var_dump($productos) */
?>
<div class="contenedor_general_confiteria">
    <h1 class="titulo">COMPRA TUS BEBIDAS Y ALIMENTOS</h1>
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
                            <input type="number" class="cantidad_subtotal" data-id="<?php echo $producto->getId(); ?>"  data-nombre="<?php echo $producto->getNombre(); ?>">
                        </div>
                        <?php }else{ ?>
                        <div class="confiteria_precio">
                            <p>S/.</p><p class="precio_subtotal"><?php echo $producto->getPrecios()["unico"]; ?></p> 
                            <input type="number" class="cantidad_subtotal" data-id="<?php echo $producto->getId(); ?>"  data-nombre="<?php echo $producto->getNombre(); ?>">
                        </div>
                        <?php } ?>   
                    </div>
                    
                </div>
                
            </div>
        </div>

    <?php }
    ?>
        
    </section>

    <section class="contenedor_precio_confiteria">
        <form action="">
            <div class="contenedor_confiteria_detalle">
                <div class="contenedor_confiteria_elementos">
                    
                </div>
                <div>
                    <span>Total</span>
                    <span>S/. <span class="total_pagar_confiteria">0.00</span></span>
                </div>
            </div>
            <input class="boton_comprar_confiteria" type="text" value="comprar">
        </form>
    </section>
</div>

