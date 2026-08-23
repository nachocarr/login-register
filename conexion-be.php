<?php
// Forzar visualización de errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = getenv('host');
$user = getenv('user');
$password = getenv('password');
$dbname = getenv('dbname');
$port = (int)getenv('PORT');

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
    // Si falla, mostramos el error exacto en pantalla en lugar de un Error 500
    die("<h3 style='color:red;'>Error de conexión SSL con Aiven:</h3> " . $e->getMessage());
}
?>