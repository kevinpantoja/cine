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
            <li> 
                <span><?php echo $opcion->titulo; ?></span> 
                <ul>
                <?php foreach($opcion->elementos as $elemento){?>
                    <li><a href="user/barraRedirect/<?php echo $elemento->link; ?>"><?php echo $elemento->titulo; ?></a></li>
                <?php }?>
                </ul>
            </li>
        <?php
            }
        }
        
        ?>        
    </ul>
</nav>