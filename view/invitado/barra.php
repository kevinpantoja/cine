<nav class="cabecera">
    <!-- <ul>
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
    </ul> -->
    <a href=""><img src="<?php echo constant("URL")."public/img/logo.png"?>" alt="Logo" class="logo_cabecera"></a>
    <div class="barra_central">
        <a href="invitado/barraRedirect/peliculas"><span>PELICULAS</span></a>
        <a href="invitado/barraRedirect/dulceria"><span>DULCERIA</span></a>
        <a href="invitado/login"><span>INICIAR SESION</span></a>
    </div>
    <a href="invitado/login"><i class="fa-solid fa-right-to-bracket login_cabecera"></i></a>
</nav>