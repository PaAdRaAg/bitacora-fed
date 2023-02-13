<?php
  include '../db_conn.php';
  require_once('../config.php');
  require_once("../login.php");


  // $atributos = $saml->getAttributes();
  // $variable_a_buscar = $atributos["uCorreo"][0];
  // $sql = "SELECT id FROM usuarios WHERE email = '$variable_a_buscar'";
  // $res = mysqli_query($conn, $sql);


  // // Recibir datos del formulario
  // $id_usr = $res;
  $texto = $_POST['texto'];
  $valor = $_POST['valor'];
  $fecha = $_POST['fecha'];
  $archivo = $_FILES['archivo']['name'];
  
  // Validar datos
  // ...
  
  // Conexión a la base de datos


  // Insertar datos en la base de datos

  $sql = "INSERT INTO tarea (id, id_usr, tarea, act, fecha, archivos)
          VALUES (NULL, '1', '$texto', '$valor', '$fecha', '$archivo')";
  if (mysqli_query($conn, $sql)) {
    echo "Datos agregados exitosamente.";
  } else {
    echo "Error al agregar datos: " . mysqli_error($conn);
  }
  
  // Cerrar conexión
  mysqli_close($conn);
  
  // Subir archivo
  move_uploaded_file($_FILES['archivo']['tmp_name'], 'ruta/' . $archivo);
?>