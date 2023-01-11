

<!--Logica con conexion a BBDD-->
<?php
$host = "localhost";
$bd="mecanicosweb";
$usuario="root@localhost";
$contrasena="";

    try {
        $conexion = new PDO("mysql:host=$host; dbname=$bd; $usuario; $contrasena;"); // conexion a base de datos con PDO
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
?>