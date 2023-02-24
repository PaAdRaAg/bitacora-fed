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

        <div class="card top-0 start-50 translate-middle-x p-3 border border-dark" style="width: 80%; height: 60%;">

    <?php
// Conectar a la base de datos
include '../db_conn.php';

// Obtener el identificador de la actividad de la URL
$id = $_GET['id'];

// Preparar sentencia SQL para seleccionar la actividad con el identificador dado
$sql = "SELECT * FROM actividades WHERE id = '$id'";

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
                    <a  href="editar.php?id=<?php echo $row['id'] ?>"
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