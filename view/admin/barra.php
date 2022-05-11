<nav>
    <ul>
        <?php 
        foreach($opciones as $opcion){
            if(get_class($opcion) == "BarraElemento"){
                if($opcion->titulo == "Salir"){
        ?>
            <li><a href="user/userCloseSession"><?php echo $opcion->titulo; ?></a></li>
        <?php 
                }else{
        ?>
            <li><a href="user/barraRedirect/<?php echo $opcion->link; ?>"><?php echo $opcion->titulo; ?></a></li>
        <?php
                }
            }else{
        ?>
            <li><?php echo get_class($opcion); ?></li>
        <?php
            }
        }
        
        ?>        
    </ul>
</nav>