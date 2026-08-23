<?php 


$host = getenv('host');
$user = getenv('user');
$password = getenv('password');
$dbname = getenv('dbname');
$port = getenv('PORT');

$conexion = mysqli_connect($host, $user, $password, $dbname, $port);
    /*
    if($conexion){
        echo "conexion establecida";
    }else{

    echo " no se ha conectado";
    }
    */

?>