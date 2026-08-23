<?php
// Forzar visualización de errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = getenv('host');
$user = getenv('user');
$password = getenv('password');
$dbname = getenv('dbname');
$port = (int)getenv('PORT');

// Inicializar MySQLi con soporte SSL para Aiven
$conexion = mysqli_init();

// Configurar opciones de SSL para evitar bloqueos por certificados en la nube
mysqli_ssl_set($conexion, NULL, NULL, NULL, NULL, NULL);
mysqli_options($conexion, MYSQLI_OPT_CONNECT_TIMEOUT, 10);

// Intentar la conexión real utilizando el puerto y SSL
$conex_exitosas = mysqli_real_connect($conexion, $host, $user, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL);

if (!$conex_exitosas) {
    // Si falla, mostramos el error exacto en pantalla en lugar del Error 500
    die("<h3 style='color:red;'>Error de conexión SSL con Aiven:</h3> " . mysqli_connect_error());
}
?>