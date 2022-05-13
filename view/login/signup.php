<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    

    <?php $this->showMessages(); ?>
    <form action="<?php echo constant("URL"); ?>signup/newUser" method="POST">
        <h2>Registrarse</h2>
        <p>
            <label for="username">username</label>
            <input type="text" name="username" autocomplete="off" id="username">
        </p>
        <p>
            <label for="password">password</label>
            <input type="text" name="password" autocomplete="off" id="password">
        </p>
        <p>
            <label for="name">nombres</label>
            <input type="text" name="name" autocomplete="off" id="name">
        </p>
        <p>
            <label for="apellido_p">Primer Apellido</label>
            <input type="text" name="apellido_p" autocomplete="off" id="apellido_p">
        </p>
        <p>
            <label for="apellido_m">Segundo Apellido</label>
            <input type="text" name="apellido_m" autocomplete="off" id="apellido_m">
        </p>
        <p>
            <label for="correo">correo</label>
            <input type="text" name="correo" autocomplete="off" id="correo">
        </p>
        <p>
            <label for="fecha_nacimiento">fecha de nacimineto</label>
            <input type="date" name="fecha_nacimiento" autocomplete="off" id="fecha_nacimiento">
        </p>
        <p>
            <label for="dni">DNI</label>
            <input type="text" name="dni" autocomplete="off" id="dni">
        </p>
        <p>
            <input type="submit" value="Crear Cuenta"/>
        </p>
        <p>
            ¿Tienes una cuenta? <a href="<?php echo constant("URL"); ?>">Iniciar Sesión</a>
        </p>
    </form>
</body>
</html>