<nav>
    <ul>
        <?php 
        foreach($opciones as $opcion){
            if(get_class($opcion) == "BarraElemento"){
                if($opcion->titulo == "Iniciar Sesion"){
        ?>
            <li><a href="invitado/login"><?php echo $opcion->titulo; ?></a></li>
        <?php 
                }else{
        ?>
            <li><a href="invitado/barraRedirect/<?php echo $opcion->link; ?>"><?php echo $opcion->titulo; ?></a></li>
        <?php
                }
            }else{
        ?>
            <li> 
                <span><?php echo $opcion->titulo; ?></span> 
                <ul>
                <?php foreach($opcion->elementos as $elemento){?>
                    <li><a href="invitado/barraRedirect/<?php echo $elemento->link; ?>"><?php echo $elemento->titulo; ?></a></li>
                <?php }?>
                </ul>
            </li>
        <?php
            }
        }
        
        ?>        
    </ul>
</nav>