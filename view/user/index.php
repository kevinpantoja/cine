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
    <?php $this->showMessages(); ?>
    <?php include "barra.php";?>
    <?php switch($this->d["actual"]){
        case "dulceria": include_once "dulceria.php";
            break;
        case "peliculas": include_once "peliculas.php";
            break;            
        case "principal": include_once "principal.php";
            break;   
        case "proximamente": include_once "proximamente.php";
            break;  
        case "pelicula_detalle": include_once "pelicula_detalle.php";
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