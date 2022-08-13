<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modo Invitado</title>
    <link rel="stylesheet" href="<?php echo constant("URL")."view/invitado/style.css"?>">
    <link rel="stylesheet" href="<?php echo constant("URL")."view/invitado/footer_header.css"?>">
</head>
<body>
    <span class="boton_mensaje"><?php $this->showMessages(); ?></span>
    <?php include "barra.php";?>
    <?php switch($this->d["actual"]){
        case "dulceria": include_once "dulceria.php";
            break;
        case "peliculas": include_once "peliculas.php";
            break;  
        case "proximamente": include_once "proximamente.php";
            break;          
        case "principal": include_once "principal.php";
            break;     
        case "pelicula_detalle": include_once "pelicula_detalle.php";
            break;        
        default: include_once "principal.php";
            break;
    } 
        
    ?>

    <?php include "footer.php"; ?>
    <script src="https://kit.fontawesome.com/9e7e6d804a.js" crossorigin="anonymous"></script>
    <script>
        $mensaje = document.querySelector(".boton_mensaje");
        if($mensaje.innerText != ""){
            $mensaje.classList.add("boton_trasladar");
            $mensaje.addEventListener("dblclick",e=>{
                e.target.classList.add("boton_desaparecer");
            })    
        }
    </script>
</body>
</html>