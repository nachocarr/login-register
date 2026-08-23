<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Obtener las credenciales de las variables de entorno de Railway
$host = getenv('host');
$user = getenv('user');
$password = getenv('password');
$dbname = getenv('dbname');
$port = (int)getenv('PORT');

// Conectar a la base de datos de Aiven usando el puerto
$conexion = mysqli_connect($host, $user, $password, $dbname, $port);

if (!$conexion) {
    echo "<h2 style='color:red;'>Error al conectar a la base de datos:</h2>";
    echo "<pre>" . mysqli_connect_error() . "</pre>";
    exit();
}

// Recoger los datos enviados desde el formulario de registro
$nombre_completo = $_POST['nombre_completo'] ?? '';
$correo = $_POST['correo'] ?? '';
$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// Encriptar la contraseña con SHA512
$contrasena = hash('sha512', $contrasena);

// Insertar en la base de datos
$query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena')";
$ejecutar = mysqli_query($conexion, $query);

if($ejecutar){
    echo '
        <script>
            alert("Usuario almacenado con éxito");
            window.location = "index.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Inténtelo de nuevo, usuario no almacenado");
            window.location = "index.php";
        </script>
    ';
}

mysqli_close($conexion);
?>