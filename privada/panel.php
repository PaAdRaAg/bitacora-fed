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
  $tarea = $_POST['tarea'];
  $actividad = $_POST['act'];
  $fecha = $_POST['fechact'];
  $archivos = $_FILES['archivos']['name'];

  $sql = "INSERT INTO tarea (id, id_usr, tarea, act, fecha, archivos)
            VALUES (NULL, '$id_usr', '$tarea', '$actividad', '$fecha', '$archivos')";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: index.php?msg=Registro creado exitosamente");
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
  <div class="card top-0 start-50 translate-middle-x p-3 border border-dark" style="width: 80%; height: 60%;">
    <h2 class="text-start">Actividades</h2>
    <br>

    <br>
    <!-- TABLA QUE MUESETRA LAS TAREAS DEL USUARIO -->
    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">Actividad</th>
          <th scope="col">Agregar sub actividad</th>
          <th scope="col">Ver</th>
          <th scope="col">Editar</th>
          <th scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        <!-- CÓDIGO PARA LA TABLA QUE MUESETRA LAS TAREAS DEL USUARIO -->
        <?php
        include '../db_conn.php';
        require_once('../config.php');
        
        $variableBuscar = $atributos["uCorreo"][0];
        // Preparar sentencia SQL para seleccionar registros
        $sql = "SELECT * FROM usuarios WHERE email = '$variableBuscar'";
        // Ejecutar sentencia y obtener resultados
        $result = $conn->query($sql);
        $ide = mysqli_fetch_assoc($result);

        $sql = "SELECT actividad FROM actividades WHERE id_usr = '$ide[id]'";
        $resul = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($resul)) {
          ?>
          <tr>
            <td>
              <?php echo $row['actividad'] ?>
            </td>
            <td>
            <button class="btn btn-success " type="submit" name="submit">actividad</button>
            </td>
            <td>
            <button class="btn btn-success " type="submit" name="submit">actividad</button>
            </td>
            <td>
            <button class="btn btn-success " type="submit" name="submit">actividad</button>
            </td>
            <td>
            <button class="btn btn-success " type="submit" name="submit">actividad</button>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <br>
    <div class="row">
      <div class="col-12 col-md-4">
        <button class="btn btn-success " type="submit" name="submit">Agregar nueva actividad</button>
      </div>
      <div class="col-12 col-md-4">
      </div>
      <div class="col-12 col-md-4">
      </div>
    </div>
  </div>
  <br>
  <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>
</body>

</html>