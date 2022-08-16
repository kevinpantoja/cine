<?php 
$pelicula = $this->d["pelicula"];
$funcion = $this->d["funcion"];
function hora($numMin){
    $min = $numMin % 60;
    $hora = ($numMin - $min)/60;
    $cadena = $hora.":".$min; 
    return $cadena;
}
?>
<head>
    <link rel="stylesheet" href="<?php echo constant("URL")."view/user/interface1.css"?>">
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
        </div>
        <div id="entradas">
            <div id="titleEntradas">
                <img id="imgentradas"src="<?php echo constant("URL")."public/img/"?>cine.png" alt="tickts">
                <h2>ENTRADAS</h2>
            </div>
            <div id="precios">
                <div>
                    <p class="persona">Adulto</p>
                    <p>S/.17.00</p>
                    <input type="number" value="0">
                </div>
                <div>
                    <p class="persona">Niño</p>
                    <p>S/.10.00</p>
                    <input type="number" value="0">
                </div>
                <div>
                    <p class="persona">Adulto Mayor</p>
                    <p>S/.10.00</p>
                    <input type="number" value="0">
                </div>
                <div>
                    <p class="persona">Persona con decapacidad</p>
                    <p>S/.5.00</p>
                    <input type="number" value="0">
                </div>
            </div>

        </div>
    </div>    
</div>