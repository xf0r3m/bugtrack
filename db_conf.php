<?php
  $db = 'bugtrack';
  $db_user = 'bugtrack';
  $db_passwd = '1234Test1234#@';
  $db_host = 'localhost';

  $connection = mysqli_connect($db_host, $db_user, $db_passwd, $db);

  if ( ! $connection ) {
    echo "<script>console.log('Połaczenie nie powiodło się');
          console.log(\"Nr błędu: " . mysqli_connect_errno() . "\");
          console.log(\"Błąd: " . mysqli_connect_error() . "\");</script>";
    exit;
  } else {
    echo "<script>console.log('Połączenie powiodło się!');</script>";
  }

?>
