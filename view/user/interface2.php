<?php 
$boletos = $this->d["boletos"];
$pelicula = $this->d["pelicula"];
$funcion = $this->d["funcion"];
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
                    <pre style="color:darkblue"><?php echo $funcion->getFecha(); ?>
                    <?php echo hora($funcion->getMinutos_inicio()); ?>
                    </pre>
                </details>
            </div> 
            <div> 
                <details>
                    <summary> Email</summary>
                    <p style="padding-left: 20px;"><a href="" style="color:darkblue">cliente2@gmail.com</a></p>
                </details> 
            </div>
            <div> 
                <details>
                    <summary> Entradas</summary>
                    <p style="padding-left: 20px;padding-right: 40px;color:darkblue;display:inline;">Adulto</p> <p style="display:inline;color:darkblue;">x1</p>
                </details> 
            </div>
        </div>
        
        <form id="entradas">
            <div id="titleEntradas">
                <img id="imgentradas"src="images\chair.png" alt="tickts">
                <h2>ASIENTOS</h2>
            </div>
            <div>
                <div>
                    <h4 align="center">Puedes selecionar _ asientos</h4>
                </div>
                <div class="colores">
                    <div>
                        <img class="example"src="images\\verde.webp">
                        <p>Libre</p>
                    </div>
                    <div>
                        <img class="example"src="images\\naranja.jfif">
                        <p>Ocupado</p>
                    </div>
                    <div>
                        <img class="example"src="images\\red.png">
                        <p>Seleccionado</p>
                    </div>
                </div>
                <div align="center" id="seating" style="background-color:white; border: 3.2px solid #000;border-radius: 5%; ">
                    <table id="crear">
                        <?php for($i = 1; $i <= 20; $i++){ ?>
                            <tr>
                            <?php for($j = 1; $j <= 4; $j++){ ?>
                                <td>
                                <?php if(reservado($boletos,$j,$i)){ ?>
                                    <img src="<?php echo constant("URL"); ?>public/img/verde.webp" alt="">
                                <?php }else{?>
                                    <img src="<?php echo constant("URL"); ?>public/img/naranja.jfif" alt="">
                                <?php }?>
                                </td>
                            <?php } ?>
                            </tr>
                        <?php }?>
                    </table>
                    <div style="clear:both"></div><br />
                    <!--div id="theButtons">
                        <input type="button" value="Confirmar Asientos" id="confirmar" onclick="confirmarsitios()" />&nbsp;
                        <input type="reset" id="resetear" value="Reset" />
                    </div-->
                </div>
            </div>
            <div class="botones_int">
                <input type="text" readonly value="Cancelar" onclick="location.reload()"/>
                <input type="submit" readonly id="boton_continua" value="Continuar"/>
            </div> 
        </form>
    </div>

    <span id="volver"><p align="center"  style="margin-top:8px;">VOLVER</p></span>
    <span id="continuar"><p align="center" style="margin-top:8px;">CONTINUAR</p></span>    
</div>

    <!-- <script type="text/javascript">
        numeroasientosporfila = 20;
        nombresdelasfilas = ['A','B','C','D'];
        var statusPics = new Array();
        statusPics['libre'] = new Image();
        statusPics['seleccionado'] = new Image();
        statusPics['ocupado'] = new Image();
        statusPics['libre'].src = 'images\\verde.webp';
        statusPics['seleccionado'].src = 'images\\red.png';
        statusPics['ocupado'].src = 'images\\naranja.jfif';
        function crearasientos(asientos,asientosfila,nombrefilas){
            for(i=0; i < nombrefilas.length; i++){
                var filas = document.createElement('tr');
                var columnas = document.createElement('td');
                columnas.innerHTML = nombrefilas[i];
                filas.appendChild(columnas);
                for(j=0; j < asientosfila; j++){
                    columnas = document.createElement('td');
                    var imagenbutaca = document.createElement('img');
                    imagenbutaca.src = statusPics['libre'].src;
                    imagenbutaca.status = 'libre';
                    imagenbutaca.onclick=function(){
                        this.status = (this.status == 'libre')? 'seleccionado' : 'libre';
                        this.src = (this.status == 'libre')? statusPics['libre'].src : statusPics['seleccionado'].src;
                    }
                    columnas.appendChild(imagenbutaca);
                    filas.appendChild(columnas);
                }
                asientos.appendChild(filas);
            }
        }
        function confirmarsitios(){
            numeroasientosseleccionados = 0;
            for(i=0; i < butacas.length; i++){
                if(butacas[i].status == 'seleccionado'){
                    ++numeroasientosseleccionados;
                    butacas[i].src=statusPics['ocupado'].src
                }
            }
        }
        window.onload=function(){
            butacascrear = document.getElementById('crear');
            butacas = butacascrear.getElementsByTagName('img');
            crearasientos(butacascrear,numeroasientosporfila,nombresdelasfilas);
            document.getElementById('confirmar').onclick=confirmarsitios;
            document.getElementById('resetear').onclick=function(){
                for(i=0; i < butacas.length; i++){
                    butacas[i].src = statusPics['libre'].src;
                    butacas[i].status = 'libre';
                }
            }
        }
    </script> -->
