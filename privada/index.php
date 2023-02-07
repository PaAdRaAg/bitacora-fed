<?php  
  include '../db_conn.php';

  require_once("login.php"); //Se asegura que el usuario este autenticado

  $atributos = $saml->getAttributes(); //Obtiene sus atributos

  //Imprime los atributos
  foreach ($atributos as $clave => $valor) {
    echo "<br><b>".$clave."</b>:".$valor[0];
  }

  echo "<br><br>Usted se encuentra en la secci&oacute;n privada de esta aplicaci&oacute;n<br><a href='../index.php'>Ir a secci&oacute;n p&uacute;blica</a><br><a href='logout.php'>[Cerrar sesi&oacute;n]</a>";



  ////////////GUENA
  // include '../db_conn.php';

  // $atributos = $saml->getAttributes(); //Obtiene sus atributos

  // $nocuenta = $atributos["uCuenta"][0];
  // $nombre = $atributos["sn"][0];
  // $apellido = $atributos["givenName"][0];
  // $email = $atributos["uCorreo"][0];

  // $sql = "INSERT INTO crud (id, nocuenta, nombre, apellido, email)
  //     VALUES (NULL, $nocuenta, '$nombre', '$apellido', '$email')";

  // $result = mysqli_query($conn, $sql);
?>