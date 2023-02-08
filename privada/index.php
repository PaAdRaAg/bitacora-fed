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
      <form action="index.php" method="post">
        <input type="text" name="titulo" placeholder="Título">
        <input type="text" name="descripcion" placeholder="Descripción">
        <input type="text" name="fecha" placeholder="Fecha">
        <input type="text" name="hora" placeholder="Hora">
        <input type="submit" name="submit" value="Crear">
      </form>
  </div>
</body>
</html>