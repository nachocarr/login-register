<?php
// Credenciales directas de InfinityFree
$host = 'sql302.infinityfree.com';
$port = '3306';
$user = 'if0_42757151';
$password = 'IqHaQK6qJHo'; // Tu contraseña actual del panel
$dbname = 'if0_42757151_login_register';

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