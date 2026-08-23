<?php 


$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');
$port = getenv('DB_PORT');

$conexion = mysqli_connect($host, $user, $password, $dbname, $port);
    /*
    if($conexion){
        echo "conexion establecida";
    }else{

    echo " no se ha conectado";
    }
    */

?>