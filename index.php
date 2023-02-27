<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitácora</title>
    <link href="https://www.ucol.mx/cms/apps/assets/css/apps.min.css" rel="stylesheet">
</head>

<body>
    <br>
    <div class="text-center h-75 mb-5">
        <h1 class="text-success fw-bold">Bitácora</h1>
        <br>
        <div>
            <img src="https://www.olimpiadadeinformatica.org.mx/Resultados/img/escuelas/377.png" class="img-fluid"
                style="width: 250px; opacity: 0.2;" alt="Logo Univerdisdad de Colima">
        </div>
        <br>
        <h2 class="text-success">Bienvenido</h2>

        <?php
        include 'db_conn.php';
        require_once('config.php');

        if ($saml->isAuthenticated()) {
            $atributos = $saml->getAttributes();
            ?>
            <br>
            <p>Existe sesión a nombre de
                <?= $atributos["uNombre"][0] ?>
            </p>
            <br>
            <a href='./privada/index.php'>Ir a sección privada</a>
            <?php
        } else {
            ?>
            <br>
            <p>Este es un sistema que permite informar las actividades que se han realizado durante el día.</p>
            <p>No hay sesión iniciada</p>
            <div>
                <a href='./privada/' class='btn btn-success'>Iniciar sesión</a>
            </div>
            <?php
        }
        ?>

    </div>
    <br>

    <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>
</body>

</html>