<head>
    <link rel="stylesheet" href="<?php echo constant("URL")."view/user/perfilUsuario.css"?>">
</head>

<?php 
    $datos = $this->d["datos"];
    $datos_cuenta = $this->d["datos_cuenta"];
?>
<div class="body">
    <div class="titulo-usuario"> 
        <span>MI CUENTA</span> 
        
    </div>

    <section class="contenedor__general">
        
            <div class="left-column background-left-column">
                <img src="public\img\usuario.png" class="imagen">
                <form class="formulario1" action="login/authenticate" method="POST">
                    <p class="formulario1__input">
                        <label for="username">Usuario</label>
                        <input class="input" type="text" name="username" value="<?php echo $datos_cuenta->getUsername(); ?>" id="username" autocomplete="off" disabled>
                    </p>
                    <p class="formulario1__input">
                        <label for="password">Contraseña</label>
                        <input class="input" type="password" name="password" placeholder="rellene su contraseña" id="password" autocomplete="off" disabled>
                    </p>	
                </form>
                <p class="boton">
                    <input type="text" id="boton_habilitar_edicion" value="Modificar datos"/>
                </p>
            </div>

            <div class="contenedor__formulario">
                <h2>Datos</h2>
                <form class="formulario" action="" method="POST">
                    <p class="formulario__input">
                        <label for="name">Nombre</label>
                        <input class="input" type="text" name="name" id="name" value="<?php echo $datos->getNombres(); ?>"autocomplete="off" disabled>
                        <label for="apellido_p">Primer apellido</label>
                        <input class="input" type="text" name="apellido_p" id="apellido_p" value="<?php echo $datos->getApellido_p(); ?>"autocomplete="off" disabled>
                        <label for="apellido_m">Segundo apellido</label>
                        <input class="input" type="text" name="apellido_m" id="apellido_m" value="<?php echo $datos->getApellido_m(); ?>"autocomplete="off" disabled>
                        <label for="dni">DNI</label>
                        <input class="input" type="text" name="dni" id="dni" value="<?php echo $datos->getId(); ?>"autocomplete="off" readonly>
                        <label for="correo">Email</label>
                        <input class="input" type="email" name="correo" id="correo" value="<?php echo $datos->getCorreo(); ?>"autocomplete="off" disabled>
                        <label for="fecha_nacimiento">Cumpleaños</label>
                        <input class="input" type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $datos->getFechaNacimiento(); ?>"autocomplete="off" disabled>
                    </p>
                </form>
            </div>

    </section>
    <section class="contenedor__modificar">
        <div class="inferior">
            <p class="botones">
                <input type="text" value="Cancelar" id="Cancelar" onclick="location.reload()" disabled/>
                <input type="text" id="boton_actualizar" value="Actualizar datos" disabled/>
            </p>  
        </div>
    </section>    
</div>


<script>
    const $form1 = document.querySelector(".formulario1"),
    $form = document.querySelector(".formulario"),
    $boton_habilitar = document.querySelector("#boton_habilitar_edicion"),
    $boton_actualizar = document.querySelector("#boton_actualizar"),
    $boton_cancelar = document.querySelector("#Cancelar");


    $boton_habilitar.addEventListener("click",(e)=>{
        e.target.disabled = true;
        $boton_cancelar.disabled = false;   
        $boton_actualizar.disabled = false;
        $inputs = $form.querySelectorAll(".input");
        console.log($form)
        console.log($inputs)
        for(let i = 0; i < $inputs.length; i++){
            console.log(i)
            if($inputs[i].id != "dni"){
                $inputs[i].disabled = false;
            }
        }
        $inputs = $form1.querySelectorAll(".input");
        console.log($inputs)
        for(let i = 0; i < $inputs.length; i++){
            console.log(i)
            if($inputs[i].id != "dni"){
                $inputs[i].disabled = false;
            }
        }
    });

    $boton_cancelar.addEventListener("click",(e)=>{
        e.target.disabled = true;
        $boton_habilitar.disabled = false;   
        $boton_actualizar.disabled = true;
        $inputs = $form.querySelectorAll("input");
        for(let i = 0; i < $inputs.length; i++){
            $inputs[i].disabled = true;
        }
        window.location.reload();
        
    })
</script>