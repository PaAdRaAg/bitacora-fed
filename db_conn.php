<?php
    // Establecer conexión con la base de datos
    $host = "localhost";
    $username = "pramos12";
    $password = "x2MGC3Wjd9*6";
    $dbname = "pramos12";

    // Crear conexión
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Verificar conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    else{
        echo "Conexión exitosa";
    }
?>