<?php 
    $productos = $this->d["productos"];/* 
    var_dump($productos) */
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


<script>
    function calcularTotal(prod){
        let aux = 0;
        for(let i = 0; i < prod.length;i++){
            aux = aux + prod[i][1]*prod[i][2]
        }
        return aux;
    }
    function existeId(prod,id){
        for(let i = 0; i < prod.length;i++){
            if(prod[i][0] == id)
                return true
            else
                break;
        }
        return false;
    }
    function actualizarTabla(prod,id,prec_unit,cantidad,nombre){
        for(let i = 0; i < prod.length;i++){
            if(prod[i][0] == id){
                prod[i][1] = prec_unit;
                prod[i][2] = cantidad;
                prod[i][3] = nombre;
            }
            else
                break;
        }
    }
    function generarProforma(prod){
        $lista = document.querySelector(".contenedor_confiteria_elementos");
        $lista.innerText = "";
        for(let i = 0; i < prod.length;i++){
            let $nodo_nuevo = document.createElement("div");
            $nodo_nuevo.classList.add("contenedor_confiteria_elementos");
            $nodo_nuevo.innerHTML = `<span>${prod[i][3]}</span><b>x${prod[i][1]}</b><p>S/.${prod[i][2]}</p>`;
            $lista.appendChild($nodo_nuevo);
        }
    }

    window.addEventListener("load",(e)=>{
        productos = [];

        $opciones_precio = document.querySelectorAll(".tamano_seleccionar");
        $cantidad_subtotal = document.querySelectorAll(".cantidad_subtotal");
        for(let i = 0; i < $opciones_precio.length; i++){
            $opciones_precio[i].addEventListener("change",(m)=>{
                $opcion = $opciones_precio[i];
                $precio_subtotal = $opcion.parentNode.parentNode.querySelector(".precio_subtotal");
                $precio_cantidad = $opcion.parentNode.parentNode.querySelector(".cantidad_subtotal");
                $precio = $opcion.value.split("-")[0];
                if(!existeId(productos,$precio_cantidad.dataset.id)){
                    productos.push([$precio_cantidad.dataset.id,$precio.value,$precio_cantidad.innerText,$precio_cantidad.dataset.nombre]);
                }else{
                    actualizarTabla(productos,$precio_cantidad.dataset.id,$precio.value,$precio_cantidad.value,$precio_cantidad.dataset.nombre);
                }
                generarProforma(productos);
            })
        }

        for(let i = 0; i < $cantidad_subtotal.length; i++){
            $cantidad_subtotal[i].addEventListener("change",(m)=>{
                $opcion = $opciones_precio[i];
                $precio = $cantidad_subtotal[i].parentNode.querySelector(".precio_subtotal");
                $precio_cantidad = $cantidad_subtotal[i];
                $precio.innerText = $opcion.value.split("-")[0];
                if(!existeId(productos,$precio_cantidad.dataset.id)){
                    productos.push([$precio_cantidad.dataset.id,$precio.value,$precio_cantidad.value,$precio_cantidad.dataset.nombre]);
                }else{
                    actualizarTabla(productos,$precio_cantidad.dataset.id,$precio.value,$precio_cantidad.value,$precio_cantidad.dataset.nombre);
                }
                generarProforma(productos);
            })
        }
        
    });

    window.addEventListener("scroll",function(){
        var header = document.querySelector(".cabecera");
        header.classList.toggle("fixed",window.scrollY);
    });
</script>
