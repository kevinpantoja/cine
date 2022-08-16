<?php 
    $pelicula = $this->d["pelicula"];
    $funciones = $this->d["funciones"];
    $fechas = $this->d["fechas"];
    function hora($numMin){
        $min = $numMin % 60;
        $hora = ($numMin - $min)/60;
        $cadena = $hora.":".$min; 
        return $cadena;
    }
?>
<section class="banner_detalle">
    <iframe class="banner_video" width="100%" height="600px" src="<?php echo $pelicula->getLink_trailer(); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <article class="banner_ListaDetalle">
        <h1><b><?php echo $pelicula->getNombre(); ?></b></h1>
        <?php 
            $minutos = $pelicula->getDuracion() % 60;
            $horas = ($pelicula->getDuracion()-$minutos)/60;
            $duracion = "";
            if($horas != 0){
                $duracion = $horas."h ".$minutos."m";        
            }else{
                $duracion = $minutos."m";
            }
        ?>
        <div>
            <span><b>Duración</b></span>
            <span><?php echo $duracion; ?></span>
        </div>
        <div>
            <span><b>Clasificación</b></span>
            <span><?php echo $pelicula->getClasificacion(); ?></span>
        </div>
        <div>
            <span><b>Director</b></span>
            <span><?php echo $pelicula->getDirector(); ?></span>
        </div>
        <div>
            <span><b>Descripcion</b></span>
            <span><?php echo $pelicula->getDescripcion(); ?></span>
        </div>
    </article>
</section>

<div class="contenedor_horarios">
    <?php foreach($fechas as $fecha){ ?>
    <div class="contenedor_horario">
        <h1><?php echo $fecha; ?></h1>
        <?php foreach($funciones as $funcion){ 
            if($funcion->getFecha() == $fecha){?>
            <div>
                <input style="display:none" type="text" name="id_funcion" value="<?php echo $funcion->getId(); ?>"></input>
                <div type="submit" class="contenedor_horario_elemento"><?php echo hora($funcion->getMinutos_inicio()); ?></div>
            </div>
        <?php } 
        } ?>
    </div>
    <?php } ?>
</div> 