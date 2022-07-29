<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="<?php echo constant("URL")."view/login/signup.css"?>">
</head>
<body>
    <?php $this->showMessages(); ?>
    <section class="contenedor__general">

        <form action="<?php echo constant("URL"); ?>signup/newUser" method="POST">
            <div class="imagen">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="subcontenedor__datos">
                <div class="subseccion__encabezado">
                    <i class="fa-solid fa-pencil"></i>
                    <span>Datos Personales</span>
                </div>
                <div class="subseccion__inputs">
                    <input type="text" name="name" autocomplete="off" id="name" placeholder="Nombre">
                    <input type="text" name="dni" autocomplete="off" id="dni" placeholder="DNI">
                    <input type="text" name="apellido_p" autocomplete="off" id="apellido_p" placeholder="Apellido Paterno">
                    <input type="text" name="apellido_m" autocomplete="off" id="apellido_m" placeholder="Apellido Materno">
                    <input type="text" name="correo" autocomplete="off" id="correo" placeholder="Correo">
                    <input type="date" name="fecha_nacimiento" autocomplete="off" id="fecha_nacimiento" placeholder="Fecha Nacimiento">
                </div>
            </div>

            <div class="subcontenedor__datos">
                <div  class="subseccion__encabezado">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Acceso</span>
                </div>
                <div class="subseccion__inputs">
                    <input type="text" name="username" autocomplete="off" id="username" placeholder="Username"> 
                    <input type="text" name="password" autocomplete="off" id="password" placeholder="Password">
                </div>
            </div>
            
            <input type="submit" class="boton" value="Crear Cuenta"/>
        </form>
    </section>
    
    <a href="<?php echo constant("URL"); ?>login"><img class="imagen_signup" src="<?php echo constant("URL"); ?>public/img/pinguino_signup.jpeg" alt=""></a>

    <script src="https://kit.fontawesome.com/9e7e6d804a.js" crossorigin="anonymous"></script>
</body>
</html>