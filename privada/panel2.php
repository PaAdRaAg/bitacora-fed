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
                      onclick="return confirm('¿Estás seguro de que deseas eliminar esta actividad?');" class="link-dark">
                      Eliminar
                    </a>
                  </button>
                </td>    
              </tr>
              
                <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>
</body>

</html>