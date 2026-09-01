<?php
session_start();

// Importante: Usamos guion medio (-) tal como se llama tu archivo en la captura
include 'conexion-be.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

// Consulta usando PDO
$sql = "SELECT * FROM usuarios WHERE correo = :correo AND contrasena = :contrasena";
$stmt = $conexion->prepare($sql);
$stmt->execute([
    'correo' => $correo,
    'contrasena' => $contrasena
]);

// Verificamos si se encontró el usuario
if($stmt->rowCount() > 0){
    $_SESSION['usuario'] = $correo;
    
    // Al estar en la misma carpeta, van sin "../"
    header("location: /php/bienvenido.php");
    exit();
} else {
    echo '
        <script>
            alert("Usuario no existe, por favor verifique los datos introducidos");
            window.location = "index.php";
        </script>
    ';
    exit();
}
?>