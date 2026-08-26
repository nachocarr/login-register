<?php
// Forzar visualización de errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Leemos la Service URI completa desde las variables de entorno de Railway
$database_url = getenv('DATABASE_URL');

if (!$database_url) {
    die("<h3 style='color:red;'>Error de configuración:</h3> La variable de entorno <b>DATABASE_URL</b> no está definida en Railway.");
}

// Analizamos la URI proporcionada por Aiven de forma automática
$url_parts = parse_url($database_url);

$host = $url_parts['host'] ?? '';
$port = $url_parts['port'] ?? 3306;
$user = $url_parts['user'] ?? '';
$password = $url_parts['pass'] ?? '';
$dbname = ltrim($url_parts['path'] ?? '', '/');

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    
    // Opciones para mantener la conexión segura SSL que exige Aiven
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Evita problemas con el certificado SSL autofirmado de Aiven en entornos cloud
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    ];

    // Intentar la conexión real utilizando PDO con SSL
    $conexion = new PDO($dsn, $user, $password, $options);

} catch (PDOException $e) {
    // Si falla, mostramos el error exacto en pantalla
    die("<h3 style='color:red;'>Error de conexión con Aiven:</h3> " . $e->getMessage());
}
?>