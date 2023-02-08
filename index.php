<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleprin.css">
    <title>Bitácora</title>
</head>
<body>

    <div class="container"> 
        <h1>Bitácora</h1>
        <br>

        <?php
            include 'db_conn.php';

            require_once('config.php');
            if($saml->isAuthenticated()) //Si el usuario ya esta autenticado en saml
                { $atributos= $saml->getAttributes(); //Obtener sus atributos
                echo "<br> 
                        <p>Existe sesi&oacute;n a nombre de ".$atributos["uNombre"][0]."</p>
                        <br>
                        <a href='./privada/index.php'>Ir a secci&oacute;n privada</a>"; //Imprimir el atributo uNombre
            }
            else {
                echo "<br>
                        <p>Este es un sistema que permite informar las actividades que se han realizado durante el día.</p>
                        <br>
                        <p>No hay sesi&oacute;n iniciada</p>
                        <br>
                        <a href='./privada/'>Iniciar sesi&oacute;n</a>";
            }
        ?>

    </div>
</body>
</html>