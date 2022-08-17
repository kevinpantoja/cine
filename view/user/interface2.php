<?php 
$boletos = $this->d["boletos"];
$pelicula = $this->d["pelicula"];
$funcion = $this->d["funcion"];
$tickets = $this->d["tickets"];
$cliente = $this->d["cliente"];
$numTickets = 0;
function hora($numMin){
    $min = $numMin % 60;
    $hora = ($numMin - $min)/60;
    $cadena = $hora.":".$min; 
    return $cadena;
}
function reservado($boletos,$fila,$columna){
    foreach($boletos as $boleto){
        if($boleto->Fila == $fila && $boleto->getColumna == $columna)
            return true;
    }
    return false;
}
foreach($tickets as $tipo=>$cantidad){
    $numTickets = $numTickets + $cantidad;
}
?>
<head>
    <link rel="stylesheet" href="<?php echo constant("URL")."view/user/interface2.css"?>">
    <title>Cine - Butacas</title>
</head>
<div class="body_compra">
    <header>
        <div align="center" >
        <img  src="<?php echo constant("URL")."public/img/"?>lentes.jfif" alt="lentes">
            <h1 >BOLETERIA</h1>
            <img src="<?php echo constant("URL")."public/img/"?>proyector.png" alt="proyector">      
        </div>
    </header>
    <div>
        <div id="pelicula">
            <h3 align="center"><?php echo $pelicula->getNombre(); ?></h3>
            <img id="BatImg" src="public/img/photos/<?php echo $pelicula->getFoto(); ?>" alt="<?php echo $pelicula->getNombre(); ?>">
            <div> 
                <details>
                    <summary> Fecha y Hora</summary>
                    <p style="color:darkblue"><?php echo $funcion->getFecha(); ?>
                    <?php echo hora($funcion->getMinutos_inicio()); ?>
                    </p>
                </details>
            </div> 
            <div> 
                <details>
                    <summary> Email</summary>
                    <p style="padding-left: 20px;"><a href="" style="color:darkblue"><?php echo $cliente->getCorreo();?></a></p>
                </details> 
            </div>
            <div> 
                <details>
                    <summary> Entradas</summary>
                    <?php foreach($tickets as $tipo=>$cantidad){?>
                    <p style="padding-left: 20px;padding-right: 40px;color:darkblue;display:inline;"><?php echo $tipo; ?></p> <p style="display:inline;color:darkblue;">x<?php echo $cantidad; ?></p><br>
                    <?php } ?>
                </details> 
            </div>
        </div>
        
        <form id="entradas" method="POST" action="<?php echo constant("URL"); ?>user/completarBoletos">
            <div id="titleEntradas">
                <img id="imgentradas"src="<?php echo constant("URL")."public/img/"?>chair.png" alt="tickts">
                <h2>ASIENTOS</h2>
            </div>
            <div>
                <div>
                    <h4 align="center">Puedes selecionar <?php echo $numTickets; ?> asientos</h4>
                </div>
                <div class="colores">
                    <div>
                        <img class="example"src="<?php echo constant("URL")."public/img/"?>verde.webp">
                        <p>Libre</p>
                    </div>
                    <div>
                        <img class="example"src="<?php echo constant("URL")."public/img/"?>naranja.jfif">
                        <p>Ocupado</p>
                    </div>
                    <div>
                        <img class="example"src="<?php echo constant("URL")."public/img/"?>red.png">
                        <p>Seleccionado</p>
                    </div>
                </div>
                <div align="center" id="seating" style="display: flex; justify-content: center; padding: 1.5rem 0; background-color:white; border: 3.2px solid #000;border-radius: 5%; ">
                    <table id="crear">
                        <?php for($i = 1; $i <= 4; $i++){ ?>
                            <tr>
                            <?php for($j = 1; $j <= 20; $j++){ ?>
                                <td>
                                <?php if(!reservado($boletos,$i,$j)){ ?>
                                    <img class="asiento_unitario" data-fil="<?php echo $i;?>"data-col="<?php echo $j;?>" src="<?php echo constant("URL"); ?>public/img/verde.webp" alt="">
                                <?php }else{?>
                                    <img class="asiento_unitario" data-fil="<?php echo $i;?>"data-col="<?php echo $j;?>" src="<?php echo constant("URL"); ?>public/img/naranja.jfif" alt="">
                                <?php }?>
                                </td>
                            <?php } ?>
                            </tr>
                        <?php }?>
                    </table>
                    <!-- <div style="clear:both"></div><br /> -->
                    <!--div id="theButtons">
                        <input type="button" value="Confirmar Asientos" id="confirmar" onclick="confirmarsitios()" />&nbsp;
                        <input type="reset" id="resetear" value="Reset" />
                    </div-->
                </div>
            </div>
            <div class="botones_int">
                <input type="text" readonly value="Cancelar" onclick="location.reload()"/>
                <input type="submit" readonly id="boton_continua" value="Continuar" disabled/>
            </div> 
            <div class="asientos_generados">
                
            </div>
        </form>
    </div>
</div>

    <script type="text/javascript">
        let $botonContinua = document.querySelector("#boton_continua");
        const asientoVerde = "<?php echo constant("URL")."public/img/verde.webp";?>",
        asientoRojo = "<?php echo constant("URL")."public/img/red.png";?>",
        asientoNaranja = "<?php echo constant("URL")."public/img/naranja.jfif";?>"
        let contador = 0;
        const numTickets = <?php echo $numTickets; ?>

        $asientos = document.querySelectorAll(".asiento_unitario");
        for(let i = 0; i < $asientos.length; i++){
            $asientos[i].addEventListener("click",(e)=>{
                console.log(e.target)
                if(e.target.src == asientoVerde){
                    e.target.src = asientoRojo;
                    contador++;
                    if(contador == numTickets){
                        $botonContinua.disabled = false;
                    }else{
                        $botonContinua.disabled = true;
                    }
                }else{
                    if(e.target.src == asientoRojo){
                        e.target.src = asientoVerde;
                        contador--;
                        if(contador == numTickets){
                            $botonContinua.disabled = false;
                        }else{
                            $botonContinua.disabled = true;
                        }
                    }
                }
            });
        }

        function getAsientosSelecionados(){
            let asientos = [];
            for(let i = 0; i < $asientos.length; i++){
                if($asientos[i].src == asientoRojo){
                    asientos.push([$asientos[i].dataset.fil,$asientos[i].dataset.col]);
                }
            }
            return asientos;
        }

        $botonContinua.addEventListener("click",(e)=>{
            e.preventDefault();
            const asientos = getAsientosSelecionados();
            $form = document.querySelector("#entradas");
            $asientos = document.querySelector(".asientos_generados");
            for(let m = 0; m < asientos.length;m++){
                let $aux = document.createElement("input");
                $aux.type = "text";
                $aux.value = asientos[m][0]+"-"+asientos[m][1]
                $aux.name="asientos[]"
                $asientos.appendChild($aux);
            }
        });
    </script>
