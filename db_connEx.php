<?php
// Establecer conexión con la base de datos
$host = "host";
$username = "username";
$password = "password*6";
$dbname = "dbname";

// Crear conexión
$conn = mysqli_connect($host, $username, $password, $dbname);
// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
} else {
    // echo "Conexión exitosa";
}
?>