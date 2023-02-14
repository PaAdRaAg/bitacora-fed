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
    <div class="text-center" style='height: 75%;'>
    <h1 class="text-success fw-bold">Bitácora</h1>
        <br>
        <img style="width: 250px; opacity: 0.2;" src="https://www.olimpiadadeinformatica.org.mx/Resultados/img/escuelas/377.png" class="img-fluid" alt="Logo Univerdisdad de Colima">
        <br>
        <?php
        //CARGAR MENSAJE DE VINEVENIDA Y OPCIÓN DE INISIO DE SESIÓN SI NO HAY UNA SESIÓN ACTIVA
        //SI HAY SESIÓN ACTIVA APARECE EL NOMBRE DEL USUARIO DE LA SESIÓN Y UN BOTÓN PARA IR A LA SECCIÓN PRIVADA(BITÁCORA)
        include 'db_conn.php';

        require_once('config.php');
        if($saml->isAuthenticated()) 
            { $atributos= $saml->getAttributes(); 
            echo "<br> 
                    <p>Existe sesi&oacute;n a nombre de ".$atributos["uNombre"][0]."</p>
                    <br>
                    <a href='./privada/index.php'>Ir a secci&oacute;n privada</a>";
        }
        else {
            echo "<br>
                    <p>Este es un sistema que permite informar las actividades que se han realizado durante el día.</p>
                    <p>No hay sesi&oacute;n iniciada</p>
                    <div>
                        <a href='./privada/' class='btn btn-success'>Iniciar sesi&oacute;n</a>
                    </div>
                    ";
        }
        ?>
    </div>
    <br>

    <?php
    //REGISTRO DE NUEVOS USUARIOS Y DETECCIÓN DE LOS YA REGISTRADOS
            include 'db_conn.php';
            if($saml->isAuthenticated()) {
                // Definir variable a buscar
                $atributos = $saml->getAttributes(); //Obtiene sus atributos

                $variable_a_buscar = $atributos["uCorreo"][0];

                // Preparar sentencia SQL para seleccionar registros
                $sql = "SELECT * FROM crud WHERE email = '$variable_a_buscar'";

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

                    $sql = "INSERT INTO crud (id, nocuenta, nombre, apellido, email)
                        VALUES (NULL, $nocuenta, '$nombre', '$apellido', '$email')";

                    $result = mysqli_query($conn, $sql);
                }
            }
        ?>

    <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>
</body>
</html>