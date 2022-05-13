<h1><?php echo "hola Administrador ".$user->getNombres(); ?></h1>
<h1>tus Datos</h1>
<form action="<?php echo constant("URL"); ?>admin/updateAdminData" method="POST">
    <p>
        <label for="name">nombres</label>
        <input type="text" name="name" autocomplete="off" id="name"  disabled value="<?php echo $user->getNombres(); ?>">
    </p>
    <p>
        <label for="apellido_p">Primer Apellido</label>
        <input type="text" name="apellido_p" autocomplete="off" id="apellido_p" disabled value="<?php echo $user->getApellido_p(); ?>">
    </p>
    <p>
        <label for="apellido_m">Segundo Apellido</label>
        <input type="text" name="apellido_m" autocomplete="off" id="apellido_m" disabled value="<?php echo $user->getApellido_m(); ?>">
    </p>
    <p>
        <label for="correo">correo</label>
        <input type="text" name="correo" autocomplete="off" id="correo" disabled value="<?php echo $user->getCorreo(); ?>">
    </p>
    <p>
        <label for="celular">celular</label>
        <input type="tel" name="celular" autocomplete="off" id="celular" disabled value="<?php echo $user->getCelular(); ?>">
    </p>
    <p>
        <label for="direccion">direccion</label>
        <input type="text" name="direccion" autocomplete="off" id="direccion" disabled value="<?php echo $user->getDireccion(); ?>">
    </p>
    <p>
        <label for="fecha_nacimiento">fecha de nacimineto</label>
        <input type="date" name="fecha_nacimiento" autocomplete="off" disabled id="fecha_nacimiento" value="<?php echo $user->getFechaNacimiento(); ?>">
    </p>
    <p>
        <label for="dni">DNI</label>
        <input type="text" name="dni" autocomplete="off" id="dni" readonly value="<?php echo $user->getId(); ?>">
    </p>
    <button id="boton_habilitar_edicion">editar datos</button>
    <button id="boton_cancelar" disabled>Cancelar Cambios</button>
    <p>
        <input type="submit" id="boton_actualizar" disabled value="Actualizar Datos"/>
    </p>
</form>

<script>
    const $form = document.querySelector("form"),
    $boton_habilitar = document.querySelector("#boton_habilitar_edicion"),
    $boton_actualizar = $form.querySelector("#boton_actualizar"),
    $boton_cancelar = document.querySelector("#boton_cancelar");


    $boton_habilitar.addEventListener("click",(e)=>{
        e.target.disabled = true;
        $boton_cancelar.disabled = false;   
        $boton_actualizar.disabled = false;
        $inputs = $form.querySelectorAll("input");
        for(let i = 0; i < $inputs.length; i++){
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