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
    include '../db_conn.php';
    require_once("login.php");

    if($saml->isAuthenticated())
        { $atributos= $saml->getAttributes();
        echo "<div class='card top-0 start-50 translate-middle-x pt-3 border border-dark' style='width: 45%; height: auto;'>
                <ul class='list-inline'> 
                  <li class='list-inline-item'>".$atributos["uNombre"][0]."</li>
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
      <h2 class="text-start">Crear tarea</h2>
      <form action="" method="post" class="form">

        <div class="form text-start">
          <br>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Tarea a registrar</label>
            <textarea class="form-control border border-dark border-opacity-50" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <div class="container text-center">
            <div class="row">
              <div class="col-12 col-md-4">
                <select class="form-select" aria-label="Default select example">
                  <option selected>Actividad</option>
                  <option value="1">Prrivada</option>
                  <option value="2">Grupal</option>
                </select>
              </div>
              <div class="col-12 col-md-4 p-0 pt-2 border border-dark border-opacity-25 rounded">
                <label for="fechact" class="form-label">Fecha: </label>
                <input type="date" id="fechact" class="border border-dark border-opacity-25 rounded">
              </div>
              <div class="col-12 col-md-4">
              <div class="">
                <input class="form-control " type="file" id="formFileMultiple" multiple>
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
          <button class="btn btn-success" type="submit">Guardar</button>
          </div>
        </div>
      </form>
    </div>
    <br>
  </div>

  <?php
      $atributos = $saml->getAttributes(); //Obtiene sus atributos

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
    ?>
  <br>
    <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>
</body>
</html>