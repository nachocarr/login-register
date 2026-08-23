<?php
// Obtener las credenciales de las variables de entorno de Railway
$host = getenv('host');
$user = getenv('user');
$password = getenv('password');
$dbname = getenv('dbname');
$port = (int)getenv('PORT');

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $conexion = new PDO($dsn, $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<h2 style='color:red;'>Error al conectar a la base de datos:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    exit();
}
?>