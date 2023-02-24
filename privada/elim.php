
//include '../db_conn.php';
////hacer que busque el id de la tarea y la elimine
//$id = $_GET['id'];
//
//$sql = "DELETE FROM actividades WHERE id=$id";
//$result = mysqli_query($conn, $sql);
//if($result){
//    header("Location: panel.php?msg=Usuario eliminado exitosamente");
//}else{
//    echo "Error al eliminar registro: " . mysqli_error($conn);
//}

<?php
include '../db_conn.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  
  // Preparar sentencia SQL para eliminar la actividad
  $sql = "DELETE FROM actividades WHERE id = '$id'";

  // Ejecutar sentencia
  if ($conn->query($sql) === TRUE) {
    echo "Actividad eliminada exitosamente";
  } else {
    echo "Error al eliminar la actividad: " . mysqli_error($conn);
  }
}

// Redirigir al usuario de vuelta a la página anterior
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>