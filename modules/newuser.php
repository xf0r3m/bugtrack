<?php
  $tableName = 'user';
  $columnScheme = 'username, passwd_hash, role';
  $nuPassHash = password_hash($_POST['nuPass'], PASSWORD_DEFAULT);
  $setValues = "'" . $_POST['nuName'] . "','" . $nuPassHash . "','" . $_POST["nuRole"] . "'";
  $result = dbAdd($connection, $tableName, $columnScheme, $setValues);
  if ( $result == true ) {
    echo "<div class=\"alert alert-success\" role=\"alert\">Użytkownik " . $_POST["nuName"] . " został pomyśnie utworzony.</div>";
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Utworzenie użytkownika niepowiodło się.</div>";
  } 
?>
