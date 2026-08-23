<?php
// Forzar visualización de errores de PHP en pantalla
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = getenv('host');
$user = getenv('user');
$password = getenv('password');
$dbname = getenv('dbname');
$port = getenv('PORT');

// Intentar conectar y atrapar cualquier fallo de mysqli
try {
    $conexion = mysqli_connect($host, $user, $password, $dbname, (int)$port);
    
    if (!$conexion) {
        throw new Exception(mysqli_connect_error());
    }
    // Si llega aquí, conectó con éxito
    echo "¡Conexión exitosa a la base de datos!";
} catch (Exception $e) {
    echo "<h3 style='color:red;'>Fallo crítico de conexión MySQL:</h3>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    exit();
}
?>