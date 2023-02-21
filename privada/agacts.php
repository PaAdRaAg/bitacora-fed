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
        <br>
        <ul class="nav nav-tabs" id="myTab">
            <li class=""><a href="./index.php">Bitácora</a></li>
            <li class="active"><a href="./panel.php">Panel</a></li>
        </ul>
        <br>
        <form action="">

            <div class="card top-0 start-50 translate-middle-x p-3 border border-dark" id="bitacora"
                style="width: 80%; height: 60%;">
                <h2 class="text-start">Agregar actividad</h2>
                <form action="" method="post" class="form" enctype="multipart/form-data">

                    <div class="form text-start">
                        <br>
                        <div class="mb-3">
                            <label class="form-label">Nombre: </label>
                            <textarea class="form-control border border-dark border-opacity-50" id="tarea" name="tarea"
                                rows="3" required placeholder="Nombre"></textarea>
                        </div>

                        <br>
                        <div class="mb-3">
                            <label class="form-label">Descripción: </label>
                            <textarea class="form-control border border-dark border-opacity-50" id="tarea" name="tarea"
                                rows="3" required placeholder="Descripción"></textarea>
                        </div>

                        <br>
                        <div class="mb-3">
                            <label class="form-label">Invitar: </label>
                            <textarea class="form-control border border-dark border-opacity-50" id="tarea" name="tarea"
                                rows="3" required placeholder="Correo delimitados por comas"></textarea>
                        </div>

                    </div>
            </div>
            <br>
            <div>
                <div class="row">
                    <div class="col-12 col-md-6 col-6 mx-auto">
                        <button class="btn btn-danger " type="submit" name="submit"><a href="./panel.php" class="link-light text-decoration-none">Cancelar</a></button>
                        <button class="btn btn-success " type="submit" name="submit">Agregar</button>
                    </div>
                    <div class="col-12 col-md-6">
                    </div>
                </div>
            </div>
        </form>
        <br>
        <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>
</body>

</html>