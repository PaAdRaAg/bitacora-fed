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

    <div class="card top-0 start-50 translate-middle-x p-3 border border-dark" style="width: 80%; height: 60%;">
      <h2 class="text-start">Actividades</h2>

      <br>
      <!-- TABLA QUE MUESETRA LAS TAREAS DEL USUARIO -->
      <table class="table table-hover text-center">
        <thead class="table-secondary">
          <tr>
            <th scope="col">ID</th>
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
          require_once("login.php");

          $atributos = $saml->getAttributes();

          $variableBuscar = $atributos["uCorreo"][0];
          // Preparar sentencia SQL para seleccionar registros
          $sql = "SELECT * FROM usuarios WHERE email = '$variableBuscar'";
          // Ejecutar sentencia y obtener resultados
          $result = $conn->query($sql);
          $ide = mysqli_fetch_assoc($result);

          $sql = "SELECT id, actividad FROM actividades WHERE id_usr = '$ide[id]'";
          $resul = mysqli_query($conn, $sql);
          // $rows = mysqli_fetch_assoc($resuls);
          


          while ($row = mysqli_fetch_assoc($resul)) {
            ?>
            <tr>
              <td>
                <?php echo $row['id'] ?>
              </td>
              <td>
                <?php echo $row['actividad'] ?>
              </td>
              <td>
                <button class="btn btn-secondary " type="submit" name="submit">
                  <a href="agsubact.php?id=<?php echo $row['id'] ?>" class="text-decoration-none link-light">Agregar</a>
                </button>
              </td>
              <td>
                <button class="btn btn-secondary " type="submit" name="submit">
                  <a href="ver_actividad.php?id=<?php echo $row['id'] ?>" class="text-decoration-none link-light">Ver</a>
                </button>
              </td>
              <td>
                <button class="btn btn-secondary" type="submit" name="submit">
                  <a class="text-decoration-none link-light" href="editar.php?id=<?php echo $row['id'] ?>">
                    Editar
                  </a>
                </button>
              </td>
              <td>
                <button class="btn btn-secondary" type="submit" name="submit">
                  <a class="text-decoration-none link-light" href="elim.php?id=<?php echo $row['id'] ?>"
                    onclick="return confirm('¿Se leiminarán tambiés sus subactividades correspondientes desea continuar?');" class="link-dark">
                    Eliminar
                  </a>
                </button>
              </td>
            </tr>

            <?php
            $sqls = "SELECT id, id_act_pert, actividad FROM subacts WHERE id_act_pert = '$row[id]'";
            $resuls = mysqli_query($conn, $sqls);
            while ($rows = mysqli_fetch_assoc($resuls)) {
              ?>

              <tr>
                <td>
                  <?php echo $rows['id'] ?>
                </td>
                <td>
                  <?php echo $rows['actividad'] ?>
                </td>
                <td>
                  <?php echo " Esta es una subactividad" ?>
                </td>
                <td>
                  <button class="btn btn-secondary " type="submit" name="submit">
                    <a href="ver_actividaddos.php?id=<?php echo $rows['id'] ?>" class="text-decoration-none link-light">Ver</a>
                  </button>
                </td>
                <td>
                  <button class="btn btn-secondary" type="submit" name="submit">
                    <a class="text-decoration-none link-light" href="editardos.php?id=<?php echo $rows['id'] ?>">
                      Editar
                    </a>
                  </button>
                </td>
                <td>
                  <button class="btn btn-secondary" type="submit" name="submit">
                    <a class="text-decoration-none link-light" href="elimsubact.php?id=<?php echo $rows['id'] ?>"
                      onclick="return confirm('Se eliminará la subactividad desea continuar?');" class="link-dark">
                      Eliminar
                    </a>
                  </button>
                </td>
              </tr>
              <?php
            }
          }
          ?>
        </tbody>
      </table>
      <br>
      <div class="row">
        <div class="col-12 col-md-4">
          <button class="btn btn-success"><a href="./agacts.php" class="text-decoration-none link-light">Agregar nueva
              actividad</a></button>
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