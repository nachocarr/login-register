<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = getenv('host');
$user = getenv('user');
$password = getenv('password');
$dbname = getenv('dbname');
$port = (int)getenv('PORT');

// Intentar conexión directa estándar con puerto
$conexion = mysqli_connect($host, $user, $password, $dbname, $port);

if (!$conexion) {
    echo "<h2 style='color:red;'>Error al conectar a la base de datos:</h2>";
    echo "<pre>" . mysqli_connect_error() . "</pre>";
    exit();
}

$nombre_completo = $_POST['nombre_completo'] ?? 'Prueba';
$correo = $_POST['correo'] ?? 'test@test.com';
$usuario = $_POST['usuario'] ?? 'testuser';
$contrasena = hash('sha512', $_POST['contrasena'] ?? '123456');

$query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena')";
$ejecutar = mysqli_query($conexion, $query);

if($ejecutar){
    echo "<h2 style='color:green;'>¡Usuario registrado y guardado en Aiven con éxito!</h2>";
} else {
    echo "<h2 style='color:red;'>Error al insertar en la base de datos:</h2>";
    echo "<pre>" . mysqli_error($conexion) . "</pre>";
}

mysqli_close($conexion);
?>