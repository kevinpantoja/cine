<?php 
    $user = $this->d["user"]; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modo Invitado</title>
    <link rel="stylesheet" href="<?php echo constant("URL")."view/user/style.css"?>">
    <link rel="stylesheet" href="<?php echo constant("URL")."view/user/footer_header.css"?>">
</head>
<body>
    <?php $opciones = array(
        new BarraElemento("Inicio","principal"),
        new BarraGrupo("Peliculas",array(new BarraElemento("cartelera","peliculas"))),
        new BarraElemento("Dulceria","dulceria"),
        new BarraElemento("Cuenta",""))
    ; ?>
    <?php $this->showMessages(); ?>
    <?php include "barra.php";?>
    <?php switch($this->d["actual"]){
        case "dulceria": include_once "dulceria.php";
            break;
        case "peliculas": include_once "peliculas.php";
            break;            
        case "principal": include_once "principal.php";
            break;   
        case "datos": include_once "datos.php";
            break;              
        default: include_once "principal.php";
            break;
    } 
        
    ?>

    <?php include "footer.php"; ?>
    <script src="https://kit.fontawesome.com/9e7e6d804a.js" crossorigin="anonymous"></script>
</body>
</html>