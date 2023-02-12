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
    <div class="text-center">
        <h1>Bitácora</h1>
        <br>
        <img style="width: 250px; opacity: 0.2;" src="https://www.olimpiadadeinformatica.org.mx/Resultados/img/escuelas/377.png" class="img-fluid" alt="Logo Univerdisdad de Colima">
        <br>
        <?php
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
    <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>
</body>
</html>