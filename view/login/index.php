<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo constant("URL")."view/login/style.css"?>">
</head>
<body>
<?php $this->showMessages(); ?>
    <a class="boton__regresar" href="<?php echo constant("URL")."invitado"?>"><i class="fa-solid fa-xmark"></i></a>

    <section class="contenedor__general">
        <div class="left-column background-left-column">
            <!-- <i class="fa-solid fa-user-alt"></i> -->
            <i class="fa-solid fa-user" class="imagen"></i>
            <!-- <img src="<?php echo constant("URL")."public/img/penguin.png"?>" alt="Imagen 1" class="imagen"/> -->
            <h2>BIENVENIDO</h2>
            <div class="line">──────</div>
            <p>Inicia sesión para disfrutar al máximo esta experiencia.</p>	
        </div>
        <div class="contenedor__formulario">
            <form class="formulario" action="<?php echo constant("URL"); ?>login/authenticate" method="POST">
                <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>
                <p class="formulario__input">
                    <label for="username"><i class="fa-solid fa-user-shield"></i></label>
                    <input type="text" name="username" id="username" autocomplete="off" placeholder="username">
                </p>
                <p class="formulario__input">
                    <label for="password"><i class="fa-solid fa-key"></i></label>
                    <input type="password" name="password" id="password" autocomplete="off" placeholder="password">
                </p>
                <p class="link">
                    <span class="mensaje">¿No tienes una cuenta? <a href="<?php echo constant("URL"); ?>signup">Crear Una</a></span>
                </p>
                <p class="boton">
                    <input type="submit" value="Iniciar Sesión"/>
                </p>
            </form>
        </div>
    </section>
    
    <script src="https://kit.fontawesome.com/9e7e6d804a.js" crossorigin="anonymous"></script>
</body>
</html>