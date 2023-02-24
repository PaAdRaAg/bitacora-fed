<?php
include '../db_conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar sentencia SQL para seleccionar la actividad a editar
    $sql = "SELECT * FROM actividades WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (isset($_POST['act'])) {
            $actividad = $_POST['actividad'];
            $descipcion = $_POST['descipcion'];
            $invitados = $_POST['invitados'];


            // Preparar sentencia SQL para actualizar la actividad
            $sql = "UPDATE actividades SET actividad = '$actividad', descipcion='$descipcion', invitados='$invitados' WHERE id = '$id'";

            // Ejecutar sentencia
            if ($conn->query($sql) === TRUE) {
                header("Location: panel.php?msg=Actividad actualizada exitosamente");
            } else {
                echo "Error al actualizar la actividad: " . mysqli_error($conn);
                // echo "Error al actualizar la actividad: " . $conn->error;
            }

            // Redirigir al usuario de vuelta a la página anterior
            header("Location: panel.php?msg=Actividad actualizada exitosamente");
            exit;
        }
    } else {
        echo "No se encontró ninguna actividad con el ID especificado";
    }
}
?>
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
    <div class="card top-0 start-50 translate-middle-x p-3 border border-dark" id="bitacora"
        style="width: 80%; height: 60%;">
        <h2 class="text-start">Editar actividad</h2>

        <form method="post">
            <div class="form-group">
                <label for="actividad">Actividad:</label>
                <input type="text" class="form-control" id="actividad" name="actividad"
                    value="<?php echo $row['actividad'] ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="actividad">Descripción:</label>
                <input type="text" class="form-control" id="descipcion" name="descipcion"
                    value="<?php echo $row['descipcion'] ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="actividad">Invitados:</label>
                <input type="text" class="form-control" id="invitados" name="invitados"
                    value="<?php echo $row['invitados'] ?>">
            </div>
            <br>
            <div class="row">
                <div class="col-12 col-md-2">
                    <button class="btn btn-danger"><a href="./panel.php"
                            class="link-light text-decoration-none">Cancelar</a>
                    </button>
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" name="act" class="btn btn-success">Actualizar</button>
                </div>
                <div class="col-12 col-md-4">
                </div>
                <div class="col-12 col-md-4">
                </div>
            </div>
        </form>
    </div>
    <br>
    <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>
</body>

</html>