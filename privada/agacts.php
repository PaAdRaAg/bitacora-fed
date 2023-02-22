<?php
include '../db_conn.php';
require_once('../config.php');
// jale el correo de la sesión actual
// checar que id está relacionado con el correo
// cuando tenga este dato que lo guarde en la variable de id_usr
//CUANDO SE PRESIONA EL BOTO DE GUARDAR DETECTA EL ID DE LA SESIÓN INICIADA Y ENVÍA LA INFORMACIÓN Y DATOS DEL USUARIO A LA BASE DE DATOS 
if (isset($_POST['submit'])) {
  $atributos = $saml->getAttributes();
  $variable_a_buscar = $atributos["uCorreo"][0];
  $sql = "SELECT id FROM usuarios WHERE email = '$variable_a_buscar'";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);

  $id_usr = $row['id'];
  $actividad = $_POST['actividad'];
  $descripcion = $_POST['descripcion'];
  $invitados = $_POST['invitados'];

  $sql = "INSERT INTO actividades (id, id_usr, actividad, descripcion, invitados)
            VALUES (NULL, '$id_usr', '$actividad', '$descripcion', '$invitados')";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: panel.php?msg=Registro creado exitosamente");
  } else {
    echo "Error al crear registro: " . mysqli_error($conn);
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
    <div class="text-center">
        <h1 class="text-success fw-bold">Bitácora</h1>
        <br>
        <br>
        <ul class="nav nav-tabs" id="myTab">
            <li class=""><a href="./index.php">Bitácora</a></li>
            <li class="active"><a href="./panel.php">Panel</a></li>
        </ul>
        <br>
        <form action="">

            <div class="card top-0 start-50 translate-middle-x p-3 border border-dark" id="bitacora"
                style="width: 80%; height: 60%;">
                <h2 class="text-start">Agregar actividad</h2>
                <form action="" method="post" class="form" enctype="multipart/form-data">

                    <div class="form text-start">
                        <br>
                        <div class="mb-3">
                            <label class="form-label">Nombre: </label>
                            <textarea class="form-control border border-dark border-opacity-50" id="tarea" name="tarea"
                                rows="3" required placeholder="Nombre"></textarea>
                        </div>

                        <br>
                        <div class="mb-3">
                            <label class="form-label">Descripción: </label>
                            <textarea class="form-control border border-dark border-opacity-50" id="tarea" name="tarea"
                                rows="3" required placeholder="Descripción"></textarea>
                        </div>

                        <br>
                        <div class="mb-3">
                            <label class="form-label">Invitar: </label>
                            <textarea class="form-control border border-dark border-opacity-50" id="tarea" name="tarea"
                                rows="3" placeholder="Correo delimitados por comas"></textarea>
                        </div>

                    </div>
            </div>
            <br>
            <div>
                <div class="row">
                    <div class="col-12 col-md-6 col-6 mx-auto">
                        <button class="btn btn-danger"><a href="./panel.php" class="link-light text-decoration-none">Cancelar</a></button>
                        <button class="btn btn-success" type="submit" name="submit">Agregar</button>
                    </div>
                    <div class="col-12 col-md-6">
                    </div>
                </div>
            </div>
        </form>



        <br>
        <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>
</body>

</html>