<?php
include '../db_conn.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Preparar sentencia SQL para eliminar la actividad
  $sql = "DELETE FROM actividades WHERE id = '$id'";

  $sql2 = "DELETE FROM subacts WHERE id_act_pert = '$id'";

  // Ejecutar sentencia
  if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
    echo "Actividad eliminada exitosamente";
  } else {
    echo "Error al eliminar la actividad: " . mysqli_error($conn);
  }
}

// Redirigir al usuario de vuelta a la página anterior
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>