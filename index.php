<?php 

    session_start();

    if(isset($_SESSION['usuario'])){

        header("location: php/bienvenido.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y registro</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <main>
        <div class="contenedor__todo">

            <div class="caja__trasera">

                <div class="caja__trasera-login">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button id="btn__iniciar-sesion">Iniciar sesión</button>
                </div>
                 <div class="caja__trasera-register">
                        <h3>¿Aún no tienes cuenta?</h3>
                        <p>Regístrate para que puedas iniciar sesión</p>
                        <button id="btn__registrarse">Regístrate</button>
                </div>

            </div>
            <!--Formulario de login y registro-->
            <div class="contenedor__login-register">
                <!--Formulario de login -->
                <form action="login_usuario_be.php" class="formulario__login" method="POST">
                    <h2>Iniciar sesion</h2>
                    <input type="text" placeholder="Correo Electronico" name="correo">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                    <button>Entrar</button>
                </form>
                <!--Formulario de registro-->
                <form action="/login-register/registro_usuario_be.php" class="formulario__register" method="POST">
                    <h2>Regístrate</h2>
                    <input type="text" placeholder="Nombre completo" name="nombre_completo">
                    <input type="text" placeholder="Correo electronico" name="correo">
                    <input type="text" placeholder="Usuario" name="usuario">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                    <button>Regístrate</button>
                </form>



            </div>
        </div>
    </main>
    <script src="assets/js/script.js"></script>
    
</body>
</html>