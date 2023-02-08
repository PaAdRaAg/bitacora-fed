<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylepriv.css">
    <title>Bitácora</title>
</head>
<body>
  <div class="tareas"> 
    <h1>Bitácora</h1>
    <br>
    <?php
    include '../db_conn.php';
    require_once("login.php");

    if($saml->isAuthenticated())
        { $atributos= $saml->getAttributes();
        echo "<div class='head'> 
                <p>".$atributos["uNombre"][0]."</p>
                <p>|</p>
                <a href='../index.php'>Ir a secci&oacute;n p&uacute;blica</a>
                <p>|</p>
                <a href='logout.php'>Cerrar sesi&oacute;n</a>
              </div>";
    }
    ?>
    <div class="agTarea">
      <h2>Crear tarea</h2>
      <form action="" method="post" class="form">

        <div class="form">

          <div class="form">
            <label class="form-label">Escribe la tarea.</label>
            <br>
            <textarea class="" name="tarea" id="tarea" cols="30" rows="8"></textarea>
          </div>

          <div class="form-lin">
            <div class="form">Actividad:
              <select name="actividades" id="actividades"><option value="0">Privada</option></select>						
            </div>

            <div class="form">Fecha:
              <input type="date" name="fechact" id="fechact">
            </div>

            <div class="form">
            <input type="file" name="adjuntar" accept=".pdf,.jpg,.png" multiple class="btn-adj" >

            </div>
        </div>
  
        <div class="form">
          <input type="submit" value="Guardar" class="btn-guard">
        </div>
      </form>
    </div>
  </div>

  <?php
      require("./db_conn.php");
      // Definir variable a buscar
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

</body>
</html>