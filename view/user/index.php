<?php 
    $user = $this->d["user"]; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine</title>
    <link rel="stylesheet" href="<?php echo constant("URL")."view/user/style.css"?>">
    <link rel="stylesheet" href="<?php echo constant("URL")."view/user/footer_header.css"?>">
    <!-- <link rel="stylesheet" href="<?php echo constant("URL")."view/user/perfilUsuario.css"?>"> -->
</head>
<body>
    <span class="boton_mensaje"><?php $this->showMessages(); ?></span>
    <?php include "barra.php";?>
    <?php error_log("ViewUser::switch del index -> actual: ".$this->d["actual"]); ?>
    <?php switch($this->d["actual"]){
        case "dulceria": include_once "dulceria.php";
            break;
        case "peliculas": include_once "peliculas.php";
            break;            
        case "principal":
            include_once "principal.php";
            break;   
        case "proximamente": include_once "proximamente.php";
            break;  
        case "pelicula_detalle": include_once "pelicula_detalle.php";
            break; 
        case "datos": include_once "datos.php";
            break;              
        case "paso1Compra": include_once "interface1.php";
            break;              
        case "paso2compra": include_once "interface2.php";
            break;              
        default:
            include_once "principal.php";
            break;
    } 
        
    ?>

    <?php include "footer.php"; ?>
<script src="https://kit.fontawesome.com/9e7e6d804a.js" crossorigin="anonymous"></script>
<script>
    window.addEventListener("scroll",function(){
        var header = document.querySelector(".cabecera");
        header.classList.toggle("fixed",window.scrollY);
    });
</script>
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