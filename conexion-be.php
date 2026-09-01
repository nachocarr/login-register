<?php
// Forzar visualización de errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Credenciales directas de InfinityFree
$host = 'sql302.infinityfree.com';
$port = '3306';
$user = 'if0_42757151';
$password = 'IqHaQK6qJHo'; // Tu contraseña actual del panel
$dbname = 'if0_42757151_login_register'; // El nombre exacto de tu base de datos

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    
    // Opciones estándar para PDO (sin SSL de Aiven)
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    // Intentar la conexión real utilizando PDO
    $conexion = new PDO($dsn, $user, $password, $options);
    
    // Opcional: Descomenta la siguiente línea solo para probar que conecta con éxito
    // echo "<h3 style='color:green;'>¡Conectado a InfinityFree con éxito!</h3>";

} catch (PDOException $e) {
    // Si falla, mostramos el error exacto en pantalla
    die("<h3 style='color:red;'>Error de conexión con InfinityFree:</h3> " . $e->getMessage());
}
?>