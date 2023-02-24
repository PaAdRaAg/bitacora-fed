<?php
include '../db_conn.php';
require_once('../config.php');
require_once("login.php");

// jale el correo de la sesión actual
// checar que id está relacionado con el correo
// cuando tenga este dato que lo guarde en la variable de id_usr
//CUANDO SE PRESIONA EL BOTO DE GUARDAR DETECTA EL ID DE LA SESIÓN INICIADA Y ENVÍA LA INFORMACIÓN Y DATOS DEL USUARIO A LA BASE DE DATOS 
if (isset($_POST['agact'])) {

  $atributos = $saml->getAttributes();
  $variable_a_buscar = $atributos["uCorreo"][0];
  $sql = "SELECT * FROM usuarios WHERE email = '$variable_a_buscar'";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);

  $id_usr = $row['id'];
  $actividad = $_POST['actividad'];
  $descripcion = $_POST['descipcion'];
  $invitados = $_POST['invitados'];

  $sql = "INSERT INTO actividades (id, id_usr, actividad, descipcion, invitados)
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
    <div class="nav justify-content-center">
      <ul class="nav nav-tabs">
        <li class="nav-item ">
          <a class="nav-link" href="./index.php">Bitácora</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link active" aria-current="page" href="./panel.php">Panel</a>
        </li>
      </ul>
    </div>
    <form action="" method="post" class="form" enctype="multipart/form-data">

      <div class="card top-0 start-50 translate-middle-x p-3 border border-dark" id="bitacora"
        style="width: 80%; height: 60%;">
        <h2 class="text-start">Agregar actividad</h2>
        <form action="" method="post" class="form" enctype="multipart/form-data">

          <div class="form text-start">
            <br>
            <div class="mb-3">
              <label class="form-label">Nombre: </label>
              <textarea class="form-control border border-dark border-opacity-50" id="actividad" name="actividad"
                rows="3" required placeholder="Nombre"></textarea>
            </div>

            <br>
            <div class="mb-3">
              <label class="form-label">Descripción: </label>
              <textarea class="form-control border border-dark border-opacity-50" id="descipcion" name="descipcion"
                rows="3" required placeholder="Descripción"></textarea>
            </div>

            <br>
            <div class="mb-3">
              <label class="form-label">Invitar: </label>
              <textarea class="form-control border border-dark border-opacity-50" id="invitados" name="invitados"
                rows="3" placeholder="Correo delimitados por comas"></textarea>
            </div>

          </div>
      </div>
      <br>
      <div>
        <div class="row">
          <div class="col-12 col-md-6">
            <button class="btn btn-danger"><a href="./panel.php"
                class="link-light text-decoration-none">Cancelar</a></button>
          </div>
          <div class="col-12 col-md-6">
            <button class="btn btn-success" type="submit" name="agact">Agregar</button>
          </div>
        </div>
      </div>
    </form>

    <br>
    <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>
</body>

</html>