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
    <?php
    require_once("login.php");

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
          <a class="nav-link active" aria-current="page" href="./index.php">Bitácora</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="./panel.php">Panel</a>
        </li>
      </ul>
    </div>
    <div class="card top-0 start-50 translate-middle-x p-3 border border-dark" id="bitacora"
      style="width: 80%; height: 60%;">
      <h2 class="text-start">Crear tarea</h2>
      <form action="" method="post" class="form" enctype="multipart/form-data">

        <div class="form text-start">
          <br>
          <div class="mb-3">
            <label class="form-label">Tarea a registrar</label>
            <textarea class="form-control border border-dark border-opacity-50" id="tarea" name="tarea" rows="3"
              required></textarea>
          </div>

          <div class="container text-center">
            <div class="row">
              <div class="col-12 col-md-4">
                <select name="act" id="act" class="form-select" aria-label="Default select example" required>
                  <option selected value="Privada">Privada</option>
                  <option value="General">General</option>
                  <?php
                  $variableBuscar = $atributos["uCorreo"][0];
                  // Preparar sentencia SQL para seleccionar registros
                  $sql = "SELECT * FROM usuarios WHERE email = '$variableBuscar'";
                  // Ejecutar sentencia y obtener resultados
                  $result = $conn->query($sql);
                  $ide = mysqli_fetch_assoc($result);

                  $sql = "SELECT * FROM actividades WHERE id_usr = '$ide[id]'";
                  $resul = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($resul)) {
                    ?>
                    <option value="<?php echo $row['actividad'] ?>"><?php echo $row['actividad'] ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>

              <div class="col-12 col-md-4 p-0 pt-2 border border-dark border-opacity-25 rounded">
                <label class="form-label">Fecha: </label>
                <input type="date" id="fechact" name="fechact" class="border border-dark border-opacity-25 rounded"
                  required>
              </div>

              <div class="col-12 col-md-4">
                <div class="">
                  <input class="form-control " name="archivos" type="file" id="archivos" multiple>
                </div>
              </div>
            </div>
          </div>
          <br>

          <div class="row align-items-end">
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col d-grid gap-2">
              <button class="btn btn-success" type="submit" name="submit">Guardar</button>
            </div>
          </div>
      </form>
      <br>
    </div>
  </div>

  <br>
  <div class="card top-0 start-50 translate-middle-x p-3 border border-dark" style="width: 80%; height: 60%;">
    <h2 class="text-start">Tareas</h2>
    <br>
    <form action="" method="post">
      <div class="row align-items-start start-0">
        <div class="col">
          <select name="filtro" id="filtro" class="form-select" aria-label="Default select example" required>
            <option value="Privada">Privada</option>
            <option value="General">General</option>
            <?php
            $variableBuscar = $atributos["uCorreo"][0];
            // Preparar sentencia SQL para seleccionar registros
            $sql = "SELECT * FROM usuarios WHERE email = '$variableBuscar'";
            // Ejecutar sentencia y obtener resultados
            $result = $conn->query($sql);
            $ide = mysqli_fetch_assoc($result);

            $sql = "SELECT * FROM actividades WHERE id_usr = '$ide[id]'";
            $resul = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($resul)) {
              ?>
              <option value="<?php echo $row['actividad'] ?>"><?php echo $row['actividad'] ?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <div class="col">
          <button class="btn btn-success " type="submit" name="filtrar">Filtrar</button>
        </div>
        <div class="col">
        </div>
        <div class="col">
        </div>
      </div>
    </form>

    <br>
    <!-- TABLA QUE MUESETRA LAS TAREAS DEL USUARIO -->
    <table class="table table-hover text-center">
      <thead class="table-secondary">
        <tr>
          <th scope="col">ID Tarea</th>
          <th scope="col">ID Usuario</th>
          <th scope="col">Tarea</th>
          <th scope="col">Actividad</th>
          <th scope="col">Fecha</th>
          <th scope="col">Archivos</th>
        </tr>
      </thead>
      <tbody>
        <!-- CÓDIGO PARA LA TABLA QUE MUESETRA LAS TAREAS DEL USUARIO -->
        <?php
        if (isset($_POST['filtrar'])) {
          // Obtener el valor seleccionado de la lista desplegable
          $filtro = $_POST['filtro'];

          // Construir la consulta SQL con el filtro seleccionado
          $query = "SELECT * FROM tarea WHERE act = '$filtro'";

          // Ejecutar la consulta y obtener los resultados
          $result = mysqli_query($conn, $query);

          while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
              <td>
                <?php echo $row['id'] ?>
              </td>
              <td>
                <?php echo $row['id_usr'] ?>
              </td>
              <td>
                <?php echo $row['tarea'] ?>
              </td>
              <td>
                <?php echo $row['act'] ?>
              </td>
              <td>
                <?php echo $row['fecha'] ?>
              </td>
              <td>
                <?php echo $row['archivos'] ?>
              </td>
            </tr>
            <?php
          }
        } else {

          $variableBuscar = $atributos["uCorreo"][0];
          // Preparar sentencia SQL para seleccionar registros
          $sql = "SELECT * FROM usuarios WHERE email = '$variableBuscar'";
          // Ejecutar sentencia y obtener resultados
          $result = $conn->query($sql);
          $ide = mysqli_fetch_assoc($result);

          $sql = "SELECT * FROM tarea WHERE id_usr = '$ide[id]'";
          $resul = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($resul)) {
            ?>
            <tr>
              <td>
                <?php echo $row['id'] ?>
              </td>
              <td>
                <?php echo $row['id_usr'] ?>
              </td>
              <td>
                <?php echo $row['tarea'] ?>
              </td>
              <td>
                <?php echo $row['act'] ?>
              </td>
              <td>
                <?php echo $row['fecha'] ?>
              </td>
              <td>
                <?php echo $row['archivos'] ?>
              </td>
              <?php
              $variableBuscar = $atributos["uCorreo"][0];
              $sql2 = "SELECT * FROM actividades WHERE FIND_IN_SET('$variableBuscar', invitados)";
              $resul2 = mysqli_query($conn, $sql2);
              while ($row2 = mysqli_fetch_assoc($resul2)) {
                ?>
                <td>
                  <?php echo $row2['id'] ?>
                </td>
                <td>
                  <?php echo $row2['id_usr'] ?>
                </td>
                <td>
                  <?php echo $row2['actividad'] ?>
                </td>
                <td>
                  <?php echo $row2['descipcion'] ?>
                </td>
                <td>
                  <?php echo $row2['invitados'] ?>
                </td>
                <?php
              }

              $sql3 = "SELECT * FROM subacts WHERE FIND_IN_SET('$variableBuscar', invitados)";
              $resul3 = mysqli_query($conn, $sql3);
              while ($row3 = mysqli_fetch_assoc($resul3)) {

                ?>
                <td>
                  <?php echo $row3['id'] ?>
                </td>
                <td>
                  <?php echo $row3['id_us'] ?>
                </td>
                <td>
                  <?php echo $row3['tarea'] ?>
                </td>
                <td>
                  <?php echo $row3['act'] ?>
                </td>
                <td>
                  <?php echo $row3['fecha'] ?>
                </td>
                <td>
                  <?php echo $row3['archivos'] ?>
                </td>
                <?php

                ?>
              </tr>
              <?php
              }
          }
        }
        ?>
      </tbody>
    </table>
  </div>

  <br>
  <script>
    const today = new Date().toISOString().substr(0, 10);
    document.getElementById("fechact").value = today;
  </script>
  <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>

</body>

</html>