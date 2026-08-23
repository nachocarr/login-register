<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Obtener las credenciales de las variables de entorno de Railway
$host = getenv('host');
$user = getenv('user');
$password = getenv('password');
$dbname = getenv('dbname');
$port = (int)getenv('PORT');

// Conectar a la base de datos de Aiven usando PDO (compatible con entornos serverless)
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $conexion = new PDO($dsn, $user, $password);
    // Configurar PDO para que maneje los errores mediante excepciones
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<h2 style='color:red;'>Error al conectar a la base de datos:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    exit();
}

// Recoger los datos enviados desde el formulario de registro
$nombre_completo = $_POST['nombre_completo'] ?? '';
$correo = $_POST['correo'] ?? '';
$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// Encriptar la contraseña con SHA512
$contrasena = hash('sha512', $contrasena);

try {
    // Insertar en la base de datos de forma segura usando consultas preparadas
    $query = "INSERT INTO usuarios (nombre_completo, correo, usuario, contrasena) VALUES (:nombre, :correo, :usuario, :contrasena)";
    $stmt = $conexion->prepare($query);
    
    $ejecutar = $stmt->execute([
        ':nombre' => $nombre_completo,
        ':correo' => $correo,
        ':usuario' => $usuario,
        ':contrasena' => $contrasena
    ]);

    if($ejecutar){
        echo '
            <script>
                alert("Usuario almacenado con éxito");
                window.location = "index.php";
            </script>
        ';
    }
} catch (Exception $e) {
    echo '
        <script>
            alert("Inténtelo de nuevo, usuario no almacenado");
            window.location = "index.php";
        </script>
    ';
}

// Cerrar la conexión PDO
$conexion = null;
?>