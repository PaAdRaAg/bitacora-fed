<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>CRUD</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-m mb-5" style="font-size: 30px">CRUD PHP</nav>

    <?php
        include 'db_conn.php';

        require_once('config.php');
        echo "SECCION PUBLICA";
        if($saml->isAuthenticated()) //Si el usuario ya esta autenticado en saml
            { $atributos= $saml->getAttributes(); //Obtener sus atributos
            echo "<br> Existe sesi&oacute;n a nombre de ".$atributos["uNombre"][0]."<br><a href='./privada/index.php'>Ir a secci&oacute;n privada</a>"; //Imprimir el atributo uNombre
        }
        else {
            header("Location:".$SP_URL."privada/login.php"); 


            echo "<br>No hay sesi&oacute;n iniciada<br><a href='./privada/'>Iniciar sesi&oacute;n</a>";
        }
    ?>

    <div class="container">
        <?php
            if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        '.$msg.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>