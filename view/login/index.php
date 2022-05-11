<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php $this->showMessages(); ?>
    <form action="<?php echo constant("URL"); ?>login/authenticate" method="POST">
    <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>
        <h2>Login</h2>
        <p>
            <label for="username">username</label>
            <input type="text" name="username" id="username" autocomplete="off">
        </p>
        <p>
            <label for="password">password</label>
            <input type="password" name="password" id="password" autocomplete="off">
        </p>
        <p>
            <input type="submit" value="Iniciar Sesion"/>
        </p>
        <p>
            ¿No tienes una cuenta? <a href="<?php echo constant("URL"); ?>signup">Crear Una</a>
        </p>
    </form>
</body>
</html>