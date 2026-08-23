<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    include 'conexion-be.php';

    if (!$conexion) {
        throw new Exception("Error de conexión a la base de datos: " . mysqli_connect_error());
    }

    $nombre_completo = $_POST['nombre_completo'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // Encriptar contraseña
    $contrasena = hash('sha512', $contrasena);

    // Verificar que el correo no se repita en la BBDD
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");
    if (!$verificar_correo) {
        throw new Exception("Error en la consulta de correo: " . mysqli_error($conexion));
    }

    if(mysqli_num_rows($verificar_correo) > 0){
        echo '<script>alert("Este correo ya esta registrado, intenta con otro diferente"); window.location= "../index.php";</script>';
        exit();
    }

    // Verificar que el usuario no se repita en la BBDD
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
    if (!$verificar_usuario) {
        throw new Exception("Error en la consulta de usuario: " . mysqli_error($conexion));
    }

    if(mysqli_num_rows($verificar_usuario) > 0){
        echo '<script>alert("Este usuario ya esta registrado, intenta con otro diferente"); window.location= "../index.php";</script>';
        exit();
    }

    $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena')";
    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '<script>alert("Usuario almacenado exitosamente"); window.location= "../index.php";</script>';
    } else {
        throw new Exception("Error al insertar el usuario: " . mysqli_error($conexion));
    }

    mysqli_close($conexion);

} catch (Exception $e) {
    // Muestra el error exacto en pantalla en lugar del Error 500 genérico
    echo "<h2 style='color: red;'>Error crítico en el servidor:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>