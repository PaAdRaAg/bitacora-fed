<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://www.ucol.mx/cms/apps/assets/css/apps.min.css" rel="stylesheet">
    <title>Bitácora</title>
</head>

<body>
    <br>
    <div class="text-center">
        <h1 class="text-success fw-bold">Bitácora</h1>
        <br>
        <?php
    require_once("login.php");
    include '../db_conn.php';
    require_once('../config.php');


    if ($saml->isAuthenticated()) {
      $atributos = $saml->getAttributes();

      $variable_a_buscar = $atributos["uCorreo"][0];
      // Preparar sentencia SQL para seleccionar registros
      $sql = "SELECT * FROM usuarios WHERE email = '$variable_a_buscar'";
      // Ejecutar sentencia y obtener resultados
      $result = $conn->query($sql);
      // Verificar si se encontró la variable
      if ($result->num_rows > 0) {
        // La variable se encontró, no hacer nada
      } else {
        // La variable no se encontró, ejecutar código
        $nocuenta = $atributos["uCuenta"][0];
        $nombre = $atributos["sn"][0];
        $apellido = $atributos["givenName"][0];
        $email = $atributos["uCorreo"][0];

        $sql = "INSERT INTO usuarios (id, nocuenta, nombre, apellido, email)
          VALUES (NULL, $nocuenta, '$nombre', '$apellido', '$email')";

        $result = mysqli_query($conn, $sql);
      }
      echo "<div class='card top-0 start-50 translate-middle-x pt-3 border border-dark' style='width: 45%; height: auto;'>
        <ul class='list-inline'> 
        <li class='list-inline-item'>" . $atributos["uNombre"][0] . "</li>
        <li class='list-inline-item'>|</li>
        <a class='list-inline-item text-decoration-none' href='../index.php'>Ir a sección pública</a>
        <li class='list-inline-item'>|</li>
        <a class='list-inline-item text-decoration-none' href='logout.php'>Cerrar sesi&oacute;n</a>
        </ul>
        </div>";
    }
    ?>
        <br>

        <div class="card top-0 start-50 translate-middle-x p-3 border border-dark" style="width: 80%; height: 60%;">

            <?php
            // Conectar a la base de datos
            include '../db_conn.php';

            // Obtener el identificador de la actividad de la URL
            $id = $_GET['id'];

            // Preparar sentencia SQL para seleccionar la actividad con el identificador dado
            $sql = "SELECT * FROM subacts WHERE id = '$id'";

            // Ejecutar sentencia y obtener resultados
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            // Mostrar la información de la actividad
            echo "<h2>Actividad:</h2>";
            echo "<p>" . $row['actividad'] . "</p>";
            echo "<br>";
            echo "<h2>Descripción:</h2>";
            echo "<p>" . $row['descipcion'] . "</p>";
            echo "<br>";
            echo "<h2>Invitados:</h2>";
            echo "<p>" . $row['invitados'] . "</p>";

            // Cerrar la conexión a la base de datos
            $conn->close();
            ?>
            <br>
            <div class="row">
                <div class="col-12 col-md-3">
                </div>
                <div class="col-12 col-md-3">
                    <button class="btn btn-danger"><a href="./panel.php"
                            class="link-light text-decoration-none">Regresar</a>
                    </button>
                </div>
                <div class="col-12 col-md-3">
                    <button type="submit" name="act" class="btn btn-success">
                        <a href="editar.php?id=<?php echo $row['id'] ?>"
                            class="link-light text-decoration-none">Modificar</a>
                    </button>
                </div>
                <div class="col-12 col-md-3">
                </div>
            </div>

        </div>
    </div>
    <br>
    <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>

</body>

</html>