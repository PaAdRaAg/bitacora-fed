<?php
include '../db_conn.php';
// jale el correo de la sesión actual
require_once('../config.php');

// checar que id está relacionado con el correo
// cuando tenga este dato que lo guarde en la variable de id_usr

// create
if (isset($_POST['submit'])) {

  $atributos = $saml->getAttributes();
  $variable_a_buscar = $atributos["uCorreo"][0];
  $sql = "SELECT id FROM usuarios WHERE email = '$variable_a_buscar'";
  $res = mysqli_query($conn, $sql);

    $id_usr = $res;
    $tarea = $_POST['tarea'];
    $actividad = $_POST['act'];
    $fecha = $_POST['fechact'];
    $archivos = $_FILES['archivos']['name'];

    $sql = "INSERT INTO tarea (id, id_usr, tarea, act, fecha, archivos)
            VALUES (NULL, '$id_usr', '$tarea', '$actividad', '$fecha', '$archivos')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?msg=Registro creado exitosamente");
    } else {
        echo "Error al crear registro: " . mysqli_error($conn);
    }


}
move_uploaded_file($_FILES['archivo']['tmp_name'], 'ruta/' . $archivo);

?>